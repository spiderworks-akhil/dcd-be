<?php

namespace App\Http\Controllers\Apis;

use DB;
use App\Models\Faq;
use App\Traits\App;
use App\Models\Lead;
use App\Models\Page;
use App\Models\Widget;
use App\Models\Setting;
use App\Models\FrontendPage;
use Illuminate\Http\Request;
use App\Services\MailSettings;
use App\Http\Controllers\Controller;
use App\Http\Requests\ContactRequest;
use App\Http\Resources\FaqCollection;
use App\Http\Resources\LeadCollection;
use App\Http\Resources\WidgetResource;
use App\Http\Resources\CommonPageResource;
use App\Http\Resources\Lead as LeadResource;
use App\Http\Resources\FrontendPage as ResourcesFrontendPage;
use App\Models\Menu;
use App\Models\MenuItem;

class CommonController extends Controller
{
    use App;

    public function GeneralSettings()
    {
        $data = request()->all();
        $type = !empty($data['language']) ? $data['language'] : "en";

        $allMenus = Menu::where('status', 1)->where('type', $type)->get();
        $formattedMenus = [];

        foreach ($allMenus as $menu) {
            $menuId = $menu->id;
            $position = $menu->position;

            $menuResponse = $this->menu($position, $menuId);
            $menuData = json_decode($menuResponse->getContent());

            $menuItems = MenuItem::where('menu_id', $menuId)
                ->select('title', 'url')
                ->get();

                $formattedMenus[str_replace(' ', '_', $position)] = array_merge(
                    (array) $menuData->data,
                );
        }

        $settings = $this->getSettings();

        return response()->json([
            'data' => [
                'all_menus' => $formattedMenus,
                'all_settings' => $settings,
            ],
        ]);
    }

    public function menu($position,$menuId){
        return response()->json(['data' => $this->getMenu($position,$menuId)]);
    }

    public function settings(){
        $settings = $this->getSettings();
        return response()->json(['data' => $settings]);
    }

    public function page(string $slug){
        $data = request()->all();
        $type = !empty($data['language'])?$data['language']:"en";
        $page_settings = FrontendPage::with(['faq', 'og_image'])->where('type',$type)->where('slug', $slug)->where('status', 1)->first();

        if(!$page_settings)
            return response()->json(['error' => 'Page not Found!'], 404);
        return new ResourcesFrontendPage($page_settings);
    }

    public function company_page(string $slug){
        $data = request()->all();
        $type = !empty($data['language'])?$data['language']:"en";
        $page = Page::where('slug', $slug)->where('type',$type)->where('status', 1)->first();
        if(!$page)
            return response()->json(['error' => 'Page not Found!'], 404);

        return new CommonPageResource($page);
    }

    public function company_page_list() {
        $data = request()->all();
        $type = !empty($data['language'])?$data['language']:"en";
        $pages = Page::where('type',$type)->where('status', 1)->select('slug','title')->orderBy('created_at','DESC')->get();
        return $pages;
    }

    public function contact_save(ContactRequest $request){

        $request->validated();
        $contact = new Lead;
        $contact->fill($request->all());
        $contact->save();

        $notif_emails = Setting::where('code', 'contact_notification_email_ids')->first();

        if($notif_emails && trim($notif_emails->value_text) != '')
        {
            $mail = new MailSettings;
            $email_array = explode(',', $notif_emails->value_text);
            array_filter($email_array, function($value){
                return !is_null($value) && $value !== '';
            });
            $email_array = array_map('trim', $email_array);
            $mail->to($email_array)->send(new \App\Mail\Contact($contact));
        }
        if($contact->email){
                $thank_mail = new MailSettings;
                $thank_mail->to($contact->email)->send(new \App\Mail\ContactThankyou($contact));
        }
        return response()->json(['success' => true]);
    }

