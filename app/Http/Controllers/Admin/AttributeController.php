<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController as Controller;
use App\Traits\ResourceTrait;
use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\AttributeValueImage;
use App\Http\Requests\Admin\AttributeRequest;
use  Redirect, DB, Validator;

class AttributeController extends Controller
{
    use ResourceTrait;

    public function __construct()
    {
        parent::__construct();

        $this->model = new AttributeValue;
        $this->route .= '.attribute-values';
        $this->views .= '.attribute-values';

        $this->permissions = ['list'=>'attribute_values_listing', 'create'=>'attribute_values_adding', 'edit'=>'attribute_values_editing', 'delete'=>'attribute_values_deleting'];
        $this->resourceConstruct();

    }


    public function index(Request $request,$id=null)
	{
        if ($request->ajax()) {
            $collection = $this->getCollection();
            $collection = $collection->where('attribute_values.attribute_id',$id);
            return $this->setDTData($collection)->make(true);
        } else {
            $search_settings = $this->getSearchSettings();
			return view($this->views . '.index')->with('search_settings', $search_settings)->with('id',$id);
        }
	}

    protected function getCollection() {
        return $this->model->select('id', 'slug', 'name', 'priority', 'status', 'created_at', 'updated_at','attribute_id');
    }

    protected function setDTData($collection) {
        $route = $this->route;
        return $this->initDTData($collection)
            ->rawColumns(['action_ajax_edit', 'action_delete', 'status']);
    }

    protected function getSearchSettings(){}

    public function show($id)
    {
        $this->edit($id);
    }

    public function edit($id) {
        $id = decrypt($id);
        if($obj = $this->model->find($id)){
            return view($this->views . '.edit')->with('obj', $obj);
        } else {
            return $this->redirect('notfound');
        }
    }

    public function create()
	{
		return view($this->views . '.form')->with('obj', $this->model);
	}

    public function store(Request $request)
    {

        $data = $request->all();

        $validator = Validator::make($data, [
            'name.*' => 'required|max:250',
            'priority.*' => 'required|max:250',
        ]);
       
        $names  = $data['name'];
        $priorities  = $data['priority'];

        foreach ($names as $index => $name) {

            $attribute = new AttributeValue();
            
            $item = [
                'name' => $name,
                'priority' => $priorities[$index],
            ];

            $attribute->fill($item);   
            $attribute->attribute_id = $request->id; 
            $attribute->save();
        }
        
        $this->clear_cache();
        return Redirect::to(route($this->route. '.index',[$request->id]))->withSuccess('Permissions successfully saved!'); 
    }

    public function update(Request $request)
    {
        $data = $request->all();

        $id = decrypt($data['id']);

        $validator = Validator::make($data, [
            'name' => 'required|max:250',
            'priority' => 'required|max:250',
        ]);

        if ($validator->fails()){
            return response()->json(['error'=>'Oops!! look like you have missed some important data, please check.']);
        }
        else
        {
            if($obj = $this->model->find($id)){
                
                $obj->name = $data['name'];
                $obj->priority = $data['priority'];
                $obj->save();
                $this->clear_cache();

                return redirect()->back();
            } else {
                return response()->json(['error'=>'Oops!! something went wrong...Please try again.']);
            }
        }
    }

    public function AddAttributeValueImages(Request $request)
    {
        $data = $request->all();

        $id = decrypt($data['id']);

        $attribute = new AttributeValueImage;
        $attribute->attribute_value_id_1 = $data['attribute_value_1'] ?? 0;
        $attribute->attribute_value_id_2 =  $data['attribute_value_2'] ?? 0;
        $attribute->attribute_value_id_3 =  $data['attribute_value_3'] ?? 0;
        $attribute->product_id =  $id;
        $attribute->attribute_value_image_id   =  $data['attribute_value_image_id'];
        $attribute->save();

        return  redirect()->back();
    }

}
