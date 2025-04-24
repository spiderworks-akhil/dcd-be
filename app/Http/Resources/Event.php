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
        $schedule = $this->schedules ? $this->schedules()->orderBy('priority', 'ASC')->get() : null;

        return array_merge([
            'id' => $this->id,
            'is_featured' => $this->is_featured,
            'title' => $this->title,
            'slug' => $this->slug,
            'short_description' => $this->short_description,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'featured_image' => new Media($this->featured_image),
            'banner_image' => new Media($this->banner_image),
            'category' => new Category($this->category),
            'location' => $this->location,
            'website_link' => $this->website_link,
            'result' => $this->result,
        ], $this->getParentCategory(), [
            'is_scheduled' => $this->is_scheduled,
            'schedules' => $this->formatSchedules($schedule),
            'volunteer_ad_image' => new Media($this->volunteer_ad_image),
            'related_events' => EventListing::collection($this->related_events),
            'gallery' => GalleryMedia::collection($this->gallery),
            'must_attend_events' => EventListing::collection($this->must_attend),
            'rewinds' => $this->getGallery(),
        ]);
    }

   
    private function getParentCategory(): array
    {
        return $this->category->parent ? [
            'parent_category' => new Category($this->category->parent),
        ] : [];
    }

    
    private function formatSchedules($schedule): ?array
    {
        return $schedule ? $schedule->map(function ($schedule) {
            return [
                'id' => $schedule->id,
                'title' => $schedule->title,
                'time' => $schedule->time,
            ];
        })->toArray() : null;
    }

    private function getGallery(): array
    {
        $gallery = \App\Models\Gallery::find(1);
        return $gallery ? [
            'title' => $gallery->title,
            'short_description' => $gallery->short_description,
            'medias' => new GalleryMediaCollection($gallery->gallery)
        ] : [];
    }
}
