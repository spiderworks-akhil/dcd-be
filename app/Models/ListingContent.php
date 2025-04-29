<?php
namespace App\Models;

use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ListingContent extends Model
{

    use SoftDeletes;

    protected $table = 'listing_contents';

    protected $guarded = ['id', 'created_by', 'updated_by', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates = ['created_at','updated_at'];


    public function media():BelongsTo
    {
        return $this->belongsTo(Media::class, 'media_id');
    }
    public function banner_image(): BelongsTo
    {
        return $this->belongsTo(Media::class, 'banner_image_id');
    }

    public function logo():BelongsTo
    {
        return $this->belongsTo(Media::class, 'logo_id');
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(Author::class, 'author_id');
    }

}
