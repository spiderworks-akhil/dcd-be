<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class News extends JsonResource
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
            'short_description' => $this->short_description,
            'published_on' => $this->published_on,
            'published_by' => new Author($this->author),
            'news_title' => $this->news_title,
            'content' => $this->content,
            'iframe_code' => $this->iframe_code,
            'featured_image' => new Media($this->featured_image),
            'banner_image' => new Media($this->banner_image),
            'browser_title' => $this->browser_title,
            'og_title' => $this->og_title,
            'meta_description' => $this->meta_description,
            'og_description' => $this->og_description,
            'og_image' => new Media($this->og_image),
            'meta_keywords' => $this->meta_keywords,
            'bottom_description' => $this->bottom_description,
            'extra_js' => $this->extra_js,
        ];
    }

}
