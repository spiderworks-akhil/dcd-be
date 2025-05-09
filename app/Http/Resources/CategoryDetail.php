<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\Gallery as GalleryResource;

class CategoryDetail extends JsonResource
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
        if ($this->category_type == 'Event') {
            $baseData['event_updates'] = $this->getEventUpdates($this->id,$this->name,$this->type);
        }

        if ($this->events) {
            $baseData['events'] = EventListing::collection($this->events);
        }
        if($this->banner_video){
            $baseData['banner_video'] = new Media($this->banner_video);
        }
        if ($this->logo_image) {
            $baseData['logo_image'] = new Media($this->logo_image);
        }
        if ($this->children) {
            $baseData['children'] = Category::collection($this->children);
        }
        
        $baseData['rewinds'] = $this->getGallery('rewinds-gallery');

        return $baseData;
    }

    private function getGallery($slug)
    {
        $type = request()->language??'en';

        $gallery = \App\Models\Gallery::where('slug',$slug)->where('lang_type',$type)->first(); // for this the type is called lang_type
        return new GalleryResource($gallery);
    }

    private function getEventUpdates($id,$name,$type)
    {
        $list_name =  ($type == 'en')? 
                        'catId:' . $id . ' ' . $name . ' Event Update EN'
                        :
                         'catId:' . $id . ' ' . $name . ' Event Update AR';

        $listing = \App\Models\Listing::where('name', $list_name)->first();

        return (!empty($listing->list)) ? new ListingResourceCollection($listing->list) : [];
    }
}
