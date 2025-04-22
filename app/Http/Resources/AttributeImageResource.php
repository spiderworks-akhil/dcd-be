<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AttributeImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);

        return [
            'id' =>$this->id,
            'attribute_id_1'=>$this->attribute_value_id_1,
            'attribute_id_2'=>$this->attribute_value_id_2,
            'attribute_id_3'=>$this->attribute_value_id_3,
            'image'=>new Media($this->attribute_value_image) 
        ];
    }
}
