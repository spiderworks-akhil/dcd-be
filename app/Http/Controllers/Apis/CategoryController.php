<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;
use App\Http\Resources\Category as CategoryResource;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\CategoryDetail;

class CategoryController extends Controller
{
    
    public function detail($slug,Request $request)
    {
        $data = $request->all();
        $type = !empty($data['language']) ? $data['language'] : "en";
        $category = Category::where('slug', $slug)->where('type', $type)->first();
        if(empty($category)){
            return response()
                ->json(['error' => 'Category not found'], 404);
        }
        $events = Event::where('category_id', $category->id)->where('status',1)->where('type', $type)->get();
        if($category->children){
            foreach ($category->children as $child) {
                $events = $events->merge(Event::where('category_id', $child->id)->where('status',1)->get());
            }
        }
        $category->events = $events;
        return new CategoryDetail($category);
    }
   
}
