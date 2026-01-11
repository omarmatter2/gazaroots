<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Show the about us page editor.
     */
    public function aboutUs()
    {
        $page = Page::findBySlug('about-us');

        if (!$page) {
            $page = Page::create([
                'slug' => 'about-us',
                'title' => ['en' => 'About Us', 'ar' => 'من نحن'],
                'content' => ['en' => '', 'ar' => ''],
                'is_active' => true,
            ]);
        }

        return view('dashboard.pages.about-us', compact('page'));
    }

    /**
     * Update the about us page.
     */
    public function updateAboutUs(Request $request)
    {
        $validated = $request->validate([
            'title.en' => 'required|string|max:255',
            'title.ar' => 'required|string|max:255',
            'content.en' => 'required|string',
            'content.ar' => 'required|string',
        ]);

        $page = Page::findBySlug('about-us');

        if (!$page) {
            $page = new Page(['slug' => 'about-us']);
        }

        $page->setTranslations('title', $validated['title']);
        $page->setTranslations('content', $validated['content']);
        $page->save();

        return redirect()->route('admin.pages.about-us')
            ->with('success', 'About Us page updated successfully.');
    }
}
