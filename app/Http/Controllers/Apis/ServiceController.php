<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Http\Resources\Service as ServiceResource;
use App\Http\Resources\ServiceCollection;

class ServiceController extends Controller
{
    public function index(Request $request){
        try{
            $data = $request->all();
            $limit = !empty($data['limit'])?(int)$data['limit']:10;
            $services = Service::where('status', 1);
            $services = $services->orderBy('priority', 'DESC')->paginate($limit);
            return new ServiceCollection($services);
        }
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function featured(){
        $services = Service::select('name','title','short_description','id','slug','featured_image_id','banner_image_id')->with(['featured_image','banner_image'])->where('status', 1)->where('is_featured', 1)->orderBy('priority','DESC')->get();
        return new ServiceCollection($services);
    }


    public function view(Request $request, $slug){
        try{
            $data = $request->all();
            $service = Service::with(['featured_image','banner_image'])->where('slug', $slug)->where('status', 1)->first();
            if(!$service)
                return response()->json(['error' => 'Not found'], 404);
            return new ServiceResource($service);
        }
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
