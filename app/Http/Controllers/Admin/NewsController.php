<?php

namespace App\Http\Controllers\Admin;

use Log;
use App\Models\Tag;
use view, Redirect;

use App\Models\News;
use App\Models\Admin;
use App\Models\Event;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Language;
use App\Models\EventMedia;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\EventSchedule;
use App\Traits\ResourceTrait;
use App\Services\MailSettings;
use Illuminate\Support\Facades\DB;
use App\Models\ApprovalNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendApprovedNotification;
use App\Mail\SendRejectionNotification;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\NewsRequest;
use App\Mail\StatusChangeNotificationMail;
use App\Http\Controllers\Admin\BaseController as Controller;

class NewsController extends Controller
{
    use ResourceTrait;

    public function __construct()
    {
        parent::__construct();

        $this->model = new News;
        $this->route .= '.news';
        $this->views .= '.news';

        $this->permissions = ['list'=>'news_listing', 'create'=>'news_adding', 'edit'=>'news_editing', 'delete'=>'news_deleting'];
        $this->resourceConstruct();

    }

    public function storeImage(Request $request)
    {
        if ($request->has('image')) {

            $file = $request->file('image');
            $path = "/uploads/".time().$file->getClientOriginalName();
            \Storage::disk("s3")->put($path, file_get_contents($file));

            return response()->json(['path' => $path]);

        } else {
            return response()->json(['error' => 'No file uploaded.'],400);
        }

    }


protected function getCollection()
{
    $type = request()->query('type');
    $user = auth()->user();

    $isWriter = $user && $user->roles->pluck('name')
        ->intersect(['English Content Writer','Arabic Content Writer'])
        ->isNotEmpty();

    $query = $this->model
        ->select(
            'id',
            'type',
            'slug',
            'name',
            'title',
            'priority',
            'created_at',
            'updated_at',
            'updated_by',
            'created_by'
        )
        ->with(['approvalNotification', 'updated_user']);

    if (!$isWriter) {
        $query->addSelect('status');
    }

    /* ================= APPROVAL VISIBILITY ================= */
    $query->where(function ($q) use ($user, $isWriter) {

        // pending / rejected / no approval → everyone
        $q->where(function ($normal) {
            $normal->whereHas('approvalNotification', function ($sub) {
                $sub->whereIn('status', ['pending', 'rejected']);
            })
            ->orWhereDoesntHave('approvalNotification');
        });

        // approved → writers only
        if ($isWriter) {
            $q->orWhereHas('approvalNotification', function ($sub) {
                $sub->where('status', 'approved');
            });
        }

        // Exception ONLY for NON-admin users
        if ($user && !$user->hasRole('Admin')) {
            $q->orWhere(function ($exception) {
                $exception->whereIn('type', ['en_draft', 'ar_draft'])
                    ->whereExists(function ($sub) {
                        $sub->select(\DB::raw(1))
                            ->from('news as base')
                            ->whereColumn('base.slug', 'news.slug')
                            ->whereIn('base.type', ['en', 'ar'])
                            ->where('base.status', 0)
                            ->whereNull('base.deleted_at');
                    });
            });
        }
    });

    /* ================= LANGUAGE ACCESS ================= */
    if ($user && $user->roles->isNotEmpty()) {

        $languageIds = \DB::table('language_roles')
            ->whereIn('role_id', $user->roles->pluck('id'))
            ->pluck('language_id');

        if ($languageIds->isNotEmpty()) {

            $languageTypes = Language::whereIn('id', $languageIds)
                ->pluck('type');

            $query->whereIn('type', $languageTypes);
        }
    }

    /* ================= DRAFT VISIBILITY ================= */
    if ($user && $user->roles->isNotEmpty()) {

        $allowedDraftTypes = [];

        foreach ($user->roles as $role) {
            if ($role->name === 'English Content Writer') {
                $allowedDraftTypes[] = 'en_draft';
            }
            if ($role->name === 'Arabic Content Writer') {
                $allowedDraftTypes[] = 'ar_draft';
            }
        }

        if (!empty($allowedDraftTypes)) {

            $query->where(function ($q) {

                // always allow drafts
                $q->whereIn('type', ['en_draft', 'ar_draft'])

                // non-drafts must NOT be approved
                ->orWhere(function ($normal) {
                    $normal->whereNotIn('type', ['en_draft', 'ar_draft'])
                        ->where(function ($sub) {
                            $sub->whereHas('approvalNotification', function ($a) {
                                $a->whereIn('status', ['pending', 'rejected']);
                            })
                            ->orWhereDoesntHave('approvalNotification');
                        });
                });
            });
        }
    }

    if (!empty($type)) {
        $query->where('type', $type);
    }

    return $query;
}



public function index(Request $request)
    {
        if ($request->ajax()) {
            $collection = $this->getCollection();
        
            if(request()->get('data'))
            {
                $collection = $this->applyFiltering($collection);
            }
            else
                $collection->where('status', 'Open');
            $collection->orderBy('updated_at', 'desc');
            return $this->setDTData($collection)->make(true);
        } else {
            
            $search_settings = $this->getSearchSettings();
            return view::make($this->views . '.index', array('search_settings'=>$search_settings));
        }
    }

