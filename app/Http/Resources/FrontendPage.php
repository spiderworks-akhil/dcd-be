<?php

namespace App\Http\Resources;

use App\Models\Menu;
use App\Models\Page;
use App\Models\Gallery;
use App\Models\MenuItem;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Gallery as GalleryResource;
use App\Models\FrontendPage as ModelsFrontendPage;
use App\Traits\App;

class FrontendPage extends JsonResource
{

    use App;

    public function menu($position, $menuId){
        return response()->json(['data' => $this->getMenu($position,$menuId)]);
    }
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->name,
            'title' => $this->title,
            'type' => $this->type,
            'breadcrumbs' => $this->breadcrumbs,
            'banner_heading_colour' => $this->banner_heading_colour,
            'banner_content_colour' => $this->banner_content_colour,
            'content' => new FrontendPageContentResource($this->content),
            'browser_title' => $this->browser_title,
            'og_title' => $this->og_title,
            'meta_description' => $this->meta_description,
            'og_description' => $this->og_description,
            'og_image' => new Media($this->og_image),
            'meta_keywords' => $this->meta_keywords,
            'bottom_description' => $this->bottom_description,
            'extra_js' => $this->extra_js,
            'faq' => new FaqCollection($this->faq),
            'related_function' => $this->related_sections($this->slug)
        ];
    }

    private function related_sections($slug) {

        if($slug == 'events') {
            return [
                'rewinds' => $this->getGallery('rewinds-gallery'),
                'upcoming_event' => $this->upcoming_event(),
            ];
        }
        if($slug == 'index') {
            return [
                'sliders' => $this->getSliders(),
                'featured_divisions' => $this->featuredDivisions(),
                'rewinds' => $this->getGallery('rewinds-gallery'),
            ];
        }
        if ($slug == 'header') {
            return [
                'menus' => $this->getHeadermenus(),
            ];
        }  if ($slug == 'footer') {
            return [
                'menus' => $this->getFootermenus(),
            ];
        }  else {
            return null;
        }

    }

    private function getGallery($slug)
    {
        $gallery = Gallery::where('slug',$slug)->first();
        return new GalleryResource($gallery);
    }

    private function upcoming_event()
    {
        return \App\Models\Event::where('status', 1)
            ->where('type', request()->language??'en')
            ->where('is_featured_in_banner', 1)
            ->first();
    }

    

    private function getHeadermenus()
    {
        $type = request()->language??'en';

        if($type == "en"){
            $allMenus = Menu::select('position','id','type')->where('id',1)->where('type',$type)->get();
        } else {
            $allMenus = Menu::select('position','id','type')->where('id',3)->where('type',$type)->get();
        }
        $formattedMenus = [];

        foreach ($allMenus as $menu) {
            $menuId = $menu->id;
            $position = $menu->position;

            $menuResponse = $this->menu($position,$menuId);
            $menuData = json_decode($menuResponse->getContent());

            $formattedMenus[str_replace(' ', '_', $position)] = (array) $menuData->data;
        }

         return response()->json([
            'all_menus' => $formattedMenus,

        ]);

    }

    private function getFootermenus()
    {
        $type = request()->language??'en';

        if($type == "en"){
            $allMenus = Menu::select('position','id','type')->where('id',2)->where('type',$type)->get();
        } else {
            $allMenus = Menu::select('position','id','type')->where('id',4)->where('type',$type)->get();
        }
        $formattedMenus = [];

        foreach ($allMenus as $menu) {
            $menuId = $menu->id;
            $position = $menu->position;

            $menuResponse = $this->menu($position,$menuId);
            $menuData = json_decode($menuResponse->getContent());

            $formattedMenus[str_replace(' ', '_', $position)] = (array) $menuData->data;
        }

         return response()->json([
            'all_menus' => $formattedMenus,

        ]);

    }

    // private function faq()
    // {
    //     $procurement_faq_id = FrontendPage::where('slug','procurement_faq')->pluck('id')->first();
    //     dd($procurement_faq_id);
    // }

    private function getSliders()
    {
        $language = request()->language ?? 'en';

        $out = new \App\Models\Slider();
        if ($language == 'en') {
            $out = $out->find(1);
        } else if ($language == 'ar') {
            $out = $out->find(2);
        }
        return new Slider($out);
    }
    private function featuredDivisions()
    {
        $language = request()->language ?? 'en';

        $out = new \App\Models\Service();
        if ($language == 'en') {
            $out->where('featured', 1)->where('type', 'en')->get();
        } else if ($language == 'ar') {
            $out->where('featured', 1)->where('type', 'ar')->get();
        }
        $out = $out->get();
        return new ServiceCollection($out);
        
    }

}
