<?php

namespace App\Models;

use App\Models\BaseModel as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AttributeValue extends Model
{
    use SoftDeletes;

    protected $table   = 'attribute_values';

    protected $guarded = ['id', 'created_by', 'updated_by', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates = ['created_at','updated_at'];

    public function images()
    {
        return $this->hasMany(Image::class, 'attribute_value_id_1')
                    ->orWhere('attribute_value_id_2', $this->id)
                    ->orWhere('attribute_value_id_3', $this->id);
    }

   

}
