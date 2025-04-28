<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Service extends JsonResource
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
            'name' => $this->name,
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'bottom_text' => $this->bottom_text,
            'icon_image' => new Media($this->icon_image),
            'featured_image' => new Media($this->featured_image),
            'banner_image' => new Media($this->banner_image),
            'browser_title' => $this->browser_title,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'bottom_description' => $this->bottom_description,
            'faq' => new FaqCollection($this->faq),
            'children' => new ServiceCollection($this->whenLoaded('children'))
        ];
    }
}
