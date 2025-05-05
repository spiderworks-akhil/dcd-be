<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Category extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $baseData = [
            'id' => $this->id,
            'slug' => $this->slug,
            'name' => $this->name,
            'title' => $this->title,
            'short_description' => $this->short_description,
            'featured_image' => new Media($this->featured_image),
        ];

        if ($this->events) {
            $baseData['events'] = EventListing::collection($this->events);
        }
        if ($this->galleries) {
            $baseData['galleries'] = Gallery::collection($this->galleries);
        }

        return $baseData;
    }
}
