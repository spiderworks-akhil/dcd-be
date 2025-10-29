<?php

namespace App\Http\Controllers\Admin;

use View, Redirect;
use App\Models\Event;
use App\Models\Media;

use App\Models\Category;
use App\Models\Language;
use App\Models\EventMedia;
use Illuminate\Http\Request;
use App\Models\EventSchedule;

use App\Traits\ResourceTrait;
use App\Models\ApprovalNotification;
use App\Http\Requests\Admin\EventRequest;
use App\Http\Controllers\Admin\BaseController as Controller;

class EventController extends Controller
{
    use ResourceTrait;

    public function __construct()
    {
        parent::__construct();

        $this->model = new Event;
        $this->route .= '.events';
        $this->views .= '.events';

        $this->permissions = ['list'=>'event_listing', 'create'=>'event_adding', 'edit'=>'event_editing', 'delete'=>'event_deleting'];
        $this->resourceConstruct();

    }

    // protected function getCollection() {
    //     return $this->model->select('id','type', 'slug', 'name', 'priority', 'status', 'created_at', 'updated_at');
    // }


    protected function getCollection()
    {
        $query = $this->model->select('id', 'type', 'slug', 'name', 'priority', 'status', 'created_at', 'updated_at');

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
        $categories = Category::where('parent_id',0)->where('category_type', 'Event')->get();
        return view::make($this->views . '.form', array('obj'=>$this->model, 'categories'=>$categories, 'allowedTypes'=>$allowedTypes));
    }

    public function edit($id) {
        $user = auth()->user();
        $id = decrypt($id);
        if($obj = $this->model->find($id)){

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
            $categories = Category::where('parent_id',0)->where('category_type', 'Event')->get();
            $approval_notification = ApprovalNotification::where('notifiable_type','Event')->where('notifiable_id',$obj->id)->orderBy('id','desc')->first();
            return view($this->views . '.form')->with('obj', $obj)->with('categories', $categories)->with('approval_notification', $approval_notification)->with('allowedTypes',$allowedTypes);
        } else {
            return $this->redirect('notfound');
        }
    }

