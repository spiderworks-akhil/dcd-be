<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Partner;
use App\Http\Resources\Partner as PartnerResource;
use App\Http\Resources\PartnerCollection;

class PartnerController extends Controller
{
    public function index(Request $request){
        try{
            $data = $request->all();
            $limit = !empty($data['limit'])?(int)$data['limit']:10;
            $partners = Partner::where('status', 1);
            $partners = $partners->orderBy('priority', 'DESC')->paginate($limit);
            return new PartnerCollection($partners);
        }
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function featured(){
        $partners = Partner::select('slug','name','title','id','featured_image_id')->with(['featured_image'])->where('status', 1)->where('is_featured', 1)->orderBy('priority','DESC')->get();
        return new PartnerCollection($partners);
    }


    public function view(Request $request, $slug){
        try{
            $data = $request->all();
            $partner = Partner::with(['featured_image','department'])->where('slug', $slug)->where('status', 1)->first();
            if(!$partner)
                return response()->json(['error' => 'Not found'], 404);
            return new PartnerResource($partner);
        }
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
