<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SocialMedia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $socialMedia = SocialMedia::orderBy('order')->get();
        return view('dashboard.social-media.index', compact('socialMedia'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.social-media.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'platform' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'image' => 'required|mimes:svg,png,jpg,jpeg,webp|max:1024',
            'hover_image' => 'nullable|mimes:svg,png,jpg,jpeg,webp|max:1024',
            'is_active' => 'boolean',
            'order' => 'integer|min:0',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('social-media', 'public');
        }

        // Handle hover image upload
        if ($request->hasFile('hover_image')) {
            $validated['hover_image'] = $request->file('hover_image')->store('social-media', 'public');
        }

        SocialMedia::create($validated);

        return redirect()->route('admin.social-media.index')
            ->with('success', 'Social media link added successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(SocialMedia $socialMedia)
    {
        return view('dashboard.social-media.show', compact('socialMedia'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SocialMedia $socialMedia)
    {
        return view('dashboard.social-media.edit', compact('socialMedia'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SocialMedia $socialMedia)
    {
        $validated = $request->validate([
            'platform' => 'required|string|max:255',
            'url' => 'required|url|max:255',
            'image' => 'nullable|mimes:svg,png,jpg,jpeg,webp|max:1024',
            'hover_image' => 'nullable|mimes:svg,png,jpg,jpeg,webp|max:1024',
            'is_active' => 'boolean',
            'order' => 'integer|min:0',
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($socialMedia->image && Storage::disk('public')->exists($socialMedia->image)) {
                Storage::disk('public')->delete($socialMedia->image);
            }
            $validated['image'] = $request->file('image')->store('social-media', 'public');
        } else {
            unset($validated['image']);
        }

        // Handle hover image upload
        if ($request->hasFile('hover_image')) {
            // Delete old hover image
            if ($socialMedia->hover_image && Storage::disk('public')->exists($socialMedia->hover_image)) {
                Storage::disk('public')->delete($socialMedia->hover_image);
            }
            $validated['hover_image'] = $request->file('hover_image')->store('social-media', 'public');
        } else {
            unset($validated['hover_image']);
        }

        $socialMedia->update($validated);

        return redirect()->route('admin.social-media.index')
            ->with('success', 'Social media link updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SocialMedia $socialMedia)
    {
        // Delete images
        if ($socialMedia->image && Storage::disk('public')->exists($socialMedia->image)) {
            Storage::disk('public')->delete($socialMedia->image);
        }
        if ($socialMedia->hover_image && Storage::disk('public')->exists($socialMedia->hover_image)) {
            Storage::disk('public')->delete($socialMedia->hover_image);
        }

        $socialMedia->delete();

        return redirect()->route('admin.social-media.index')
            ->with('success', 'Social media link deleted successfully.');
    }
}
