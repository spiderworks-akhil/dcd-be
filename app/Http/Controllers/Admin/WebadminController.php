<?php

namespace App\Http\Controllers\Admin;

use App\Models\News;
use App\Models\Page;
use App\Models\User;
use App\Models\Widget;
use App\Models\Setting;
use App\Events\LoginHistory;
use App\Models\FrontendPage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Event;
use Illuminate\Support\Facades\Hash;
use Input, View, Validator, Redirect, Auth, DB, Session, Config;

class WebadminController extends Controller {

    public function __construct(){
        $this->middleware('permission:widgets', ['only' => ['widgets','save_widget']]);
    }
	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
        $front_end_pages = FrontendPage::where('status',1)->count();
        $news_en = News::where('status',1)->where('type','en')->count();
        $news_ar = News::where('status',1)->where('type','ar')->count();
        $events_en = Event::where('status',1)->where('type','en')->count();
        $events_ar = Event::where('status',1)->where('type','ar')->count();

        $recent_news_en = News::with('category','featured_image')->where('status',1)->where('type','en')->limit('3')->orderBy('created_at','desc')->get();
        $recent_news_ar = News::with('category','featured_image')->where('status',1)->where('type','ar')->limit('3')->orderBy('created_at','desc')->get();

        $blogs = Blog::where('status',1)->count();

