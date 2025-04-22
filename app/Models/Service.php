<?php

namespace App\Models;

use App\Models\BaseModel as Model;
use App\Models\Media;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;

    protected $table = 'services';


    protected $guarded = ['id', 'created_by', 'updated_by', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates = ['created_at','updated_at'];

    public function faq(): MorphMany
    {
        return $this->morphMany(Faq::class, 'linkable')->orderBy('display_order', 'DESC')->orderBy('created_at', 'DESC');
    }

    public function menu(): MorphOne
    {
        return $this->morphOne(MenuItem::class, 'linkable');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Service::class, 'parent_id', 'id');
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
                else
                   return $item;

            });

            return $output;
            
        }
        return $value;
    }

    public function create_admin_menu()
    {
        $services = static::where('status', 1)->get();
        $output = $this->parse_hierarchical_list($services);
        return $output;
    }

    public function parse_hierarchical_list($array, $currentParent = 0, $deep=0)
    {
        $html = '';

        $indent = "";
        for($i = 0; $i < $deep; $i++){
              $indent .= "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
        }

        if($array)
            foreach ($array as $key => $item) {
                if($item->parent_id == $currentParent){
                    
                    $html .= '<div class="checkbox">'.$indent.'<input type="checkbox" name="services_links[]" class="services_links" value="services_link-'.$item->id.'" data-id="'.$item->id.'" data-name="'.$item->name.'" id="services-'.$item->id.'"> <label for="services-'.$item->id.'">'.$item->name.'</label></div>';
                        
                    if($item->children)
                    {
                        $html .= $this->parse_hierarchical_list ($array, $item->id, ($deep+1));
                    }
                }
            }
        return $html;
    }
}
