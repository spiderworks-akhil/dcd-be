<?php

namespace App\Traits;

use Illuminate\Support\Facades\Cache;
use App\Models\Setting;
use App\Models\Menu as SiteMenu;
use Illuminate\Support\Str;
use App\Models\MenuItem;

trait App {
    protected function getSettings(){
        $common_settings = Cache::get('settings', function () {
            $data = [];
            $settings = Setting::whereNotIn('settings_type', ['Google', 'Smtp'])->get();
            foreach($settings as $setting)
            {
                if($setting->code == "logo" || $setting->code == "logo_small" || $setting->code == "fav_icon")
                    $data[$setting->code] = asset($setting->value_text);
                else
                    $data[$setting->code] = $setting->value_text;
            }
            return $data;
        });
        return $common_settings;
    }

    protected function getMenu($menu_position){
        $menu = SiteMenu::where('position', $menu_position)->first();
        if(!$menu)
            return response()->json(['error' => 'Oops, something wrong happend.'], 400);

        $menu_items = Cache::get('menu-'.Str::slug($menu_position), function () use($menu) {
            return $this->menu_tree($menu->id, 0);
        });

        return $menu_items;
    }

    protected function menu_tree($menu_id, $parent){
        $items = MenuItem::where('menu_id', $menu_id)->where('parent_id', $parent)->orderBy('menu_order', 'ASC')->get();
        $menu_items = [];
        if($items)
        {
            foreach ($items as $key => $item) {
                $menu_items[$key]['title'] = $item->title;
                if($item->menu_type == 'custom_link')
                {
                    if($item->url != '#')
                        $menu_items[$key]['url'] = $item->url;
                    else
                        $menu_items[$key]['url'] = $item->url;
                }
                elseif ($item->menu_type == 'pages_link' && $item->linkable)
                {
                    if($item->linkable)
                        $menu_items[$key]['url'] = 'company/'.$item->linkable->slug;
                }
                elseif($item->menu_type == 'frontend_pages_link' && $item->linkable)
                {
                    if($item->linkable)
                        $menu_items[$key]['url'] = $item->linkable->slug;
                }
                elseif($item->menu_type == 'services_link' && $item->linkable)
                {
                    if($item->linkable)
                        $menu_items[$key]['url'] = $item->linkable->slug;
                }

                if(count($item->children)>0)
                {
                    $menu_items[$key]['children'] = $this->menu_tree($menu_id, $item->id);
                }
            }
        }
        return $menu_items;
    }
}