    public function store(EventRequest $request)
    {
        $request->validated();
        $data = request()->all();
        $data['status'] = 0;
        $data['is_featured'] = isset($data['is_featured'])?1:0;
        $data['is_must_attend'] = isset($data['is_must_attend'])?1:0;
        $data['is_featured_in_banner'] = isset($data['is_featured_in_banner'])?1:0;
        if ($data['is_featured_in_banner']) {
            Event::where('is_featured_in_banner', 1)
                ->where('type', $data['type'])
                ->update(['is_featured_in_banner' => 0]);
        }
        $data['start_time'] = !empty($data['start_time'])?$this->parse_date_time($data['start_time']):null;
        $data['end_time'] = !empty($data['end_time'])?$this->parse_date_time($data['end_time']):null;
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
            if (isset($data['event_schedules']) && is_array($data['event_schedules'])) {
            foreach ($data['event_schedules'] as $schedule) {
                if (!empty($schedule['time']) && !empty($schedule['title'])) {
                    $eventSchedule = $this->model->schedules()->create([
                        'time' => $schedule['time'],
                        'priority' => $schedule['priority'] ?? 0,
                        'title' => $schedule['title'] ?? null,
                    ]);
                }
            }
        }
            $this->saveGalleryMedia($this->model, $data);
            $this->saveYoutube($this->model, $data);
        }
        return Redirect::to(route($this->route. '.edit', ['id'=> encrypt($this->model->id)]))->withSuccess('Event successfully saved!');
    }

    protected function saveGalleryMedia($gallery, $data){
        if(isset($data['event_medias'])){
            foreach ($data['event_medias'] as $key => $value) {
                if(trim($value) != '')
                {
                    $media = Media::find($value);
                    if($media){
                        $event_media = new EventMedia;
                        $event_media->upload_type = 'Upload';
                        $event_media->media_id = $value;
                        if($media->media_type == 'Video')
                            $event_media->video_preview_image = $media->thumb_file_path;
                        $gallery->gallery()->save($event_media);
                    }
                }
            }
        }
    }

    protected function saveYoutube($gallery, $data){
        if(isset($data['youtube_url'])){
            foreach ($data['youtube_url'] as $key => $value) {
                if(trim($value) != '')
                {
                    $event_media = new EventMedia;
                    $event_media->upload_type = 'Youtube';
                    $event_media->youtube_url = $value;
                    $event_media->youtube_preview = $data['youtube_preview'][$key];
                    $gallery->gallery()->save($event_media);
                }
            }
        }
    }

    public function update(EventRequest $request)
    {
        $request->validated();
        $data = request()->all();
        $id = decrypt($data['id']);
         if($obj = $this->model->find($id)){
            $data['status'] = isset($data['status'])?1:0;
            $data['is_featured'] = isset($data['is_featured'])?1:0;
            $data['is_must_attend'] = isset($data['is_must_attend'])?1:0;
            $obj->is_featured_in_banner = $data['is_featured_in_banner'] ?? 0;
            if ($obj->is_featured_in_banner) {
                Event::where('is_featured_in_banner', 1)
                    ->where('type', $obj->type)
                    ->where('id', '!=', $id)
                    ->update(['is_featured_in_banner' => 0]);
            }
            $data['start_time'] = !empty($data['start_time'])?$this->parse_date_time($data['start_time']):null;
            $data['end_time'] = !empty($data['end_time'])?$this->parse_date_time($data['end_time']):null;
            $data['priority'] = (!empty($data['priority']))?$data['priority']:0;

            if (!empty($data['removed_schedule_ids'])) {
                EventSchedule::whereIn('id', $data['removed_schedule_ids'])->delete();
            }

            if($obj->update($data))
            {
                if (isset($data['event_schedules']) && is_array($data['event_schedules'])) {
                    $obj->schedules()->delete();
                    foreach ($data['event_schedules'] as $schedule) {
                        if (!empty($schedule['time']) && !empty($schedule['title'])) {
                            $obj->schedules()->create([
                                'priority' => $schedule['priority'] ?? 0,
                                'time' => $schedule['time'],
                                'title' => $schedule['title'] ?? null,
                            ]);
                        }
                    }
                }
                $this->saveGalleryMedia($obj, $data);
                $this->saveYoutube($obj, $data);
            }

            return Redirect::to(route($this->route. '.edit', ['id'=>encrypt($id)]))->withSuccess('Event successfully updated!');
        } else {
            return Redirect::back()
                    ->withErrors("Ooops..Something wrong happend.Please try again.") // send back all errors to the login form
                    ->withInput(request()->all());
        }
    }

    public function media_edit($id, $type){
        $id = decrypt($id);
		if($file = EventMedia::find($id))
		{
			return view($this->views.'.media_form', array('file'=>$file, 'type'=>$type));
		}
    }

    public function media_update(Request $request){
        $data = $request->all();
        $id = decrypt($data['gallery_media_id']);
        if($obj = EventMedia::find($id)){
            if(!empty($data['media_id']))
            {
                $obj->media_id = $data['media_id'];
                if($obj->upload_type == "Youtube")
                    $obj->youtube_preview = NULL;
            }

            if($request->file('video_cover') && $request->file('video_cover')->isValid()){
                $upload = $this->uploadCover($request->file('video_cover'));
                if($upload['success']) {
                    $obj->video_preview_image = 'uploads/media/cover/'.$upload['filename'];
                }

            }
             $obj->vimeo_link = $data['vimeo_link'];

            $obj->title = $data['media_title'];
            $obj->description = $data['media_description'];
            $obj->save();

            $type = "Image-Video";

            $file_view = View::make($this->views.'.media', [ 'item' => $obj, 'type'=>$type]);
            $file_html = $file_view->render();
            return response()->json(['success'=>1, 'html'=>$file_html, 'id'=>$obj->id]);

        } else {
            return $this->redirect('notfound');
        }
    }

    public function media_destroy($id){
        $id = decrypt($id);
		if($file = EventMedia::find($id))
		{
            $file->delete();
            return response()->json(['success'=>1]);
		}
    }

 

  
// public function GetType(Request $request)
// {
//     $type = $request->query('type');
//     $slug = $request->query('slug');
//     $name = $request->query('name');
//     $currentType = $request->query('currentType');
//     $result = $request->query('start_time');
//     $result_link = $request->query('result_link');
//     $website_link_text = $request->query('website_link_text');
//     $website_link = $request->query('website_link');
//     $logo_image_id = $request->query('logo_image_id');
//     $start_time = $request->query('start_time');
//     $end_time = $request->query('end_time');
//     $location = $request->query('location');
//     $fees = $request->query('fees');
//     $video_id = $request->query('video_id');

//     $source = Event::where('slug', $slug)->where('type', $currentType)->first();
//     $target = Event::where('slug', $slug)->where('type', $type)->first();

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
//             $target->result = $source->result;
//             $target->result_link = $source->result_link;
//             $target->website_link_text = $source->website_link_text;
//             $target->website_link = $source->website_link;
//             $target->logo_image_id = $source->logo_image_id;
//             $target->start_time = $source->start_time;
//             $target->end_time = $source->end_time;
//             $target->location = $source->location;
//             $target->fees = $source->fees;
//             $target->video_id = $source->video_id;
//             $target->save();

