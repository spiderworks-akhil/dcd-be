<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseController as Controller;
use App\Http\Requests\Admin\TestimonialRequest;
use App\Traits\ResourceTrait;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    use ResourceTrait;
    
    public function __construct()
    {
        parent::__construct();

        $this->model = new Testimonial;
        $this->route .= '.testimonials';
        $this->views .= '.testimonials';
        
        $this->permissions = ['list'=>'testimonial_listing', 'create'=>'testimonial_adding', 'edit'=>'testimonial_editing', 'delete'=>'testimonial_deleting'];
        
        $this->resourceConstruct();

    }

    protected function getCollection() {
        return $this->model->select('id', 'name', 'status', 'designation', 'priority', 'created_at', 'updated_at');
        
    }

    protected function setDTData($collection) 
    {
        return $this->initDTData($collection)
            ->rawColumns(['action_edit', 'action_delete', 'status']);
    }

    protected function getSearchSettings(){}


    public function store(TestimonialRequest $request)
    {
        $request->validated();
        $data = request()->all();
        $data = $this->formatCommentInput($data);
        return $this->_store($data);
    }

    public function formatCommentInput($data)
    {
        if($data['comment_type'] == 'Text')
        {
            $data['youtube_link'] = null;
            $data['video_link_id'] = null;
        }
        elseif($data['comment_type'] == 'Youtube Video')
        {
            $data['comment'] = null;
            $data['video_link_id'] = null;
        }
        elseif($data['comment_type'] == 'Video from Computer')
        {
            $data['comment'] = null;
            $data['youtube_link'] = null;
        }
        return $data;
    }

    public function update(TestimonialRequest $request)
    {
        $request->validated();
        $data = request()->all();
        $id =  decrypt($data['id']);
        $data = $this->formatCommentInput($data);
        return $this->_update($id, $data);
    }
}
