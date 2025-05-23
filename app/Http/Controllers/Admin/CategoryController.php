<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController as Controller;
use App\Http\Requests\Admin\CategoryRequest;
use App\Traits\ResourceTrait;
use App\Models\Category;
use Illuminate\Http\Request;
use View;

class CategoryController extends Controller
{
    use ResourceTrait;

    public function __construct()
    {
        parent::__construct();

        $this->model = new Category;
        $this->route .= '.categories';
        $this->views .= '.categories';

        $this->permissions = ['list'=>'category_listing', 'create'=>'category_adding', 'edit'=>'category_editing', 'delete'=>'category_deleting'];
        $this->resourceConstruct();

    }

    public function index(Request $request, $parent=null)
    {
        if ($request->ajax()) {
            $collection = $this->getCollection();
            $parent_id = ($parent)?$parent:0;
            $collection->where('categories.parent_id', '=', $parent_id);
            $route = $this->route;
            return $this->setDTData($collection)->make(true);
        } else {
            $parent_data = null;
            if($parent)
                $parent_data = $this->model->find($parent);
            $search_settings = $this->getSearchSettings();
            return View::make($this->views . '.index', array('parent'=>$parent, 'parent_data'=>$parent_data, 'search_settings'=>$search_settings));
        }
    }
    
    protected function getCollection() {
        return $this->model->select('id', 'type', 'name', 'parent_id', 'priority', 'title', 'category_type', 'status', 'created_at', 'updated_at');
    }

    protected function getSearchSettings(){}

    protected function setDTData($collection) {
        $route = $this->route;
        return $this->initDTData($collection)
        	->addColumn('sub-categories', function($obj) use ($route) {
                $has_child = $this->model->where('parent_id', '=', $obj->id)->count();
                return '<a href="' . route( $route . '.index',  [$obj->id] ) . '" class="btn btn-info btn-sm" >Sub-Categories (' . $has_child . ')</a>'; 
            })
            ->addColumn('action_delete_category', function($obj) use ($route) { 
                if(auth()->user()->can($this->permissions['delete']))
                {
                    $has_child = $this->model->where('parent_id', '=', $obj->id)->count();
                    if($has_child)
                    {
                        return '<a href="javascript:void(0);" class= "text-danger delete_have_child" title="Created at : ' . date('d/m/Y - h:i a', strtotime($obj->created_at)) . '" > <i class="fa fa-trash"></i></button>';
                    }
                    else{
                        return '<a href="' . route( $route . '.destroy',  [$obj->id] ) . '" class="text-danger webadmin-btn-warning-popup" data-message="Are you sure to delete?  Associated data will be removed if it is deleted." title="' . ($obj->updated_at ? 'Last updated at : ' . date('d/m/Y - h:i a', strtotime($obj->updated_at)) : '') . '" ><i class="fa fa-trash"></i></a>';  
                    }
                }
                else
                    return '<a href="javascript:void(0)" class="text-secondary" title="You have no permission to delete" ><i class="fa fa-trash"></i></a>';
            })
            ->rawColumns(['action_edit', 'action_delete_category', 'status', 'sub-categories']);
    }

    public function create($parent=null)
    {
        $parent_data = null;
        if($parent)
            $parent_data = $this->model->find($parent);
        $categories = $this->model->where('parent_id',0)->get();
        return View::make($this->views . '.form', array('obj'=>$this->model, 'parent'=>$parent, 'parent_data'=>$parent_data, 'categories'=>$categories));
    }

    public function edit($id) {
    	$id = decrypt($id);
        if($obj = $this->model->find($id)){
            $parent = null;
            if($obj->parent_id >0)
                $parent = $obj->parent_id;
            $parent_data = $this->model->where('parent_id', $obj->parent_id)->first();
            $categories = $this->model->where('parent_id',0)->get();
            return view($this->views . '.form')->with('obj', $obj)->with('parent', $parent)->with('parent_data', $parent_data)->with('categories', $categories);
        } else {
            return $this->redirect('notfound');
        }
    }

    public function store(CategoryRequest $request)
    {
        $request->validated();
        return $this->_store($request->all());
    }

    public function update(CategoryRequest $request)
    {
        $request->validated();
        $id = decrypt($request->id);
        return $this->_update($id, $request->all());
    }


    public function GetType(Request $request)
    {
        $type = $request->query('type');
        $slug = $request->query('slug');
        $name = $request->query('name');
        $currentType = $request->query('currentType');

        if (($currentType == "en_draft" && $type == "en") || ($currentType == "en" && $type == "en_draft")) {

            $draft = Category::where('slug', $slug)->where('type', "en_draft")->first();
            $en = Category::where('slug', $slug)->where('type', "en")->first();

            if ($draft && $en) {

                $draft->type = "en";
                $draft->save();

                $en->type = "en_draft";
                $en->save();

                return response()->json([
                    'redirect_url' => route('admin.categories.edit', ['id' => encrypt($draft->id)])
                ]);
            }

        }

        if (($currentType === "ar_draft" && $type === "ar") || ($currentType === "ar" && $type === "ar_draft")) {
            $draft = Category::where('slug', $slug)->where('type', "ar_draft")->first();
            $ar = Category::where('slug', $slug)->where('type', "ar")->first();

            if ($draft && $ar) {
                $draft->type = "ar";
                $draft->save();

                $ar->type = "ar_draft";
                $ar->save();

                return response()->json([
                    'redirect_url' => route('admin.categories.edit', ['id' => encrypt($draft->id)])
                ]);
            }

        }

        $existingPage = Category::where('type', $type)->where('slug', $slug)->first();

        if ($existingPage) {
            return response()->json([
                'redirect_url' => route('admin.categories.edit', ['id' => encrypt($existingPage->id)])
            ]);
        } else {

            $existingId = Category::where('slug', $slug)->where('type', 'en')->pluck('id')->first();

            if ($existingId) {
                $page = Category::find($existingId);

                if ($page) {
                    $newPage = $page->replicate();
                    $newPage->slug = $slug;
                    $newPage->title = $name;
                    $newPage->type = $type;
                    $newPage->save();

                    return response()->json([
                        'redirect_url' => route('admin.categories.edit', ['id' => encrypt($newPage->id)])
                    ]);
                }

            }

        }
    }
}