  public function list_urls($page)
    {
        $urls = [];
        $type = !empty(request()->language) ? request()->language : "en";

        switch ($page) {
            case "company":
                $urls = DB::table('pages')->select('slug')->where('status', 1)->where('type', $type)->get();
                $urls = $this->processSlug($urls,$type);    
                break;

            case "blog":
                $urls = DB::table('blogs')->select('slug')->where('status', 1)->where('type', $type)->get();
                $urls = $this->processSlug($urls,$type);
                break;

            case "events":
                $slug = request()->slug;
                $category = DB::table('categories')->where('slug', $slug)->where('status', 1)->where('type', $type)->where('deleted_at', null)->first();
                if(!$category)
                    return response()->json(['error' => 'Not found'], 404);

                $urls = DB::table('events')->where('category_id', $category->id)->select('slug')->where('status', 1)->where('type', $type)->where('deleted_at', null)->get();
                $urls = $this->processSlug($urls,$type,'events');
                break;

            case "news":
                $urls = DB::table('news')->select('slug')->where('status', 1)->where('type', $type)->where('deleted_at', null)->get();
                $urls = $this->processSlug($urls,$type,'news');
                break;

            case "event-category":
               $categoriesQuery = DB::table('categories')
                ->whereNull('categories.deleted_at')
                ->where('categories.status', 1)
                ->where('categories.category_type', 'Event')
                ->where('categories.type', $type)
                ->whereExists(function ($q) {
                    $q->select(DB::raw(1))
                        ->from('events')
                        ->whereColumn('events.category_id', 'categories.id')
                        ->where('events.status', 1);
                })
                ->select('categories.*')
                ->get();

            $urls = $this->buildCategoryTree($type, 'events/category', $categoriesQuery);
            break;
            case "static_page":
                $urls = DB::table('frontend_pages')->select('slug')->where('status', 1)->where('type', $type)->where('deleted_at', null)->get();
                $urls = $this->processSlug($urls,$type);
                break;

             case "all":
                $urls = collect([
                    (object)['slug' => 'company'],
                    (object)['slug' => 'event'],
                    (object)['slug' => 'news'],
                    (object)['slug' => 'event-category'],
                    (object)['slug' => 'static_page']
                ]);
                break;
            default :
                return response()->json(['error' => 'Page not found!'], 404);
                break;
        }

        return response()->json($urls);
    }

    private function processSlug($urls,$type,$prefix = null) {
        return $urls->map(function ($url) use ($type,$prefix) {
            if($prefix)
                return ['slug' => $type.'/'.$prefix.'/'.$url->slug];
            return ['slug' => $type.'/'.$url->slug];
        });
    }

    private function buildCategoryTree($type,$catType,$items, $parentId = null)
    {
        $branch = [];

        foreach ($items as $item) {
            if ($item->parent_id == $parentId) {

                $children = $this->buildCategoryTree($type,$catType,$items, $item->id);

                $node = [
                    'slug' => $type.'/'.$catType.'/'.$item->slug
                ];

                if (!empty($children)) {
                    $node['children'] = $children;
                }

                $branch[] = $node;
            }
        }

        return $branch;
    }



    public function faq(Request $request){

        $limit = ($request->limit)?$request->limit:12;
        $faqs = Faq::whereHasMorph('linkable', '*', function($query){
                $query->where('status', 1);
        });

        if($search = $request->search){
            $faqs->where(function($query) use($search){
                $query->whereRaw("MATCH (question) AGAINST ('{$search}')")->orWhereRaw("MATCH (answer) AGAINST ('{$search}')")->orWhere('question', 'LIKE', '%'.$search.'%')->orWhere('answer', 'LIKE', '%'.$search.'%');
            });
        }
        $faqs = $faqs->paginate($limit);
        return new FaqCollection($faqs);

    }

    public function leads(Request $request){

        $limit = ($request->limit)?$request->limit:12;
        $leads = Lead::where('status', 1);

        if($search = $request->search){
            $leads->where(function($query) use($search){
                $query->whereRaw("MATCH (name) AGAINST ('{$search}')")->orWhereRaw("MATCH (email) AGAINST ('{$search}')")->orWhere('phone_number', 'LIKE', '%'.$search.'%')->orWhere('created_at', 'LIKE', '%'.$search.'%');
            });
        }
        $leads = $leads->paginate($limit);

        return new LeadCollection($leads);

    }
    public function leads_view($id){

        $lead = Lead::where('status', 1)->find($id);

        if (!$lead)
            return response()->json(['error' => 'Page not Found!'], 404);

        return new LeadResource($lead);

    }



    public function widget(string $code)
    {
        $data = request()->all();
        $type = !empty($data['language'])?$data['language']:"en";
        $widget = Widget::where('code', $code)->where('type',$type)->first();

        if (!$widget) {
            return response()->json(['error' => 'Page not Found!'], 404);
        }
        return new WidgetResource($widget);
    }
}
