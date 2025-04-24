<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsListing extends JsonResource
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
            'slug' => $this->slug,
            'title' => $this->title,
            'priority' => $this->priority,
            'short_description' => $this->short_description,
            'published_on' => $this->published_on,
            'published_by' => new Author($this->author),
            'featured_image' => new Media($this->featured_image),
            'banner_image' => new Media($this->banner_image),
        ];
    }
}
