<?php

namespace App\Models;

use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    use SoftDeletes;

    protected $table = 'categories';

    protected $guarded = ['id', 'created_by', 'updated_by', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates = ['created_at','updated_at'];

    public function faq(): MorphMany
    {
        return $this->morphMany(Faq::class, 'linkable')->orderBy('display_order', 'ASC')->orderBy('created_at', 'DESC');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function menu(): MorphOne
    {
        return $this->morphOne(MenuItem::class, 'linkable');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Category::class, 'parent_id', 'id')->where('status',1);
    }

    public function banner_video()
    {
        return $this->belongsTo(Media::class, 'banner_video_id');
    }

    public function galleries(): HasMany
    {
        return $this->hasMany(Gallery::class, 'category_id', 'id');
    }

    public function logo_image()
    {
        return $this->belongsTo(Media::class, 'logo_image_id');
    }
    public function extra_image()
    {
        return $this->belongsTo(Media::class, 'extra_image_id');
    }


}
