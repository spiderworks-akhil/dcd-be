<?php

namespace App\Http\Controllers\Admin;

use Log;
use App\Models\Tag;
use view, Redirect;

use App\Models\News;
use App\Models\Event;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Language;
use App\Models\EventMedia;
use Illuminate\Http\Request;
use App\Models\EventSchedule;
use App\Traits\ResourceTrait;
use App\Services\MailSettings;
use Illuminate\Support\Facades\DB;
use App\Models\ApprovalNotification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Admin\NewsRequest;
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
            return response()->json(['error' => 'No file uploaded.'], 400);
        }

    }

    // protected function getCollection() {
    //     $type = request()->query('type');
    //     if ($type) {
    //         return $this->model->select('id','type', 'slug', 'name', 'title', 'status', 'priority', 'created_at', 'updated_at')->where('type', $type);
    //     }
    //     return $this->model->select('id','type', 'slug', 'name', 'title', 'status', 'priority', 'created_at', 'updated_at');
    // }


    protected function getCollection()
    {
        $type = request()->query('type');

        $query = $this->model->select('id','type', 'slug', 'name', 'title', 'status', 'priority', 'created_at', 'updated_at');

        $user = auth()->user(); 

       if ($user && $user->roles) {

            $languageIds = \DB::table('language_roles')
                ->whereIn('role_id', $user->roles->pluck('id'))
                ->pluck('language_id');

            if ($languageIds->isNotEmpty()) {
                
                $languageTypes = Language::whereIn('id', $languageIds)->pluck('type');

                $query->whereIn('type', $languageTypes);
            }
        }

        return $query;
    }

    protected function setDTData($collection) {
        $route = $this->route;
        return $this->initDTData($collection)
            ->rawColumns(['action_edit', 'action_delete', 'status']);
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
            $data['status'] = isset($data['status'])?1:0;
            $data['is_featured'] = isset($data['is_featured'])?1:0;
            $data['published_on'] = !empty($data['published_on'])?$this->parse_date_time($data['published_on']):date('Y-m-d H:i:s');
            $data['priority'] = (!empty($data['priority']))?$data['priority']:0;

            // if ($data['content']) {
            //     $data['content'] = json_encode($data['content']);
            // }


            if($obj->update($data))
            {
                if(!empty($data['tags']))
                    $obj->tags()->sync($data['tags']);
            }

            return Redirect::to(route($this->route. '.edit', ['id'=>encrypt($id)]))->withSuccess('News successfully updated!');
        } else {
            return Redirect::back()
                    ->withErrors("Ooops..Something wrong happend.Please try again.") 
                    ->withInput(request()->all());
        }
    }

   

// public function GetType(Request $request)
// {
//     $type = $request->query('type');
//     $slug = $request->query('slug');
//     $name = $request->query('name');
//     $currentType = $request->query('currentType');

//     $source = News::where('slug', $slug)->where('type', $currentType)->first();
//     $target = News::where('slug', $slug)->where('type', $type)->first();

//     $allowedSwaps = [
//         ["en_draft", "en"], ["en", "en_draft"],
//         ["ar_draft", "ar"], ["ar", "ar_draft"],
//         ["en", "ar"], ["ar", "en"]
//     ];

//     if (!in_array([$currentType, $type], $allowedSwaps)) {
//         return response()->json([
//             'error' => "You can't change from '{$currentType}' to '{$type}'."
//         ], 400);
//     }

//     // If source exists
//     if ($source) {
//         if ($target) {
//             // Copy content and title from source to target
//             $target->content = $source->content;
//             $target->title = $source->title;
//             $target->save();

//             return response()->json([
//                 'redirect_url' => route('admin.news.edit', ['id' => encrypt($target->id)])
//             ]);
//         } else {
//             // Replicate source page if target doesn't exist
//             $newPage = $source->replicate();
//             $newPage->slug = $slug;
//             $newPage->title = $name;
//             $newPage->type = $type;
//             $newPage->save();

            

//             return response()->json([
//                 'redirect_url' => route('admin.news.edit', ['id' => encrypt($newPage->id)])
//             ]);
//         }
//     }

//     // fallback: if somehow target exists
//     if ($target) {
//         return response()->json([
//             'redirect_url' => route('admin.news.edit', ['id' => encrypt($target->id)])
//         ]);
//     }

//     // fallback error
//     return response()->json([
//         'error' => "You can't change from '{$currentType}' to '{$type}'."
//     ], 400);
// }

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

    try {
        $approval = ApprovalNotification::create([
            'notifiable_type' => $modelName,
            'notifiable_id'   => $record->id,
            'email_sent'      => 1,
            'created_by'      => auth()->id() ?? 1,
        ]);

        $mail = new MailSettings;
        $mail->to($email_array)->send(new \App\Mail\SendNewsContentNotification($record, $approval));

        return response()->json([
            'status' => 'success',
            'message' => 'Approval email has been sent.'
        ]);

    } catch (\Exception $e) {
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

    $preselect_status = $request->query('status');

    return view('admin.news.approval_form', [
        'item' => $item,
        'approval_notification' => $approval_notification,
        'preselect_status' => $preselect_status,
        'modelType' => $modelType,
    ]);
}

public function submitApprovalForm(Request $request, $approvalId)
{
    $approvalId = decrypt($approvalId);
    $approval = ApprovalNotification::findOrFail($approvalId);

    $approvalStatus = $request->status;
    $modelName = class_basename($approval->notifiable_type);

    $approval->update([
        'status'      => $approvalStatus,
        'remarks'     => $request->remarks,
        'action_date' => now(),
        'email_sent'  => 1,
    ]);

    //  Only proceed if Approved
    if ($approvalStatus === 'approved') {

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

            } else {
                $model->update([
                    'approved_date' => now(),
                ]);
            }
        }
    }

    return back()->with('success', "{$modelName} has been {$approvalStatus}.");
}



}