		return view('admin.index',compact('front_end_pages','news_en','blogs','news_ar','events_en','events_ar','recent_news_en','recent_news_ar'));
	}

    public function MediaCentre() {
        return view('admin.media_centre.index');
    }

	public function login()
	{
		if(Auth::guard('admin')->user())
		{
            $admin_url = Config::get('admin.url_prefix').'/dashboard';
			return Redirect::to($admin_url);
		}
		else{
			return view('admin.login');
		}
	}

    public function google_login(Request $request){
        $id_token = $request->credential;
        $google_client_id = Setting::where('code', 'google_auth_client_id')->value('value_text');
        $guzzleClient = new \GuzzleHttp\Client(array( 'curl' => array( CURLOPT_SSL_VERIFYPEER => false, ), ));
        $client = new \Google\Client();
        $client->setClientId($google_client_id);
        $client->setHttpClient($guzzleClient);
        $payload = $client->verifyIdToken($id_token);
        if ($payload) {
            if(empty($payload['email']))
                return Redirect::back()->withErrors('Invalid Login');
            $email = $payload['email'];
            $user = User::where('email', $email)->where('status', 1)->first();
            if(!$user)
                return Redirect::back()->withErrors('Invalid Login');
            Auth::guard('admin')->login($user);
            event(new LoginHistory(['email'=>$email], 'admin'));
            $request->session()->regenerate();
            $admin_url = Config::get('admin.url_prefix').'/dashboard';
            return redirect()->intended($admin_url);

        } else {
            return Redirect::back()->withErrors('Invalid Login');
        }
    }

    public function select2_faq(Request $request)
    {
        $items = DB::table('faqs')->where('name', 'like', $request->q.'%')->orderBy('name')
            ->get();
        $json = [];
        foreach($items as $c){
            $json[] = ['id'=>$c->id, 'text'=>$c->name];
        }
        return \Response::json($json);
    }

    public function select2_categories($type=null)
    {
        $items = DB::table('categories')->where('name', 'like', request()->q.'%');
        if($type)
            $items->where('category_type', $type);

        $items = $items->orderBy('name')->get();
        $json = [];
        foreach($items as $c){
            $json[] = ['id'=>$c->id, 'text'=>$c->name];
        }
        return \Response::json($json);
    }

    public function select2_listings(Request $request)
    {
        $items = DB::table('listings')->where('name', 'like', $request->q.'%')->orderBy('name')
            ->get();
        $json = [];
        foreach($items as $c){
            $json[] = ['id'=>$c->id, 'text'=>$c->name];
        }
        return \Response::json($json);
    }

    public function select2_tags(Request $request)
    {
        $items = DB::table('tags')->where('name', 'like', $request->q.'%')->orderBy('name')
            ->get();
        $json = [];
        foreach($items as $c){
            $json[] = ['id'=>$c->id, 'text'=>$c->name];
        }
        return \Response::json($json);
    }

    public function select2_authors(Request $request)
    {
        $items = DB::table('authors')->where('name', 'like', $request->q.'%')->orderBy('name')
            ->get();
        $json = [];
        foreach($items as $c){
            $json[] = ['id'=>$c->id, 'text'=>$c->name];
        }
        return \Response::json($json);
    }

    public function unique_roles(Request $request)
    {
        $id = $request->id;
        $name = $request->name;

        $where = "name='".$name."'";
        if($id)
            $where .= " AND id != ".decrypt($id);
        $obj = DB::table('roles')
                    ->whereRaw($where)
                    ->get();

        if (count($obj)>0) {
             echo "false";
        } else {
             echo "true";
        }
    }

    public function unique_users(Request $request)
    {
        $id = $request->id;
        $email = $request->email;

        $where = "email='".$email."'";
        if($id)
            $where .= " AND id != ".decrypt($id);
        $obj = DB::table('admins')
                    ->whereRaw($where)
                    ->whereNull('deleted_at')
                    ->get();

        if (count($obj)>0) {
             echo "false";
        } else {
             echo "true";
        }
    }

	public function unique_slug(Request $request)
    {
         $id = $request->id;
         $slug = $request->slug;
         $table = $request->table;
         $type = $request->type;


         $query = DB::table($table)
            ->where('slug', $slug)
            ->whereNull('deleted_at');
            if ($id) 
                $query->where('id', '!=', decrypt($id));
            if ($type) 
                $query->where('type', $type);

            $result = $query->get();


         if (count($result)>0) {
             echo "false";
         } else {
             echo "true";
         }
    }

	public function changePassword(Request $request){
        if (!(Hash::check($request->get('current_password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password you provided. Please try again.");
        }
        if(strcmp($request->get('current_password'), $request->get('new_pwd')) == 0){
            //Current password and new password are same
            return redirect()->back()->with("error","New Password cannot be same as your current password. Please choose a different password.");
        }
        $validatedData = $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|string|min:6',
            'new_confirm_password' => ['same:new_password'],
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new_password'));
        $user->save();
        return redirect()->back()->with("success","Password changed successfully !");
    }

    public function widgets()
    {
        $data = request()->all();
        $type = !empty($data['type'])?$data['type']:"en";
        $widgets = Widget::where('type',$type)->get();
        $data = [];
        foreach ($widgets as $key => $value) {
            $data[$value->code] = (array) json_decode($value->content);
        }
        return view('admin.widgets', ['data'=>$data]);
    }

    public function save_widget(Request $request)
    {
        $data = $request->all();
        // dd($data);

        if($obj = Widget::find($data['id']))
        {

            $obj->content = json_encode($data['section']);
            $obj->save();
            return Redirect::to(url('sw-admin/widgets'))->withSuccess('Widget successfully updated!');
        }
        return Redirect::back()
                        ->withErrors("Ooops..Something wrong happend.Please try again.") // send back all errors to the login form
                        ->withInput($data);
    }


    public function CloneSlug(Request $request)
    {
        $type = $request->query('type');
        $slug = $request->query('slug');
        $name = $request->query('name');
        $table = $request->query('table');
        $route = $request->query('route');

        $existingPage = DB::table($table)->where('type', $type)->where('slug', $slug)->whereNull('deleted_at')->first();

        if ($existingPage) {
            return response()->json([
                'redirect_url' => route($route . '.edit', ['id' => encrypt($existingPage->id)])
            ]);
        } else {
            try {
                $userId = Auth::id();
                $newPageId = DB::table($table)->insertGetId([
                    'name' => $name,
                    'slug' => $slug,
                    'title' => $name,
                    'type' => $type,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'created_by' => $userId,
                    'updated_by' => $userId,
                ]);

                return response()->json([
                    'redirect_url' => route($route . '.edit', ['id' => encrypt($newPageId)])
                ]);
            } catch (\Exception $e) {
                return response()->json(['error' => 'Failed to create new page.:'.$e->getMessage()], 500);
            }
        }
    }


}
