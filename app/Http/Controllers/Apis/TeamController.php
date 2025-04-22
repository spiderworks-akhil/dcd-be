<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Team;
use App\Http\Resources\Team as TeamResource;
use App\Http\Resources\TeamCollection;

class TeamController extends Controller
{
    public function index(Request $request){
        try{
            $data = $request->all();
            $limit = !empty($data['limit'])?(int)$data['limit']:10;
            $teams = Team::where('status', 1);
            $teams = $teams->orderBy('priority', 'DESC')->paginate($limit);
            return new TeamCollection($teams);
        }
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function featured(){
        $teams = Team::select('name','title','short_description','id','slug','featured_image_id','designation')->with(['featured_image'])->where('status', 1)->where('is_featured', 1)->orderBy('priority','DESC')->get();
        return new TeamCollection($teams);
    }


    public function view(Request $request, $slug){
        try{
            $data = $request->all();
            $team = Team::with(['featured_image','department'])->where('slug', $slug)->where('status', 1)->first();
            if(!$team)
                return response()->json(['error' => 'Not found'], 404);
            return new TeamResource($team);
        }
        catch(\Exception $e){
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
