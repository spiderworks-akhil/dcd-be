<?php

namespace App\Models;

use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class News extends Model
{
    use SoftDeletes;

    protected $table = 'news';

    protected $guarded = ['id', 'created_by', 'updated_by', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates = ['created_at','updated_at'];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // public function tags(): BelongsToMany
    // {
    //     return $this->belongsToMany(Tag::class, 'blog_tags', 'blogs_id', 'tags_id');
    // }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'published_by_author_id');
    }

public function approvalNotification()
    {
        return $this->hasOne(\App\Models\ApprovalNotification::class, 'notifiable_id')
            ->where('notifiable_type', 'News')
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





}
