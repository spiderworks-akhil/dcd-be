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
        $schedule = $this->schedules ? $this->schedules->orderBy('priority', 'DESC') : null;
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'short_description' => $this->short_description,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'banner_image' => new Media($this->banner_image),
            'category' => new Category($this->category),
            'location' => $this->location,
            'website_link' => $this->website_link,
        ] + ($this->category->parent ? [
            'parent_category' => new Category($this->category->parent),
        ] : [])+([
            'schedules' => $schedule ? $schedule->map(function ($schedule) {
                return [
                    'id' => $schedule->id,
                    'title' => $schedule->title,
                    'tile' => $schedule->time,
                ];
            }) : null,
            'volunteer_ad_image' => new Media($this->volunteer_ad_image),
        ]);
    }
}
