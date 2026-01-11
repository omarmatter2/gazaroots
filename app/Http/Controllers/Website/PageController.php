<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Page;

class PageController extends Controller
{
    /**
     * Display the About Us page.
     */
    public function aboutUs()
    {
        $page = Page::findBySlug('about-us');

        if (!$page || !$page->is_active) {
            abort(404);
        }

        $socialMedia = \App\Models\SocialMedia::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('website.pages.about-us', compact('page', 'socialMedia'));
    }
}
