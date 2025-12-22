<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\NavItem;
use Illuminate\Http\Request;

class NavItemController extends Controller
{
    public function index()
    {
        $navItems = NavItem::with('children')
            ->parents()
            ->orderBy('order')
            ->get();

        return view('dashboard.nav-items.index', compact('navItems'));
    }

    public function create()
    {
        $parentItems = NavItem::parents()->active()->orderBy('order')->get();
        return view('dashboard.nav-items.create', compact('parentItems'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            'type' => 'required|in:link,dropdown,button',
            'target' => 'required|in:_self,_blank',
            'parent_id' => 'nullable|exists:nav_items,id',
            'icon' => 'nullable|string|max:255',
            'css_class' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'order' => 'integer',
        ]);

        NavItem::create([
            'title' => [
                'en' => $validated['title_en'],
                'ar' => $validated['title_ar'],
            ],
            'url' => $validated['url'],
            'type' => $validated['type'],
            'target' => $validated['target'],
            'parent_id' => $validated['parent_id'] ?? null,
            'icon' => $validated['icon'] ?? null,
            'css_class' => $validated['css_class'] ?? null,
            'is_active' => $request->boolean('is_active'),
            'order' => $validated['order'] ?? 0,
        ]);

        return redirect()->route('admin.nav-items.index')
            ->with('success', 'Navigation item created successfully.');
    }

    public function show(NavItem $navItem)
    {
        return view('dashboard.nav-items.show', compact('navItem'));
    }

    public function edit(NavItem $navItem)
    {
        $parentItems = NavItem::parents()
            ->where('id', '!=', $navItem->id)
            ->active()
            ->orderBy('order')
            ->get();

        return view('dashboard.nav-items.edit', compact('navItem', 'parentItems'));
    }

    public function update(Request $request, NavItem $navItem)
    {
        $validated = $request->validate([
            'title_en' => 'required|string|max:255',
            'title_ar' => 'required|string|max:255',
            'url' => 'nullable|string|max:255',
            'type' => 'required|in:link,dropdown,button',
            'target' => 'required|in:_self,_blank',
            'parent_id' => 'nullable|exists:nav_items,id',
            'icon' => 'nullable|string|max:255',
            'css_class' => 'nullable|string|max:255',
            'is_active' => 'boolean',
            'order' => 'integer',
        ]);

        $navItem->update([
            'title' => [
                'en' => $validated['title_en'],
                'ar' => $validated['title_ar'],
            ],
            'url' => $validated['url'],
            'type' => $validated['type'],
            'target' => $validated['target'],
            'parent_id' => $validated['parent_id'] ?? null,
            'icon' => $validated['icon'] ?? null,
            'css_class' => $validated['css_class'] ?? null,
            'is_active' => $request->boolean('is_active'),
            'order' => $validated['order'] ?? 0,
        ]);

        return redirect()->route('admin.nav-items.index')
            ->with('success', 'Navigation item updated successfully.');
    }

    public function destroy(NavItem $navItem)
    {
        $navItem->delete();

        return redirect()->route('admin.nav-items.index')
            ->with('success', 'Navigation item deleted successfully.');
    }
}
