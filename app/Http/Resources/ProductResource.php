<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->name,
            'title' => $this->title,
            'short_description' => $this->short_description,
            'description' => $this->description,
            'priority' => $this->priority,
            'featured_image_id' => $this->featured_image_id,
            'banner_image_id' => $this->banner_image_id,
            'og_image_id' => $this->og_image_id,
            'is_featured' => $this->is_featured,
            'attributes'=>new AttributeResourceCollection($this->attributes),

        ];
    }
}
