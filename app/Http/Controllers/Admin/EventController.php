<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController as Controller;
use App\Http\Requests\Admin\EventRequest;
use App\Traits\ResourceTrait;

use App\Models\Event;
use App\Models\EventMedia;
use App\Models\Category;
use App\Models\Media;
use Illuminate\Http\Request;

use View, Redirect;

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

    protected function getCollection() {
        return $this->model->select('id','type', 'slug', 'name', 'priority', 'status', 'created_at', 'updated_at');
    }

    protected function setDTData($collection) {
        $route = $this->route;
        return $this->initDTData($collection)
            ->rawColumns(['action_edit', 'action_delete', 'status']);
    }

    protected function getSearchSettings(){}

    public function create()
    {
        $categories = Category::where('parent_id',0)->where('category_type', 'Event')->get();
        return view::make($this->views . '.form', array('obj'=>$this->model, 'categories'=>$categories));
    }

    public function edit($id) {
        $id = decrypt($id);
        if($obj = $this->model->find($id)){
            $categories = Category::where('parent_id',0)->where('category_type', 'Event')->get();
            return view($this->views . '.form')->with('obj', $obj)->with('categories', $categories);
        } else {
            return $this->redirect('notfound');
        }
    }

    public function store(EventRequest $request)
    {
        $request->validated();
        $data = request()->all();
        $data['status'] = isset($data['status'])?1:0;
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

    public function GetType(Request $request)
    {
        $type = $request->query('type');
        $slug = $request->query('slug');
        $name = $request->query('name');
        $currentType = $request->query('currentType');

        if (($currentType == "en_draft" && $type == "en") || ($currentType == "en" && $type == "en_draft")) {

            $draft = Event::where('slug', $slug)->where('type', "en_draft")->first();
            $en = Event::where('slug', $slug)->where('type', "en")->first();

            if ($draft && $en) {

                $draft->type = "en";
                $draft->save();

                $en->type = "en_draft";
                $en->save();

                return response()->json([
                    'redirect_url' => route('admin.events.edit', ['id' => encrypt($draft->id)])
                ]);
            }

        }

        if (($currentType === "ar_draft" && $type === "ar") || ($currentType === "ar" && $type === "ar_draft")) {
            $draft = Event::where('slug', $slug)->where('type', "ar_draft")->first();
            $ar = Event::where('slug', $slug)->where('type', "ar")->first();

            if ($draft && $ar) {
                $draft->type = "ar";
                $draft->save();

                $ar->type = "ar_draft";
                $ar->save();

                return response()->json([
                    'redirect_url' => route('admin.events.edit', ['id' => encrypt($draft->id)])
                ]);
            }

        }

        $existingPage = Event::where('type', $type)->where('slug', $slug)->first();

        if ($existingPage) {
            return response()->json([
                'redirect_url' => route('admin.events.edit', ['id' => encrypt($existingPage->id)])
            ]);
        } else {

            $existingId = Event::where('slug', $slug)->where('type', 'en')->pluck('id')->first();

            if ($existingId) {
                $page = Event::find($existingId);

                if ($page) {
                    $newPage = $page->replicate();
                    $newPage->slug = $slug;
                    $newPage->title = $name;
                    $newPage->type = $type;
                    $newPage->save();

                    return response()->json([
                        'redirect_url' => route('admin.events.edit', ['id' => encrypt($newPage->id)])
                    ]);
                }

            }

        }
    }


}
