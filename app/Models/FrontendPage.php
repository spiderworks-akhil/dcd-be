<?php

namespace App\Models;

use App\Models\BaseModel as Model;
use App\Models\Media;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class FrontendPage extends Model
{
    use SoftDeletes;
    
    protected $table = 'frontend_pages';

    protected $guarded = ['id', 'created_by', 'updated_by', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates = ['created_at','updated_at'];

    public function faq(): MorphMany
    {
        return $this->morphMany(Faq::class, 'linkable')->orderBy('display_order', 'ASC')->orderBy('created_at', 'ASC');
    }

    public function menu(): MorphOne
    {
        return $this->morphOne(MenuItem::class, 'linkable');
    }

    public function getContentAttribute($value)
    {
        if(Config('admin.services.sections'))
        {
            $content = json_decode($value);
            $output = collect($content)->map(function($item, $key){
                
                if (strpos($key, 'media_id') !== false) {
                    if($item)
                        return Media::find((int)$item);
                    else
                        return $item;
                }
                elseif(strpos($key, 'listing_id') !== false){
                    if($item)
                        return Listing::with(['list', 'list.media'])->find((int)$item);
                    else
                        return $item;
                }
                else
                   return $item;

            });

            return $output;
            
        }
        return $value;
    }

    public function create_admin_menu()
    {
        $pages = static::where('status', 1)->get();
        $html = '';
        foreach ($pages as $key => $item) {
            $html .= '<div class="checkbox"><input type="checkbox" name="frontend_pages_links[]" class="frontend_pages_links" value="frontend_pages_link-'.$item->id.'" data-id="'.$item->id.'" data-name="'.$item->name.'" id="frontend_pages-'.$item->id.'"> <label for="frontend_pages-'.$item->id.'">'.$item->name.'</label></div>';
        }
        return $html;
    }
}
