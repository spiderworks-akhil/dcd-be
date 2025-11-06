<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use App\Models\FrontendPage;
use Illuminate\Http\Request;
use App\Traits\ResourceTrait;
use App\Traits\AdminStaticPageTrait;
use Illuminate\Support\Facades\File;
use App\Http\Requests\Admin\StaticPageRequest;
use App\Http\Controllers\Admin\BaseController as Controller;

class StaticPageController extends Controller
{
    use ResourceTrait;
    use AdminStaticPageTrait;


    public function __construct()
    {
        parent::__construct();

        $this->model = new FrontendPage;
        $this->route .= '.static-pages';
        $this->views .= '.static_pages';

        $this->permissions = ['list'=>'static_pages_listing', 'create'=>'static_pages_adding', 'edit'=>'static_pages_editing', 'delete'=>''];
        $this->resourceConstruct();

    }

    protected function getCollection() {
        return $this->model->select('id', 'slug','type', 'name', 'title', 'updated_at');
    }

    protected function setDTData($collection) {
        return $this->initDTData($collection)
            ->rawColumns(['action_edit', 'action_delete', 'status']);
    }

    protected function getSearchSettings(){}



    public function store(StaticPageRequest $request)
    {

        $request->validated();
        $data = request()->all();
        $slug = $data['slug'];

        $this->createBladeView($slug);

        return $this->_store($data);
    }

    public function update(StaticPageRequest $request)
    {
        $request->validated();
    	$data = request()->all();
        $data['status'] = $data['status'] ?? 0;
    	$id = decrypt($data['id']);
        if(!empty($data['content'])){
            $data['content'] = json_encode($data['content']);
        }
        return $this->_update($id, $data);
    }

    public function HeaderView()
    {
        $settings = Setting::where('settings_type', '!=', 'Others')->get();
        $data = [];
        foreach($settings as $setting)
        {
            $data[$setting->code] = $setting->value_text;
        }
        $other_data = Setting::where('settings_type', 'Others')->get();

        return view('admin._layouts.header')->with('data', $data)->with('other_data', $other_data);
    }

    public function GetSlug(Request $request)
    {
        $type = $request->query('type');
        $slug = $request->query('slug');
        $name = $request->query('name');
        $currentType = $request->query('currentType');

        if (in_array($currentType, ['en_draft', 'ar_draft']) && in_array($type, ['en', 'ar'])) {

            $language = ($currentType == "en_draft" || $type == "en_draft") ? "en" : "ar";

            $draft = FrontendPage::where('slug', $slug)->where('type', "{$language}_draft")->first();
            $page  = FrontendPage::where('slug', $slug)->where('type', $language)->first();

            $draft->type = $language;
            $draft->save();

            $page->type = "{$language}_draft";
            $page->save();

            return response()->json([
                'redirect_url' => route('admin.static-pages.edit', ['id' => encrypt($draft->id)])
            ]);
        }

        $existingPage = FrontendPage::where('type', $type)->where('slug', $slug)->first();

        if ($existingPage) {
            return response()->json([
                'redirect_url' => route('admin.static-pages.edit', ['id' => encrypt($existingPage->id)])
            ]);
        } else {

            if($type == "en_draft" || $type == "ar_draft"){

                if($type == "en_draft"){
                    $existingId = FrontendPage::where('slug', $slug)->where('type','en')->pluck('id')->first();
                } else {
                    $existingId = FrontendPage::where('slug', $slug)->where('type','ar')->pluck('id')->first();
                }

                $page_name = $slug.'_'.$type;

                $path = resource_path("views/admin/static_pages/_partials/$page_name.blade.php");

                $existing_path = resource_path("views/admin/static_pages/_partials/$slug.blade.php");

                $dir = dirname($path);

                if (!file_exists($dir))
                {
                    mkdir($dir, 0777, true);
                }

                if (!File::exists($path))
                {
                    File::delete($path);
                }
                $content = File::get($existing_path);
                File::put($path, $content);

                $page    = FrontendPage::find($existingId);
                $newPage = $page->replicate();
                $newPage->slug = $slug;
                $newPage->title = $name;
                $newPage->type = $type;
                $newPage->save();

            } else{

                $existingId = FrontendPage::where('slug', $slug)->pluck('id')->first();
                $page = FrontendPage::find($existingId);
                $newPage = $page->replicate();
                $newPage->name = $name;
                $newPage->slug = $slug;
                $newPage->type = $type;
                $newPage->save();
            }

            return response()->json([
                'redirect_url' => route('admin.static-pages.edit', ['id' => encrypt($newPage->id)])
            ]);
        }
    }


}
