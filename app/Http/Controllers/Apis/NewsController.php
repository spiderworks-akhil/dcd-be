<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use App\Models\Category;
use App\Http\Resources\News as NewsResource;
use App\Http\Resources\NewsListingCollection;
use App\Http\Resources\CategoryCollection;

class NewsController extends Controller
{
    public function index(Request $request){
        try{
            $data = $request->all();
            $limit = !empty($data['limit'])?(int)$data['limit']:10;
            $type = !empty($data['language'])?$data['language']:"en";
            $news = News::with(['featured_image'])->where('status', 1);
            $news = $news->orderBy('published_on', 'DESC')->where('type',$type)->paginate($limit);
            return new NewsListingCollection($news);
        }
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function featured(Request $request){
        $data = $request->all();
        $type = !empty($data['language'])?$data['language']:"en";
        $services = News::where('status', 1)->where('type',$type)->where('is_featured', 1)->orderBy('priority','asc')->get();
        return new NewsListingCollection($services);
    }

    public function view(Request $request, $slug){
        try{
            $data = $request->all();
            $type = !empty($data['language'])?$data['language']:"en";
            $news = News::where('slug', $slug)->where('type',$type)->where('status', 1)->first();
            if(!$news)
                return response()->json(['error' => 'Not found'], 404);

            $news->related_news = News::where('id', '!=', $news->id)->orderBy('published_on', 'DESC')->take(5)->get();
            return new NewsResource($news);
        }
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

}
