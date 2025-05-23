<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Models\Category;
use App\Http\Resources\Event as EventResource;
use App\Http\Resources\EventListingCollection;
use App\Http\Resources\CategoryCollection;

class EventController extends Controller
{
    public function index(Request $request)
    {
        try {
            $data = $request->all();
            $limit = !empty($data['limit']) ? (int)$data['limit'] : 10;
            $type = !empty($data['language']) ? $data['language'] : "en";
            $events = Event::where('status', 1);
            if (!empty($data['category_id'])) {
                $events = $events->whereHas('categories', function ($query) use ($data) {
                    $query->where('id', $data['category_id']);
                });
            }
            if (!empty($data['filter']) && $data['filter'] === 'upcoming') {
                $events = $events->where('start_time', '>', now());
            } elseif (!empty($data['filter']) && $data['filter'] === 'past') {
                $events = $events->where('end_time', '<', now());
            }
            if (!empty($data['search'])) {
                $events = $events->where(function ($query) use ($data) {
                    $query->where('title', 'LIKE', "%{$data['search']}%");
                });
            }
            $events = $events->where('type', $type)->orderBy('start_time', 'DESC')->paginate($limit);
            return new EventListingCollection($events);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }


    public function featured(Request $request)
    {
        $data = $request->all();
        $type = !empty($data['language']) ? $data['language'] : "en";
        $events = Event::where('status', 1)
            ->where('type', $type)
            ->where('is_featured', 1);

        if (!empty($data['category_id'])) {
            $events = $events->whereHas('categories', function ($query) use ($data) {
                $query->where('id', $data['category_id']);
            });
        }

        if (!empty($data['filter']) && $data['filter'] === 'upcoming') {
            $events = $events->where('start_time', '>', now());
        } elseif (!empty($data['filter']) && $data['filter'] === 'past') {
            $events = $events->where('end_time', '<', now());
        }

        $events = $events->orderBy('priority', 'DESC')
            ->get();
        return new EventListingCollection($events);
    }

    public function view(Request $request, $slug)
    {
        try {
            $data = $request->all();
            $type = !empty($data['language']) ? $data['language'] : "en";
            $event = Event::where('slug', $slug)->where('type', $type)->where('status', 1)->first();
            if (!$event)
                return response()->json(['error' => 'Not found'], 404);

            $event->related_events = Event::where('id', '!=', $event->id)
                ->where('category_id', $event->category_id)
                ->where('status', 1)
                ->where('type', $type)
                ->orderBy('start_time', 'DESC')
                ->take(5)
                ->get();
            $event->must_attend = Event::where('id', '!=', $event->id)
                ->where('type', $type)
                ->where('is_must_attend', 1)
                ->where('status', 1)
                ->orderBy('start_time', 'DESC')
                ->take(5)
                ->get();
            return new EventResource($event);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function categories(Request $request)
    {
        try {
            $data = $request->all();
            $type = !empty($data['language']) ? $data['language'] : "en";
            $categories = Category::where('status', 1)
                ->where('category_type', 'Event')
                ->where('type', $type)
                ->where('parent_id', 0)
                ->orderBy('priority', 'DESC')
                ->get();

            $formattedCategories = $categories->map(function ($category) use ($type) {
                $childCategoryIds = Category::where('parent_id', $category->id)->pluck('id')->toArray();
                $allCategoryIds = array_merge([$category->id], $childCategoryIds);

                $category->events = Event::where('status', 1)
                    ->whereIn('category_id', $allCategoryIds)
                    ->where('type', $type)
                    ->orderBy('start_time', 'DESC')
                    ->get();

                return $category;
            });

            return new CategoryCollection($formattedCategories);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function slug_list(Request $request)
    {
        try {
            $data = $request->all();
            $type = !empty($data['language']) ? $data['language'] : "en";
            $slugs = Event::where('status', 1)
                ->where('type', $type)
                ->pluck('slug');

            return response()->json(['slugs' => $slugs], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
