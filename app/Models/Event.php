<?php

namespace App\Models;

use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    protected $table = 'events';

    protected $guarded = ['id', 'created_by', 'updated_by', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates = ['created_at','updated_at'];

    public function faq(): MorphMany
    {
        return $this->morphMany(Faq::class, 'linkable')->orderBy('display_order', 'DESC')->orderBy('created_at', 'DESC');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function gallery()
    {
        return $this->hasMany(EventMedia::class, 'events_id');
    }
    public function schedules()
    {
        return $this->hasMany(EventSchedule::class, 'event_id')->orderBy('priority', 'DESC');
    }
    public function volunteer_ad_image()
    {
        return $this->belongsTo(Media::class, 'volunteer_ad_image_id');
    }
}
