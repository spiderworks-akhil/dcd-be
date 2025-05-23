<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Admin;
use App\Http\Resources\Media;
use App\Http\Resources\Category;

class Blog extends JsonResource
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
            'content' => $this->processContent($this->content),
            'bottom_text' => $this->bottom_text,
            'bottom_button_text' => $this->bottom_button_text,
            'bottom_button_url' => $this->bottom_button_url,
            'bottom_button_target' => $this->bottom_button_target,
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
            'visit_count' => $this->visit_count,
            'tags' => new TagCollection($this->tags),
            'related_blogs' => new BlogListingCollection($this->related_blogs)
        ];
    }

    protected function processContent($content){
        if (is_string($content)) {
            $content = json_decode($content, true);
        }

        if (is_array($content)) {
            return array_values($content);
        }
        return [];

    }

}
