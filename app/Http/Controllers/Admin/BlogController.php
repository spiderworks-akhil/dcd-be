<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController as Controller;
use App\Http\Requests\Admin\BlogRequest;
use App\Models\Blog;

use App\Models\Category;
use App\Models\Tag;
use App\Traits\ResourceTrait;
use Illuminate\Http\Request;
use view, Redirect;

class BlogController extends Controller
{
    use ResourceTrait;

    public function __construct()
    {
        parent::__construct();

        $this->model = new Blog;
        $this->route .= '.blogs';
        $this->views .= '.blogs';

        $this->permissions = ['list'=>'blog_listing', 'create'=>'blog_adding', 'edit'=>'blog_editing', 'delete'=>'blog_deleting'];
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
        return $this->model->select('id', 'slug', 'name', 'title', 'status', 'priority', 'created_at', 'updated_at');
    }

    protected function setDTData($collection) {
        $route = $this->route;
        return $this->initDTData($collection)
            ->rawColumns(['action_edit', 'action_delete', 'status']);
    }

    protected function getSearchSettings(){}

    public function create()
    {
        $categories = Category::where('parent_id',0)->where('category_type', 'Blog')->get();
        $tags = Tag::all();
        return view::make($this->views . '.form', array('obj'=>$this->model, 'categories'=>$categories, 'tags'=>$tags));
    }

    public function edit($id) {
        $id = decrypt($id);
        if($obj = $this->model->find($id)){
            $categories = Category::where('parent_id',0)->where('category_type', 'Blog')->get();
            $tags = Tag::all();
            return view($this->views . '.form')->with('obj', $obj)->with('categories', $categories)->with('tags', $tags);
        } else {
            return $this->redirect('notfound');
        }
    }

    public function store(BlogRequest $request)
    {
        $request->validated();
        $data = request()->all();
        $data['status'] = isset($data['status'])?1:0;
        $data['is_featured'] = isset($data['is_featured'])?1:0;
        $data['published_on'] = !empty($data['published_on'])?$this->parse_date_time($data['published_on']):date('Y-m-d H:i:s');
        $data['priority'] = (!empty($data['priority']))?$data['priority']:0;

        if (is_array($data['content'])) {
            $data['content'] = json_encode($data['content']);
        }

        $this->model->fill($data);

        if($this->model->save())
        {
            if(!empty($data['tags']))
                $this->model->tags()->attach($data['tags']);
        }
        return Redirect::to(route($this->route. '.edit', ['id'=> encrypt($this->model->id)]))->withSuccess('Blog successfully saved!');
    }

    public function update(BlogRequest $request)
    {
        $request->validated();
        $data = request()->all();
        $id = decrypt($data['id']);
         if($obj = $this->model->find($id)){
            $data['status'] = isset($data['status'])?1:0;
            $data['is_featured'] = isset($data['is_featured'])?1:0;
            $data['published_on'] = !empty($data['published_on'])?$this->parse_date_time($data['published_on']):date('Y-m-d H:i:s');
            $data['priority'] = (!empty($data['priority']))?$data['priority']:0;
            if($obj->update($data))
            {
                if(!empty($data['tags']))
                    $obj->tags()->sync($data['tags']);
            }

            return Redirect::to(route($this->route. '.edit', ['id'=>encrypt($id)]))->withSuccess('Blog successfully updated!');
        } else {
            return Redirect::back()
                    ->withErrors("Ooops..Something wrong happend.Please try again.") // send back all errors to the login form
                    ->withInput(request()->all());
        }
    }
}
