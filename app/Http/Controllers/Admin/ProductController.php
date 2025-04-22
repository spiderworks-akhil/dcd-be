<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Models\Attribute;
use Illuminate\Http\Request;
use App\Traits\ResourceTrait;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests\Admin\ProductRequest;
use App\Http\Controllers\Admin\BaseController as Controller;

class ProductController extends Controller
{
    use ResourceTrait;

    public function __construct()
    {
        parent::__construct();

        $this->model = new Product;
        $this->route .= '.products';
        $this->views .= '.products';

        $this->permissions = ['list'=>'product_listing', 'create'=>'product_adding', 'edit'=>'product_editing', 'delete'=>'product_deleting'];
        $this->resourceConstruct();

    }

    protected function getCollection() {
        return $this->model->select('id', 'slug', 'name', 'title', 'priority', 'status', 'created_at', 'updated_at');
    }

    protected function setDTData($collection) {
        $route = $this->route;
        return $this->initDTData($collection)
            ->rawColumns(['action_edit', 'action_delete', 'status']);
    }

    protected function getSearchSettings(){}

    public function create()
    {
        $categories = Category::where('category_type','Product')->where('status',1)->get();
        $brands = Category::where('category_type','Brand')->where('parent_id','1')->where('status',1)->get();

        return view($this->views . '.form')->with('obj', $this->model)->with('categories', $categories)->with('brands', $brands);
    }

    public function store(ProductRequest $request)
    {
        $request->validated();
        return $this->_store($request->all());
    }

    public function edit($id) {

        $id = decrypt($id);
        if($obj = $this->model->find($id)){

            $categories = Category::where('category_type','Product')->where('status',1)->get();
            $brands = Category::where('category_type','Brand')->where('parent_id','1')->where('status',1)->get();

            return view($this->views . '.form')->with('obj', $obj)->with('categories', $categories)->with('brands', $brands);

        } else {
            return $this->redirect('notfound');
        }
    }

    public function update(ProductRequest $request)
    {
        $request->validated();
        $id = decrypt($request->id);
        $data = request()->all();

        if($obj = $this->model->find($id)){

            $data['is_featured'] = isset($data['is_featured'])?1:0;
            $data['priority'] = (!empty($data['priority']))?$data['priority']:0;

        	$obj->update($data);

            return $this->redirect('updated','success', 'edit', [encrypt($obj->id)]);

        } else {

            return $this->redirect('notfound');

        }
    }

}
