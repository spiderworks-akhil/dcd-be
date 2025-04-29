<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ListingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'meida_type' => $this->meida_type,
            'media_id' => new Media($this->media),
            'banner_image' => new Media($this->banner_image),
            'logo_image' => new Media($this->logo),
            'icon' => $this->icon,
            'short_title' => $this->short_title,
            'title' => $this->title,
            'short_description' => $this->short_description,
            'detailed_description' => $this->detailed_description,
            'extra_description' => $this->extra_description,
            'url_title' => $this->url_title,
            'url' => $this->url,
            'date' => $this->date,
            'author_id' => new Author($this->author),

        ];
    }
}