//             return response()->json([
//                 'redirect_url' => route('admin.events.edit', ['id' => encrypt($target->id)])
//             ]);
//         } else {
//             // Replicate source page if target doesn't exist
//             $newPage = $source->replicate();
//             $newPage->slug = $slug;
//             $newPage->title = $name;
//             $newPage->type = $type;
//             $newPage->result = $result;
//             $newPage->result_link = $result_link;
//             $newPage->website_link_text = $website_link_text;
//             $newPage->website_link = $website_link;
//             $newPage->logo_image_id = $logo_image_id;
//             $newPage->start_time = $start_time;
//             $newPage->end_time = $end_time;
//             $newPage->location = $location;
//             $newPage->fees = $fees;
//             $newPage->video_id = $video_id;
//             $newPage->save();

//             return response()->json([
//                 'redirect_url' => route('admin.events.edit', ['id' => encrypt($newPage->id)])
//             ]);
//         }
//     }

//     // fallback: if somehow target exists
//     if ($target) {
//         return response()->json([
//             'redirect_url' => route('admin.events.edit', ['id' => encrypt($target->id)])
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

    // if (!in_array($key, $allowedSwaps)) {
    //     return response()->json(['error' => "You can't change from '{$currentType}' to '{$type}'."], 400);
    // }

    $source = Event::where('slug', $slug)->where('type', $currentType)->first();
    $target = Event::where('slug', $slug)->where('type', $type)->first();

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
        $fields = ['slug','name','title','content','short_description','result','og_image_id','priority',
                        'result_link','website_link_text','website_link','logo_image_id',
                        'start_time','end_time','location','fees','video_id','featured_image_id','banner_image_id','browser_title',
                        'og_title','meta_description','bottom_description','is_featured',
                        'is_featured','is_must_attend','is_scheduled','volunteer_ad_image_id',
                        'is_featured_in_banner','meta_keywords','category_id'];
        foreach ($fields as $field) {
            $target->$field = $source->$field;
        }
        $target->save(); 

    }
   
        // Fetch schedules
        $sourceSchedules = EventSchedule::where('event_id', $source->id)
                            ->select('title','time','priority','status')
                            ->orderBy('time')
                            ->get()
                            ->toArray();

        $targetSchedules = EventSchedule::where('event_id', $target->id)
                            ->select('title','time','priority','status')
                            ->orderBy('time')
                            ->get()
                            ->toArray();

        $hasChanges = $source->is_scheduled != $target->is_scheduled
                    || json_encode($sourceSchedules) !== json_encode($targetSchedules);

        if ($source->is_scheduled == 1 && $hasChanges) {

            EventSchedule::where('event_id', $target->id)->delete();

            foreach ($sourceSchedules as $schedule) {
                EventSchedule::create([
                    'event_id' => $target->id,
                    'title'    => $schedule['title'],
                    'time'     => $schedule['time'],
                    'priority' => $schedule['priority'],
                    'status'   => $schedule['status'] ?? 1,
                ]); 
            }

        
        }

        // ync Event Media only when changed
            $sourceMedias    = EventMedia::where('events_id', $source->id)
                                ->select('upload_type','youtube_preview','youtube_url','media_id','title','description','vimeo_link')
                                ->orderBy('id')
                                ->get()
                                ->toArray();

            $targetMedias    = EventMedia::where('events_id', $target->id)
                                ->select('upload_type','youtube_preview','youtube_url','media_id','title','description','vimeo_link')
                                ->orderBy('id')
                                ->get()
                                ->toArray();

            $mediaChanged = json_encode($sourceMedias) !== json_encode($targetMedias);

            if ($mediaChanged) {

                EventMedia::where('events_id', $target->id)->delete();

                foreach ($sourceMedias as $media) {
                    EventMedia::create([
                        'events_id'       => $target->id,
                        'upload_type'     => $media['upload_type'],
                        'youtube_preview' => $media['youtube_preview'],
                        'youtube_url'     => $media['youtube_url'],
                        'media_id'        => $media['media_id'],
                        'title'           => $media['title'],
                        'description'     => $media['description'],
                        'vimeo_link'      => $media['vimeo_link'],
                    ]);
                }
            }

    return response()->json([
        'exists' => true,
        'redirect_url' => route('admin.events.edit', ['id' => encrypt($target->id)])
    ]);
}




}
