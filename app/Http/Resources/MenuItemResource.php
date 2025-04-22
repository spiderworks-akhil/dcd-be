<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MenuItemResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'title' => $this->title,
            'original_title' => $this->original_title,
            'menu_type' => $this->menu_type,
            'url' => $this->url,
            'menu_nextable_id' => $this->menu_nextable_id,
            'menu_order' => $this->menu_order,
            'parent_id' => $this->parent_id,

        ];
    }
}
