<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController as Controller;
use App\Http\Requests\Admin\GalleryRequest;
use App\Traits\ResourceTrait;

use App\Models\Gallery;
use App\Models\GalleryMedia;
use App\Models\Category;
use App\Models\Media;
use Illuminate\Http\Request;
use View, Redirect;

class GalleryController extends Controller
{
    use ResourceTrait;

    public function __construct()
    {
        parent::__construct();

        $this->model = new Gallery;
        $this->route .= '.galleries';
        $this->views .= '.galleries';

        $this->permissions = ['list'=>'gallery_listing', 'create'=>'gallery_adding', 'edit'=>'gallery_editing', 'delete'=>'gallery_deleting'];
        $this->resourceConstruct();

    }

    protected function getCollection() {
        return $this->model->select('id', 'slug', 'name', 'priority', 'status', 'created_at', 'updated_at');
    }

    protected function setDTData($collection) {
        $route = $this->route;
        return $this->initDTData($collection)
            ->rawColumns(['action_edit', 'action_delete', 'status']);
    }

    protected function getSearchSettings(){}

    public function create()
    {
        $categories = Category::where('parent_id',0)->where('category_type', 'Gallery')->get();
        return View::make($this->views . '.form', array('obj'=>$this->model, 'categories'=>$categories));
    }

    public function edit($id) {
        $id = decrypt($id);
        if($obj = $this->model->find($id)){
            $categories = Category::where('parent_id',0)->where('category_type', 'Gallery')->get();
            return view($this->views . '.form')->with('obj', $obj)->with('categories', $categories);
        } else {
            return $this->redirect('notfound');
        }
    }

    public function store(GalleryRequest $request)
    {
        $request->validated();
        $data = request()->all();
        $data['is_featured'] = isset($data['is_featured'])?1:0;
        $data['status'] = isset($data['status'])?1:0;
        $data['priority'] = (!empty($data['priority']))?$data['priority']:0;
        $this->model->fill($data);
        if($this->model->save())
        {
            $this->saveGalleryMedia($this->model, $data);
            $this->saveYoutube($this->model, $data);
        }
        return Redirect::to(route($this->route. '.edit', ['id'=> encrypt($this->model->id)]))->withSuccess('Gallery successfully saved!');
    }

    protected function saveGalleryMedia($gallery, $data){
        if(isset($data['gallery_medias'])){
            foreach ($data['gallery_medias'] as $key => $value) {
                if(trim($value) != '')
                {
                    $media = Media::find($value);
                    if($media){
                        $gallery_media = new GalleryMedia;
                        $gallery_media->upload_type = 'Upload';
                        $gallery_media->media_id = $value;
                        if($media->media_type == 'Video')
                            $gallery_media->video_preview_image = $media->thumb_file_path;
                        $gallery->gallery()->save($gallery_media);
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
                    $gallery_media = new GalleryMedia;
                    $gallery_media->upload_type = 'Youtube';
                    $gallery_media->youtube_url = $value;
                    $gallery_media->youtube_preview = $data['youtube_preview'][$key];
                    $gallery->gallery()->save($gallery_media);
                }
            }
        }
    }

    public function update(GalleryRequest $request)
    {
        $request->validated();
        $data = request()->all();
        $id = decrypt($data['id']);
         if($obj = $this->model->find($id)){
            $data['is_featured'] = isset($data['is_featured'])?1:0;
            $data['status'] = isset($data['status'])?1:0;
            $data['priority'] = (!empty($data['priority']))?$data['priority']:0;
            if($obj->update($data))
            {
                $this->saveGalleryMedia($obj, $data);
                $this->saveYoutube($obj, $data);
            }

            return Redirect::to(route($this->route. '.edit', ['id'=>encrypt($id)]))->withSuccess('Gallery successfully updated!');
        } else {
            return Redirect::back()
                    ->withErrors("Ooops..Something wrong happend.Please try again.") // send back all errors to the login form
                    ->withInput(request()->all());
        }
    }

    public function media_edit($id, $type){
        $id = decrypt($id);
		if($file = GalleryMedia::find($id))
		{
			return view($this->views.'.media_form', array('file'=>$file, 'type'=>$type));
		}
    }

    public function media_update(Request $request){
        $data = $request->all();
        $id = decrypt($data['gallery_media_id']);
        if($obj = GalleryMedia::find($id)){
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

            $obj->title = $data['media_title'];
            $obj->description = $data['media_description'];
            $obj->link = $data['media_link'];
            $obj->save();

            $type = "Image-Video";
            if($obj->gallery->type == "Image")
                $type = "Image";
            elseif($obj->gallery->type == "Video")
                $type = "Video";

            $file_view = View::make($this->views.'.media', [ 'item' => $obj, 'type'=>$type]);
            $file_html = $file_view->render();
            return response()->json(['success'=>1, 'html'=>$file_html, 'id'=>$obj->id]);

        } else {
            return $this->redirect('notfound');
        }
    }

    public function media_destroy($id){
        $id = decrypt($id);
		if($file = GalleryMedia::find($id))
		{
            $file->delete();
            return response()->json(['success'=>1]);
		}
    }

    public function Gettype(Request $request)
    {
        $lang_type = $request->query('lang_type');
        $slug = $request->query('slug');
        $name = $request->query('name');
        $currentlang_type = $request->query('currentlang_type');

        if (($currentlang_type == "en_draft" && $lang_type == "en") || ($currentlang_type == "en" && $lang_type == "en_draft")) {

            $draft = Gallery::where('slug', $slug)->where('lang_type', "en_draft")->first();
            $en = Gallery::where('slug', $slug)->where('lang_type', "en")->first();

            if ($draft && $en) {

                $draft->lang_type = "en";
                $draft->save();

                $en->lang_type = "en_draft";
                $en->save();

                return response()->json([
                    'redirect_url' => route('admin.galleries.edit', ['id' => encrypt($draft->id)])
                ]);
            }

        }

        if (($currentlang_type === "ar_draft" && $lang_type === "ar") || ($currentlang_type === "ar" && $lang_type === "ar_draft")) {
            $draft = Gallery::where('slug', $slug)->where('lang_type', "ar_draft")->first();
            $ar = Gallery::where('slug', $slug)->where('lang_type', "ar")->first();

            if ($draft && $ar) {
                $draft->lang_type = "ar";
                $draft->save();

                $ar->lang_type = "ar_draft";
                $ar->save();

                return response()->json([
                    'redirect_url' => route('admin.galleries.edit', ['id' => encrypt($draft->id)])
                ]);
            }

        }

        $existingPage = Gallery::where('lang_type', $lang_type)->where('slug', $slug)->first();

        if ($existingPage) {
            return response()->json([
                'redirect_url' => route('admin.galleries.edit', ['id' => encrypt($existingPage->id)])
            ]);
        } else {

            $existingId = Gallery::where('slug', $slug)->where('lang_type', 'en')->pluck('id')->first();

            if ($existingId) {
                $page = Gallery::find($existingId);

                if ($page) {
                    $newPage = $page->replicate();
                    $newPage->slug = $slug;
                    $newPage->title = $name;
                    $newPage->lang_type = $lang_type;
                    $newPage->save();

                    return response()->json([
                        'redirect_url' => route('admin.galleries.edit', ['id' => encrypt($newPage->id)])
                    ]);
                }

            }

        }
    }


}
