<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController as Controller;
use App\Http\Requests\Admin\PartnerRequest;
use App\Traits\ResourceTrait;
use App\Models\Partner;

class PartnerController extends Controller
{
    use ResourceTrait;

    public function __construct()
    {
        parent::__construct();

        $this->model = new Partner;
        $this->route .= '.partners';
        $this->views .= '.partners';

        $this->permissions = ['list'=>'partner_listing', 'create'=>'partner_adding', 'edit'=>'partner_editing', 'delete'=>'partner_deleting'];
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

    public function store(PartnerRequest $request)
    {
        $request->validated();
        return $this->_store($request->all());
    }

    public function update(PartnerRequest $request)
    {
        $request->validated();
        $id = decrypt($request->id);
        return $this->_update($id, $request->all());
    }

}
