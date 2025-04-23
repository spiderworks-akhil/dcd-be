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
        ];

        if (count($this->children) > 0) {
            $baseData['children'] = Category::collection($this->children);
        }

        if ($this->events) {
            $baseData['events'] = EventListing::collection($this->events);
        }

        return $baseData;
    }
}
