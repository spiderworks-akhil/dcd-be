<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GalleryMedia extends JsonResource
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
            'upload_type' => $this->upload_type,
            'youtube_preview' => $this->youtube_preview,
            'youtube_url' => $this->youtube_url,
            'title' => $this->title,
            'media' => new Media($this->media)
        ];
    }
}
