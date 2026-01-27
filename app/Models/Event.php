<?php

namespace App\Models;

use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

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
        return $this->hasMany(EventSchedule::class, 'event_id');
    }
    public function volunteer_ad_image()
    {
        return $this->belongsTo(Media::class, 'volunteer_ad_image_id');
    }
    public function logo_image()
    {
        return $this->belongsTo(Media::class, 'logo_image_id');
    }
    public function video()
    {
        return $this->belongsTo(Media::class, 'video_id');
    }

   public function approvalNotification()
    {
        return $this->hasOne(\App\Models\ApprovalNotification::class, 'notifiable_id')
            ->where('notifiable_type', 'Event')
            ->latestOfMany(); 
    }


    public function getPublicationStatusAttribute()
    {
        return optional($this->approvalNotification)->status ?? '';
    }


    public function updated_user(): ?BelongsTo
    {
        if ($this->checkColumn('updated_by'))
            return $this->belongsTo(Admin::class, 'updated_by');

        return null;
    }
    
   public function created_user(): ?BelongsTo
    {
        if ($this->checkColumn('created_by'))
            return $this->belongsTo(Admin::class, 'created_by');

        return null;
    }

}
