<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class Job extends JsonResource
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
            'job_code' => $this->job_code,
            'slug' => $this->slug,
            'name' => $this->name,
            'title' => $this->title,
            'short_description' => $this->short_description,
            'last_application_date' => $this->last_application_date,
            'department' => $this->department,
            'responsibilities' => $this->responsibilities,
            'eligibility' => $this->eligibility,
            'skills'=> $this->skills
        ];
    }
}