    protected function setDTData($collection)
    {
        $route = $this->route;

         // Language mapping
        $langMap = [
            'en' => 'English',
            'en_draft' => 'English (Draft)',
            'ar' => 'Arabic',
            'ar_draft' => 'Arabic (Draft)',
        ];

        return $this->initDTData($collection)
            ->addColumn('type', function ($row) use ($langMap) {
                return $langMap[$row->type] ?? $row->type;
            })
           ->addColumn('publication_status', function ($row) {

            // $status = optional($row->approvalNotification)->status ?? null;
            $status = optional($row->approvalNotification)->status;
            if (is_null($status) && str_contains($row->type, '_draft')) {
                return '<span class="text-secondary">Pending</span>';
            }
          if ($row->status == 0 && !str_contains($row->type, '_draft')) {
            return '<span class="text-secondary">Unpublished</span>';
          }


            switch ($status) {
                case 'approved':

                     $enStatus = $this->model
                        ->where('slug', $row->slug)
                        ->where('type', 'en')
                        ->whereNull('deleted_at')
                        ->value('status');

                    //  If base EN is not published, show Unpublished for draft
                    if ($enStatus === 0 && str_contains($row->type, '_draft')) {
                        return '<span class="text-secondary">Unpublished</span>';
                    }
                    return '<span class="text-success">Approved</span>';

                case 'rejected':
                    return '<span class="text-danger">Rejected</span>';

                case 'pending':
                    return '<span class="text-warning">Waiting for approval</span>';

                default:
                    return '<span class="text-primary">Published</span>';
            }
        })->addColumn('updated_user', function ($row) {
                return optional($row->updated_user)->name ?? '-';
            })
        ->addColumn('created_user', function ($row) {
            return optional($row->created_user)->name ?? '-';
        })
            ->rawColumns(['type','publication_status', 'action_edit', 'action_delete', 'status','updated_user','created_user']);
    }


    protected function getSearchSettings(){}

    public function create()
    {
        $categories = Category::where('parent_id',0)->where('category_type', 'News')->get();
        $tags = Tag::all();
          $user = auth()->user();
         if ($user && $user->roles) {

            $languageIds = \DB::table('language_roles')
                ->whereIn('role_id', $user->roles->pluck('id'))
                ->pluck('language_id');

            if ($languageIds->isNotEmpty()) {
                    $allowedTypes = Language::whereIn('id', $languageIds)->pluck('type');
            }
            if (empty($allowedTypes)) {
                $allowedTypes = [];
            }
        }
         $roleName = $user->roles->pluck('name')->first();
        return view::make($this->views . '.form', array('obj'=>$this->model, 'categories'=>$categories, 'tags'=>$tags,'roleName'=>$roleName,'allowedTypes'=>$allowedTypes));
    }

