<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController as Controller;
use App\Http\Requests\Admin\NewsRequest;
use App\Models\News;

use App\Models\Category;
use App\Models\Tag;
use App\Traits\ResourceTrait;
use Illuminate\Http\Request;
use view, Redirect;

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

    protected function getCollection() {
        $type = request()->query('type');
        if ($type) {
            $this->model = $this->model->where('type', $type);
        }
        return $this->model->select('id','type', 'slug', 'name', 'title', 'status', 'priority', 'created_at', 'updated_at');
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
        return view::make($this->views . '.form', array('obj'=>$this->model, 'categories'=>$categories, 'tags'=>$tags));
    }

    public function edit($id) {
        $id = decrypt($id);
        if($obj = $this->model->find($id)){
            $categories = Category::where('parent_id',0)->where('category_type', 'News')->get();
            $tags = Tag::all();
            return view($this->views . '.form')->with('obj', $obj)->with('categories', $categories)->with('tags', $tags);
        } else {
            return $this->redirect('notfound');
        }
    }

    public function store(NewsRequest $request)
    {
        $request->validated();
        $data = request()->all();
        $data['status'] = isset($data['status'])?1:0;
        $data['is_featured'] = isset($data['is_featured'])?1:0;
        $data['published_on'] = !empty($data['published_on'])?$this->parse_date_time($data['published_on']):date('Y-m-d H:i:s');
        $data['priority'] = (!empty($data['priority']))?$data['priority']:0;

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
                    ->withErrors("Ooops..Something wrong happend.Please try again.") // send back all errors to the login form
                    ->withInput(request()->all());
        }
    }

    public function GetType(Request $request)
    {
        $type = $request->query('type');
        $slug = $request->query('slug');
        $name = $request->query('name');
        $currentType = $request->query('currentType');

        if (($currentType == "en_draft" && $type == "en") || ($currentType == "en" && $type == "en_draft")) {

            $draft = News::where('slug', $slug)->where('type', "en_draft")->first();
            $en = News::where('slug', $slug)->where('type', "en")->first();

            if ($draft && $en) {

                $draft->type = "en";
                $draft->save();

                $en->type = "en_draft";
                $en->save();

                return response()->json([
                    'redirect_url' => route('admin.news.edit', ['id' => encrypt($draft->id)])
                ]);
            }

        }

        if (($currentType === "ar_draft" && $type === "ar") || ($currentType === "ar" && $type === "ar_draft")) {
            $draft = News::where('slug', $slug)->where('type', "ar_draft")->first();
            $ar = News::where('slug', $slug)->where('type', "ar")->first();

            if ($draft && $ar) {
                $draft->type = "ar";
                $draft->save();

                $ar->type = "ar_draft";
                $ar->save();

                return response()->json([
                    'redirect_url' => route('admin.news.edit', ['id' => encrypt($draft->id)])
                ]);
            }

        }

        $existingPage = News::where('type', $type)->where('slug', $slug)->first();

        if ($existingPage) {
            return response()->json([
                'redirect_url' => route('admin.news.edit', ['id' => encrypt($existingPage->id)])
            ]);
        } else {

            $existingId = News::where('slug', $slug)->where('type', 'en')->pluck('id')->first();

            if ($existingId) {
                $page = News::find($existingId);

                if ($page) {
                    $newPage = $page->replicate();
                    $newPage->slug = $slug;
                    $newPage->title = $name;
                    $newPage->type = $type;
                    $newPage->save();

                    return response()->json([
                        'redirect_url' => route('admin.news.edit', ['id' => encrypt($newPage->id)])
                    ]);
                }

            }

        }
    }

}
