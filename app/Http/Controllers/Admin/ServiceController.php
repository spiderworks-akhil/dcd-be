<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController as Controller;
use App\Http\Requests\Admin\ServiceRequest;
use App\Traits\ResourceTrait;
use App\Models\Service;
use Illuminate\Http\Request;
use View, Redirect;

class ServiceController extends Controller
{
    use ResourceTrait;

    public function __construct()
    {
        parent::__construct();

        $this->model = new Service;
        $this->route .= '.services';
        $this->views .= '.services';

        $this->permissions = ['list'=>'service_listing', 'create'=>'service_adding', 'edit'=>'service_editing', 'delete'=>'service_deleting'];
        $this->resourceConstruct();

    }

    public function index(Request $request, $parent=null)
    {
        if ($request->ajax()) {
            $collection = $this->getCollection();
            $parent_id = ($parent)?$parent:0;
            $collection->where('services.parent_id', '=', $parent_id);
            $route = $this->route;
            return $this->setDTData($collection)->make(true);
        } else {
            $parent_data = null;
            if($parent)
                $parent_data = $this->model->find($parent);
            $search_settings = $this->getSearchSettings();
            return view::make($this->views . '.index', array('parent'=>$parent, 'parent_data'=>$parent_data, 'search_settings'=>$search_settings));
        }
    }
    
    protected function getCollection() {
        return $this->model->select('id', 'name', 'slug', 'parent_id', 'title', 'priority', 'status', 'created_at', 'updated_at');
    }

    protected function setDTData($collection) {
        $route = $this->route;
        return $this->initDTData($collection)
        	->addColumn('sub-services', function($obj) use ($route) {
                $has_child = $this->model->where('parent_id', '=', $obj->id)->count();
                return '<a href="' . route( $route . '.index',  [$obj->id] ) . '" class="btn btn-info btn-sm" >Sub-services (' . $has_child . ')</a>'; 
            })
            ->addColumn('action_delete_category', function($obj) use ($route) {
                if(auth()->user()->can($this->permissions['delete'])){
                    $has_child = $this->model->where('parent_id', '=', $obj->id)->count();
                    if($has_child)
                    {
                        return '<a href="javascript:void(0);" class= "text-danger delete_have_child" title="Created at : ' . date('d/m/Y - h:i a', strtotime($obj->created_at)) . '" > <i class="fa fa-trash"></i></button>';
                    }
                    else{
                        return '<a href="' . route( $route . '.destroy',  [encrypt($obj->id)] ) . '" class="text-danger webadmin-btn-warning-popup" data-message="Are you sure to delete?  Associated data will be removed if it is deleted." title="' . ($obj->updated_at ? 'Last updated at : ' . date('d/m/Y - h:i a', strtotime($obj->updated_at)) : '') . '" ><i class="fa fa-trash"></i></a>';  
                    }
                }
                else
                    return '<a href="javascript:void(0)" class="text-secondary" title="You have no permission to delete" ><i class="fa fa-trash"></i></a>';
            })
            ->rawColumns(['action_edit', 'action_delete_category', 'status', 'sub-services']);
    }

    protected function getSearchSettings(){}

    public function create($parent=null)
    {
        $parent_data = null;
        if($parent)
            $parent_data = $this->model->find($parent);
        $services = $this->model->where('parent_id',0)->get();
        return View::make($this->views . '.form', array('obj'=>$this->model, 'parent'=>$parent, 'parent_data'=>$parent_data, 'services'=>$services));

    }

    public function store(ServiceRequest $request)
    {
        $request->validated();
        $data = request()->all();
        if(Config('admin.services.sections') && !empty($data['content'])){
            $data['content'] = json_encode($data['content']);
        }
        return $this->_store($data);
    }

    public function edit($id) {
    	$id = decrypt($id);
        if($obj = $this->model->find($id)){
            $parent = null;
            if($obj->parent_id >0)
                $parent = $obj->parent_id;
            $parent_data = $this->model->where('parent_id', $obj->parent_id)->first();
            $services = $this->model->where('parent_id',0)->get();
            return view($this->views . '.form')->with('obj', $obj)->with('parent', $parent)->with('parent_data', $parent_data)->with('services', $services);
        } else {
            return $this->redirect('notfound');
        }
    }

    public function update(ServiceRequest $request)
    {
        $request->validated();
        $data = request()->all();
    	$id = decrypt($data['id']);
        if(Config('admin.services.sections') && !empty($data['content'])){
            $data['content'] = json_encode($data['content']);
        }
        return $this->_update($id, $data);
    }
}
