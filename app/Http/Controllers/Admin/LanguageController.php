<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Language;
use App\Traits\ResourceTrait;
use App\Http\Requests\Admin\PartnerRequest;
use App\Http\Controllers\Admin\BaseController as Controller;

class LanguageController extends Controller
{
    use ResourceTrait;

    public function __construct()
    {
        parent::__construct();

        $this->model = new Language;
        $this->route .= '.languages';
        $this->views .= '.languages';

        $this->permissions = ['list'=>'language_listing', 'create'=>'language_adding', 'edit'=>'language_editing', 'delete'=>'language_deleting'];
        $this->resourceConstruct();

    }
    
    protected function getCollection() {
        return $this->model->select('id', 'name', 'status', 'created_at', 'updated_at');
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
