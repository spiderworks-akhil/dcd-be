<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController as Controller;
use App\Http\Requests\Admin\AuthorRequest;
use App\Traits\ResourceTrait;
use App\Models\Author;

class AuthorController extends Controller
{
    use ResourceTrait;

    public function __construct()
    {
        parent::__construct();

        $this->model = new Author;
        $this->route .= '.authors';
        $this->views .= '.authors';

        $this->permissions = ['list'=>'author_listing', 'create'=>'author_adding', 'edit'=>'author_editing', 'delete'=>'author_deleting'];
        $this->resourceConstruct();

    }
    
    protected function getCollection() {
        return $this->model->select('id', 'name', 'designation', 'status', 'created_at', 'updated_at');
    }

    protected function setDTData($collection) {
        $route = $this->route;
        return $this->initDTData($collection)
            ->rawColumns(['action_edit', 'action_delete', 'status']);
    }

    protected function getSearchSettings(){}

    public function store(AuthorRequest $request)
    {
        $request->validated();
        return $this->_store($request->all());
    }

    public function update(AuthorRequest $request)
    {
        $request->validated();
        $id = decrypt($request->id);
        return $this->_update($id, $request->all());
    }
}