    public function edit($id) {
        
        $id = decrypt($id);
       if($obj = $this->model->find($id)) {
            $categories = Category::where('parent_id',0)->where('category_type', 'News')->get();
            $approval_notification = ApprovalNotification::where('notifiable_type','News')->where('notifiable_id',$obj->id)->orderBy('id','desc')->first();
            $tags = Tag::all();
             $user = auth()->user(); 
             $roleName = $user->roles->pluck('name')->first();

              if ($user && $user->roles) {

            $languageIds = \DB::table('language_roles')
                ->whereIn('role_id', $user->roles->pluck('id'))
                ->pluck('language_id');

            if ($languageIds->isNotEmpty()) {
                
                $allowedTypes = Language::whereIn('id', $languageIds)->pluck('type');
            }

              if (empty($allowedTypes)) {
                $allowedTypes = [];
            }
        }
            return view($this->views . '.form')->with('obj', $obj)->with('categories', $categories)->with('tags', $tags)->with('approval_notification', $approval_notification)->with('roleName', $roleName)->with('allowedTypes',$allowedTypes);;
        } else {
            return $this->redirect('notfound');
        }
    }

    public function store(NewsRequest $request)
    {
        $request->validated();
        $data = request()->all();

        $data['status'] = 0;
        $data['is_featured'] = isset($data['is_featured'])?1:0;
        $data['published_on'] = !empty($data['published_on'])?$this->parse_date_time($data['published_on']):date('Y-m-d H:i:s');
        $data['priority'] = (!empty($data['priority']))?$data['priority']:0;

        $selectedType = $request->type; 

        if (in_array($selectedType, ['en', 'en_draft'])) {
            $data['type'] = 'en_draft';
        } elseif (in_array($selectedType, ['ar', 'ar_draft'])) {
            $data['type'] = 'ar_draft';
        } else {
            $data['type'] = 'en_draft';
        }


        $this->model->fill($data);

        if($this->model->save())
        {
            if(!empty($data['tags']))
                $this->model->tags()->attach($data['tags']);
        }
        return Redirect::to(route($this->route. '.edit', ['id'=> encrypt($this->model->id)]))->withSuccess('News successfully saved!');
    }

