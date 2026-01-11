<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::where('is_active', true)
            ->orderBy('order')
            ->paginate(12);

                   $socialMedia = SocialMedia::where('is_active', true)
            ->orderBy('order')
            ->get();
        return view('website.testimonials.index', compact('testimonials', 'socialMedia'));
    }
}

