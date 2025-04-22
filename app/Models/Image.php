<?php

namespace App\Models;

use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes;

    protected $table   = 'images';

    protected $guarded = ['id', 'created_by', 'updated_by', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates = ['created_at','updated_at'];

    public function attribute1()
    {
        return $this->belongsTo(AttributeValue::class, 'attribute_value_id_1');
    }

    public function attribute2()
    {
        return $this->belongsTo(AttributeValue::class, 'attribute_value_id_2');
    }

    public function attribute3()
    {
        return $this->belongsTo(AttributeValue::class, 'attribute_value_id_3');
    }

    public function attribute_value_image()
    {
        return $this->belongsTo(Media::class, 'image_id');
    }



}