    public function update(NewsRequest $request)
    {
        $request->validated();
        $data = request()->all();

        $id = decrypt($data['id']);
         if($obj = $this->model->find($id)){
            $oldStatus = $obj->status;
            $data['status'] = isset($data['status'])?1:0;
            $data['is_featured'] = isset($data['is_featured'])?1:0;
            $data['published_on'] = !empty($data['published_on'])?$this->parse_date_time($data['published_on']):date('Y-m-d H:i:s');
            $data['priority'] = (!empty($data['priority']))?$data['priority']:0;
            
            if($obj->update($data))
            {
                if(!empty($data['tags']))
                    $obj->tags()->sync($data['tags']);

            // ✅ Check if status changed from 1 → 0 AND type is en/ar
            if ($oldStatus == 1 && $data['status'] == 0 && in_array($obj->type, ['en', 'ar'])) {
                $this->sendStatusMail(
                    $obj,
                    'News',                  
                    $data['status'],        
                    $obj->type               
                );
            }
            }

            return Redirect::to(route($this->route. '.edit', ['id'=>encrypt($id)]))->withSuccess('News successfully updated!');
        } else {
            return Redirect::back()
                    ->withErrors("Ooops..Something wrong happend.Please try again.") 
                    ->withInput(request()->all());
        }
    }



public function GetType(Request $request)
{
    $type = $request->query('type');
    $currentType = $request->query('currentType');
    $slug = $request->query('slug');

    // Use string-based swap check
    $allowedSwaps = ["en_draft,en","en,en_draft","ar_draft,ar","ar,ar_draft","en,ar","ar,en"];
    $key = trim($currentType) . "," . trim($type);

  $source = News::where('slug', $slug)->where('type', $currentType)->first();
  $target = News::where('slug', $slug)->where('type', $type)->first();

    if (!$source) {
        return response()->json(['error' => "You can't change from '{$currentType}' to '{$type}'."], 400);
    }

    // Copy or create target
    if (!$target) {
        $target = $source->replicate();
        $target->type = $type;
        $target->title = $request->query('name');
        $target->save(); 
    } else {
        $fields = ['slug','name','title','short_description','content','bottom_content',
                        'featured_image_id','banner_image_id','browser_title',
                        'og_title','meta_description','bottom_description','is_featured',
                        'published_by_author_id','meta_keywords','published_on','category_id','og_image_id','priority'];
        foreach ($fields as $field) {
            $target->$field = $source->$field;
        }
        $target->save(); 

    }
   
    return response()->json(['redirect_url' => route('admin.news.edit', ['id' => encrypt($target->id)])]);
}

public function sendApprovalMail(Request $request)
{
    $request->validate([
        'id' => 'required|integer',
        'slug' => 'required|string',
        'type' => 'required|string',
        'model' => 'required|string' 
    ]);

    $allowedModels = [
        'News' => \App\Models\News::class,
        'Event' => \App\Models\Event::class,
    ];

    $modelName = $request->model; 

    if (!isset($allowedModels[$modelName])) {
        return response()->json([
            'status' => 'error',
            'message' => 'Invalid model type.',
        ]);
    }

    $modelClass = $allowedModels[$modelName];
    $record = $modelClass::find($request->id);

    if (!$record) {
        return response()->json([
            'status' => 'error',
            'message' => "{$modelName} not found.",
        ]);
    }

    // Determine which notification setting to use
    $settingCode = in_array($record->type, ['en', 'en_draft'])
        ? 'send_en_content_notification'
        : (in_array($record->type, ['ar', 'ar_draft']) ? 'send_ar_content_notification' : null);

    if (!$settingCode) {
        return response()->json(['status' => 'error', 'message' => 'Invalid type.']);
    }

    $notif_emails = Setting::where('code', $settingCode)->first();
    if (!$notif_emails || trim($notif_emails->value_text) == '') {
        return response()->json(['status' => 'error', 'message' => 'No notification emails found.']);
    }

    $email_array = array_map('trim', array_filter(explode(',', $notif_emails->value_text)));

      // --- Log file path ---
    $logFile = storage_path('logs/approval_mail_log.txt');
    $timestamp = now()->format('Y-m-d H:i:s');

    try {
        $approval = ApprovalNotification::create([
            'notifiable_type' => $modelName,
            'notifiable_id'   => $record->id,
            'created_by'      => auth()->id() ?? 1,
        ]);

        if ($approval->email_sent == 0) {
            $mail = new MailSettings;
            $mail->to($email_array)->send(new \App\Mail\SendNewsContentNotification($record, $approval));

            $approval->update([
                'email_sent' => 1,
                'status'     => 'pending'
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Approval email has been sent.'
            ]);
        }

    } catch (\Throwable $e) {
        $errorMsg = "[$timestamp]  Failed to send approval mail for {$modelName} ID {$record->id}:\n"
                  . $e->getMessage() . "\n"
                  . $e->getTraceAsString() . "\n\n";
        file_put_contents($logFile, $errorMsg, FILE_APPEND);

        \Log::error("Approval mail sending failed", [
            'model'      => $modelName,
            'record_id'  => $record->id,
            'error'      => $e->getMessage(),
        ]);

        if (isset($approval)) {
            $approval->update(['email_sent' => 0]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Failed to send approval email.',
            'error' => $e->getMessage()
        ]);
    }
}


public function showApprovalForm(Request $request, $id)
{
    $id = decrypt($id);
    $approval_notification = ApprovalNotification::findOrFail($id);

    if ($approval_notification->notifiable_type === "News") {
        $item = News::find($approval_notification->notifiable_id);
        $modelType = 'news';
    } 
    else if ($approval_notification->notifiable_type === "Event") {
        $item = Event::find($approval_notification->notifiable_id);
        $modelType = 'event';

    }
    else {
        abort(404, 'Approval item not found');
    }

    if (!$item) {
        abort(404, 'Approval item not found');
    }
    $preselect_status = $request->query('status');

    return view('admin.news.approval_form', [
        'item' => $item,
        'approval_notification' => $approval_notification,
        'preselect_status' => $preselect_status,
        'modelType' => $modelType,
    ]);
}


private function sendRejectionMail($approval, $record, $modelName)
{
    try {
        $recipientEmail = $approval->creator->email ?? null;

        if (empty($recipientEmail)) {

            $warning = "⚠️ No user email found for Approval ID {$approval->id}\n";
            file_put_contents(storage_path('logs/rejection_mail_errors.txt'), $warning, FILE_APPEND);
            \Log::warning(trim($warning));
            
        } else {
            $mail = new MailSettings;
            $mail->to([$recipientEmail])
                ->send(new SendRejectionNotification($record, $approval));
        }
    } catch (\Throwable $e) {
        $error = "Failed to send rejection mail for Approval ID {$approval->id}: "
                . $e->getMessage() . "\n"
                . $e->getTraceAsString() . "\n\n";

        file_put_contents(storage_path('logs/rejection_mail_errors.txt'), $error, FILE_APPEND);
        \Log::error("Failed to send rejection mail for Approval ID {$approval->id}: {$e->getMessage()}");
    }

    return redirect()->back();
}


private function sendApprovedlMail($approval, $record, $modelName)
{
    try {

        $recipientEmail = $approval->creator->email ?? null;

        if (empty($recipientEmail)) {

            $warning = "⚠️ No user email found for Approval ID {$approval->id}\n";
            file_put_contents(storage_path('logs/approval_mail_errors.txt'), $warning, FILE_APPEND);
            \Log::warning(trim($warning));

        } else {

            $mail = new MailSettings;
            $mail->to([$recipientEmail])
                ->send(new SendApprovedNotification($record, $approval, $modelName));
        }

    } catch (\Throwable $e) {

        $error = "Failed to send approval mail for Approval ID {$approval->id}: "
               . $e->getMessage() . "\n"
               . $e->getTraceAsString() . "\n\n";

        file_put_contents(storage_path('logs/approval_mail_errors.txt'), $error, FILE_APPEND);
        \Log::error("Failed to send approval mail for Approval ID {$approval->id}: {$e->getMessage()}");
    }
}

public function submitApprovalForm(Request $request, $approvalId)
{
    $approvalId = decrypt($approvalId);
    $approval = ApprovalNotification::findOrFail($approvalId);
    $email_array = $approval->creator->email;

    $approvalStatus = $request->status;
    $modelName = class_basename($approval->notifiable_type);

    $previousStatus = $approval->status;

     // --- Determine record (Event or News) ---
    $record = $approval->notifiable;

     $approval->update([
        'status'      => $approvalStatus,
        'remarks'     => $request->remarks,
        'action_date' => now(),
    ]);

    // Deactivate approval record once approved
  
    if (!$record) {
        $record = $approval->notifiable_type === 'Event'
            ? Event::find($approval->notifiable_id)
            : News::find($approval->notifiable_id);
    }
    
    // --- Handle Rejection Email ---
    if ($approvalStatus === 'rejected' && $previousStatus !== 'rejected') {
        return $this->sendRejectionMail($approval, $record, $modelName);
    }
    // --- Handle Approval Email ---
    if ($approvalStatus === 'approved' && $previousStatus !== 'approved') {
        
        $this->sendApprovedlMail($approval, $record, $modelName);
    }

    //  Only proceed if Approved
    if ($approvalStatus === 'approved' ) {

        $model = $modelName === "News"
            ? News::find($approval->notifiable_id)
            : Event::find($approval->notifiable_id);

        if ($model) {

            $currentType = $model->type;
            $slug = $model->slug;

            // Determine Published-Type
            $targetType = match ($currentType) {
                'en_draft' => 'en',
                'ar_draft' => 'ar',
                default => null,
            };

            if ($targetType) {

                $source = ($modelName === "News")
                    ? News::where('slug', $slug)->where('type', $currentType)->first()
                    : Event::where('slug', $slug)->where('type', $currentType)->first();

                $target = ($modelName === "News")
                    ? News::where('slug', $slug)->where('type', $targetType)->first()
                    : Event::where('slug', $slug)->where('type', $targetType)->first();

                if (!$source) {
                    return back()->with('error', "Draft content missing. Cannot approve.");
                }

                //  Field Mapping Based on Model
                $copyFields = match ($modelName) {
                    'News' => [
                        'slug','name','title','short_description','content','bottom_content',
                        'featured_image_id','banner_image_id','browser_title',
                        'og_title','meta_description','bottom_description','is_featured',
                        'published_by_author_id','meta_keywords','published_on','category_id','og_image_id','priority'
                    ],
                    'Event' => [
                        'slug','name','title','content','short_description','result','og_image_id','priority',
                        'result_link','website_link_text','website_link','logo_image_id',
                        'start_time','end_time','location','fees','video_id','featured_image_id','banner_image_id','browser_title',
                        'og_title','meta_description','bottom_description','is_featured',
                        'is_featured','is_must_attend','is_scheduled','volunteer_ad_image_id',
                        'is_featured_in_banner','meta_keywords','category_id'
                    ],
                    default => []
                };

                // Create Published Record If Missing
                if (!$target) {
                    $target = $source->replicate();
                    $target->type = $targetType;
                    $target->approved_date = now();
                    $target->status = 1;
                    $target->save();
                } else {
                    foreach ($copyFields as $field) {
                        if (isset($source->$field)) {
                            $target->$field = $source->$field;
                        }
                    }
                    $target->approved_date = now();
                    $target->status = 1;
                    $target->save();
                }

                // Event Schedule Sync
                if ($modelName === 'Event') {
                    $target = Event::find($target->id);

                    $sourceSchedules = EventSchedule::where('event_id', $source->id)->get();
                    EventSchedule::where('event_id', $target->id)->delete();

                    foreach ($sourceSchedules as $schedule) {
                        EventSchedule::create([
                            'event_id' => $target->id,
                            'title'    => $schedule->title,
                            'time'     => $schedule->time,
                            'priority' => $schedule->priority,
                            'status'   => $schedule->status ?? 1,
                        ]);
                    }

                    //  Sync Event Media
                    $sourceMedias = EventMedia::where('events_id', $source->id)->get();
                    EventMedia::where('events_id', $target->id)->delete();

                    foreach ($sourceMedias as $media) {
                        EventMedia::create([
                            'events_id'       => $target->id,
                            'upload_type'     => $media->upload_type,
                            'youtube_preview' => $media->youtube_preview,
                            'youtube_url'     => $media->youtube_url,
                            'media_id'        => $media->media_id,
                            'title'           => $media->title,
                            'description'     => $media->description,
                            'vimeo_link'      => $media->vimeo_link,
                        ]);
                    }

                }

             //  HIDE DRAFT AFTER APPROVAL
            if (in_array($model->type, ['en_draft', 'ar_draft'])) {
                $model->update([
                    'status' => 0,
                ]);
            }

            } else {
                $model->update([
                    'approved_date' => now(),
                ]);
            }
        }
    }

    return back()->with('success', "{$modelName} has been {$approvalStatus}.");
}

protected function applyFiltering($collection)
{
    $search = !empty(request()->get('data')) 
        ? request()->get('data') 
        : request()->all();

    if ($search)
    {
        foreach ($search as $key => $value)
        {
            if (!$value) continue;

            $latestStatusSubquery = "
            (
                SELECT LOWER(status)
                FROM approval_notifications
                WHERE notifiable_id = news.id
                AND notifiable_type = 'News'
                ORDER BY id DESC
                LIMIT 1
            )
        ";
            // CUSTOM: PUBLICATION STATUS FILTER
           if ($key == 'publication_status') {

    $collection->where(function($q) use ($value, $latestStatusSubquery) {

        switch ($value) {

            case 'Pending':
                $q->where('type', 'like', '%_draft')
                  ->whereDoesntHave('approvalNotification');
                break;

            case 'Waiting for approval':
                $q->whereRaw("$latestStatusSubquery = 'pending'");
                break;

            case 'Approved':
                $q->whereRaw("$latestStatusSubquery = 'approved'");
                break;

            case 'Rejected':
                $q->whereRaw("$latestStatusSubquery = 'rejected'");
                break;

            case 'Published':
                $q->where('type', 'not like', '%_draft')
                  ->where(function($x) use ($latestStatusSubquery){
                      $x->whereDoesntHave('approvalNotification')
                        ->orWhereRaw("$latestStatusSubquery = 'approved'");
                  });
                break;
        }
    });

    continue;
}


            if (strpos($key, 'news_') !== false)
                $key = str_replace('news_', 'news.', $key);

            $condition = null;
            $keyArr = explode('-', $key);

            if (isset($keyArr[1])) {
                $condition = $keyArr[0];
                $key = $keyArr[1];
            }

            // Date range
            if ($condition == 'date_between') {

                $date_array = explode('-', $value);

                $from_date = date('Y-m-d 00:00:00', strtotime($this->formatDate($date_array[0])));
                $to_date   = date('Y-m-d 23:59:59', strtotime($this->formatDate($date_array[1])));

                $collection->whereBetween($key, [$from_date, $to_date]);
            }

            // LIKE
            elseif ($condition == 'like') {
                $collection->where($key, 'like', "%$value%");
            }

            // Exact match
            else {
                $collection->where($key, $value);
            }
        }
    }

    return $collection;
}

public function destroy($id)
{
    $id = decrypt($id);

    $obj = $this->model->find($id);

    if (!$obj) {
        return $this->redirect('notfound');
    }

    $slug = $obj->slug;
    $type = $obj->type; 

    $obj->delete();

    if ($type === 'en' || $type === 'ar') {

        $draftType = $type . '_draft'; 

        $this->model
            ->where('slug', $slug)
            ->where('type', $draftType)
            ->delete();
    }

    return $this->redirect('removed', 'success', 'index');
}

public function changeStatus($id)
{
    $id = decrypt($id);

    $obj = $this->model->find($id);

    if (!$obj) {
        return $this->redirect('notfound');
    }

    $previousStatus = $obj->status;

    $newStatus = ($previousStatus == '1') ? '0' : '1';

    if ($previousStatus == '1' && $newStatus == '0') {

        if (in_array($obj->type, ['en', 'ar'])) {

            $modelName = class_basename($obj);

            $this->sendStatusMail($obj, $modelName, $newStatus, $obj->type);
            
        }
    }

    $obj->status = $newStatus;
    $obj->save();

     $message = ($newStatus == 0)?"disabled":"enabled";
     return $this->redirect($message,'success', 'index');

}



private function sendStatusMail($obj, $modelName, $newStatus, $type)
{
    try {
        if (in_array($type, ['ar', 'en'])) {
            $draftKey = $type . '_draft';

           $slug = $obj->slug;
        }
        $created_by = News::where('slug',$slug)->where('type',$draftKey)->pluck('created_by')->first();
        $admin = Admin::find($created_by);

        $recipientEmail = $admin?->email;

        if (empty($recipientEmail)) {
            $warning = "⚠️ No recipient email configured for record ID {$obj->id}\n";
            \Log::warning(trim($warning));
            return;
        }

        $statusText = ($newStatus == '1') ? 'Published' : 'Draft';

        // Send mail
        $mail = new MailSettings;
        $mail->to($recipientEmail)->send(new \App\Mail\StatusChangeNotificationMail($obj, $modelName, $statusText));


        // Optional: log successful mail sending
        $success = "✅ Status mail sent for record ID {$obj->id} to {$recipientEmail}\n";
        \Log::info(trim($success));

    } catch (\Throwable $e) {
        $error = "❌ Failed to send status mail for record ID {$obj->id}: "
            . $e->getMessage() . "\n"
            . $e->getTraceAsString() . "\n\n";

        \Log::error("Failed to send status mail for record ID {$obj->id}: {$e->getMessage()}");
    }
}



}
