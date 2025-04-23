<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Event extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'short_description' => $this->short_description,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'banner_image' => new Media($this->banner_image),
            'category' => new Category($this->category),
            'parent_category' => $this->whenLoaded('category.parent', function () {
                return $this->category->parent ? new Category($this->category->parent) : null;
            }),
            'location' => $this->location,
        ];
    }
}
