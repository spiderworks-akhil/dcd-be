<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use App\Models\Category;
use App\Http\Resources\Blog as BlogResource;
use App\Http\Resources\BlogListingCollection;
use App\Http\Resources\CategoryCollection;

class BlogController extends Controller
{
    public function index(Request $request){
        try{
            $data = $request->all();
            $limit = !empty($data['limit'])?(int)$data['limit']:10;
            $blogs = Blog::with(['featured_image', 'category'])->where('status', 1);
            if(!empty($data['categories'])){
                $blogs->whereIn('category_id', $data['categories']);
            }
            $blogs = $blogs->orderBy('published_on', 'DESC')->paginate($limit);
            return new BlogListingCollection($blogs);
        }
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function categories(Request $request){
        try{
            $categories = Category::where('category_type', 'Blog')->where('status', 1)->orderBy('name')->get();
            return new CategoryCollection($categories);
        }
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function view(Request $request, $slug){
        try{
            $data = $request->all();
            $blog = Blog::with(['featured_image', 'banner_image', 'og_image', 'category', 'tags'])->where('slug', $slug)->where('status', 1)->first();
            if(!$blog)
                return response()->json(['error' => 'Not found'], 404);

            $category_id = $blog->category_id;
            $blog->related_blogs = Blog::with(['featured_image', 'tags'])->where('category_id', $category_id)->where('id', '!=', $blog->id)->orderBy('published_on', 'DESC')->take(5)->get();
            return new BlogResource($blog);
        }
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
