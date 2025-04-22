<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController as Controller;
use App\Traits\ResourceTrait;

use App\Models\Listing;
use App\Models\ListingContent;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Redirect;

class ListigItemController extends Controller
{
    use ResourceTrait;

    public function __construct()
    {
        parent::__construct();

        $this->model = new ListingContent;
        $this->route .= '.listing-items';
        $this->views .= '.listing_items';

        $this->permissions = ['list'=>'listing_listing', 'create'=>'listing_adding', 'edit'=>'listing_editing', 'delete'=>'listing_deleting'];
        $this->resourceConstruct();

    }

    public function index($listing_id)
    {
        if (request()->ajax()) {
            $collection = $this->getCollection();
            $collection->where('listing_id', $listing_id);
            return $this->setDTData($collection)->make(true);
        } else {
            $search_settings = $this->getSearchSettings();
            $listing = Listing::find($listing_id);
            return view($this->views . '.index')->with('listing', $listing)->with('search_settings', $search_settings);
        }
    }

    protected function getCollection() {
        return $this->model->select('listing_contents.*', 'medias.file_path')
                            ->leftJoin('medias', 'medias.id', '=', 'listing_contents.media_id');
    }

    protected function setDTData($collection) {
        return $this->initDTData($collection)
            ->editColumn('image', function($obj){
                if($obj->file_path)
                    return '<a href="'.asset($obj->file_path).'" target="_blank"><img src="'.asset($obj->file_path).'" style="width:20px"/></a>';
                else
                    return '';
            })
            ->editColumn('short_description', function($obj){
                return Str::limit($obj->short_description, 50, ' ...');
            })
            ->editColumn('detailed_description', function($obj){
                return Str::limit(strip_tags($obj->detailed_description), 50, ' ...');
            })
            ->rawColumns(['action_edit', 'action_delete', 'status', 'image']);
    }

    public function create($listing_id)
    {
        $listing = Listing::find($listing_id);
        if(!$listing)
            return abort('404');
        return view($this->views . '.form')->with('obj', $this->model)->with('listing', $listing);
    }

    public function edit($id) {
        $id =  decrypt($id);
        if($obj = $this->model->find($id)){
            $listing = Listing::find($obj->listing_id);
            return view($this->views . '.form')->with('obj', $obj)->with('listing', $listing);
        } else {
            return $this->redirect('notfound');
        }
    }

    protected function getSearchSettings(){}

    public function store(Request $request)
    {
        return $this->_store($request->all());
    }

    public function update(Request $request)
    {
        $id = decrypt($request->id);
        return $this->_update($id, $request->all());
    }

}