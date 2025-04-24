<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EventListing extends JsonResource
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
            'category' => new Category($this->category),
            'location' => $this->location,
            'featured_image' => new Media($this->featured_image),
            'logo_image' => new Media($this->logo_image),
            'banner_image' => new Media($this->banner_image),
        ];
    }
}
