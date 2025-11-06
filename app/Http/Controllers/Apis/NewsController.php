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
            $news = News::where('status', 1)->where('type',$type);
            if(!empty($data['category_id'])){
                $news = $news->where('category_id', $data['category_id']);
            }
            $news = $news->orderBy('published_on', 'DESC')->paginate($limit);
            return new NewsListingCollection($news);
        }
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function categories(Request $request){
        $data = $request->all();
        $type = !empty($data['language'])?$data['language']:"en";
        $categories = Category::where('status', 1)
            ->where('category_type', 'News')
            ->where('type',$type)
            ->get();
        return new CategoryCollection($categories);
    }

    public function featured(Request $request){
        $data = $request->all();
        $type = !empty($data['language'])?$data['language']:"en";
        $services = News::where('status', 1)->where('type',$type)->where('is_featured', 1)->orderBy('priority','asc')->get();
        return new NewsListingCollection($services);
    }

    // public function view(Request $request, $slug){
    //     try{
    //         $data = $request->all();
    //         $type = !empty($data['language'])?$data['language']:"en";
    //         $news = News::where('slug', $slug)->where('type',$type)->where('status', 1)->first();
    //         if(!$news)
    //             return response()->json(['error' => 'Not found'], 404);

    //         $news->related_news = News::where('id', '!=', $news->id)->orderBy('published_on', 'DESC')->take(5)->get();
    //         return new NewsResource($news);
    //     }
    //     catch(\Exception $e){
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }
    
  public function view(Request $request, $slug){
        try{
            $data = $request->all();
            $type = !empty($data['language'])?$data['language']:"en";
            $news = News::where('slug', $slug)->where('type',$type);

            $query = News::where('slug', $slug)->where('type', $type);

            if (!in_array($type, ['en_draft', 'ar_draft'])) {
                $query->where('status', 1);
            }

            $news = $query->first();
                if(!$news)
                    return response()->json(['error' => 'Not found'], 404);

                $news->related_news = News::where('id', '!=', $news->id)->orderBy('published_on', 'DESC')->where('status', 1)->take(5)->get();
                return new NewsResource($news);
            }
            catch(\Exception $e){
                return response()->json(['error' => $e->getMessage()], 500);
            }
    }


   
}
