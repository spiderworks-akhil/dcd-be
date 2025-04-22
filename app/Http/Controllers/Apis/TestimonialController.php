<?php

namespace App\Http\Controllers\Apis;

use App\Http\Controllers\Controller;
use App\Http\Resources\TestimonialCollection;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function featured(){
        $testimonials = Testimonial::where('status', 1)->where('is_featured', 1)->orderBy('priority')->get();
        return new TestimonialCollection($testimonials);
    }

    public function index(){
        $testimonials = Testimonial::where('status', 1)->orderBy('priority')->get();
        return new TestimonialCollection($testimonials);
    }
}
