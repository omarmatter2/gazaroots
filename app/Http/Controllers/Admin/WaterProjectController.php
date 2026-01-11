<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WaterProject;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class WaterProjectController extends Controller
{
    public function index()
    {
        $projects = WaterProject::withCount('donations')->paginate(15);
        return view('dashboard.water-projects.index', compact('projects'));
    }

    public function create()
    {
        return view('dashboard.water-projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title.en' => 'required|string|max:255',
            'title.ar' => 'required|string|max:255',
            'description.en' => 'nullable|string',
            'description.ar' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'wells_built' => 'integer|min:0',
            'beneficiaries' => 'integer|min:0',
            'families_served' => 'integer|min:0',
            'neighborhoods' => 'integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'show_in_donation' => 'boolean',
        ]);

        $project = new WaterProject();
        $project->setTranslations('title', $request->input('title'));
        $project->setTranslations('description', $request->input('description', []));
        $project->slug = Str::slug($request->input('title.en'));
        $project->location = $request->input('location');
        $project->wells_built = $request->input('wells_built', 0);
        $project->beneficiaries = $request->input('beneficiaries', 0);
        $project->families_served = $request->input('families_served', 0);
        $project->neighborhoods = $request->input('neighborhoods', 0);
        $project->is_active = $request->boolean('is_active');
        $project->show_in_donation = $request->boolean('show_in_donation');

        // If this project is set to show in donation, unset others
        if ($project->show_in_donation) {
            WaterProject::where('show_in_donation', true)->update(['show_in_donation' => false]);
        }

        if ($request->hasFile('image')) {
            $project->image = $request->file('image')->store('water-projects', 'public');
        }

        $project->save();

        return redirect()->route('admin.water-projects.index')
            ->with('success', 'Water project created successfully.');
    }

    public function show(WaterProject $waterProject)
    {
        $waterProject->load('donations');
        return view('dashboard.water-projects.show', compact('waterProject'));
    }

    public function edit(WaterProject $waterProject)
    {
        return view('dashboard.water-projects.edit', compact('waterProject'));
    }

    public function update(Request $request, WaterProject $waterProject)
    {
        $request->validate([
            'title.en' => 'required|string|max:255',
            'title.ar' => 'required|string|max:255',
            'description.en' => 'nullable|string',
            'description.ar' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            'wells_built' => 'integer|min:0',
            'beneficiaries' => 'integer|min:0',
            'families_served' => 'integer|min:0',
            'neighborhoods' => 'integer|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_active' => 'boolean',
            'show_in_donation' => 'boolean',
        ]);

        $waterProject->setTranslations('title', $request->input('title'));
        $waterProject->setTranslations('description', $request->input('description', []));
        $waterProject->slug = Str::slug($request->input('title.en'));
        $waterProject->location = $request->input('location');
        $waterProject->wells_built = $request->input('wells_built', 0);
        $waterProject->beneficiaries = $request->input('beneficiaries', 0);
        $waterProject->families_served = $request->input('families_served', 0);
        $waterProject->neighborhoods = $request->input('neighborhoods', 0);
        $waterProject->is_active = $request->boolean('is_active');
        $waterProject->show_in_donation = $request->boolean('show_in_donation');

        // If this project is set to show in donation, unset others
        if ($waterProject->show_in_donation) {
            WaterProject::where('id', '!=', $waterProject->id)
                ->where('show_in_donation', true)
                ->update(['show_in_donation' => false]);
        }

        if ($request->hasFile('image')) {
            $waterProject->image = $request->file('image')->store('water-projects', 'public');
        }

        $waterProject->save();

        return redirect()->route('admin.water-projects.index')
            ->with('success', 'Water project updated successfully.');
    }

    public function destroy(WaterProject $waterProject)
    {
        $waterProject->delete();

        return redirect()->route('admin.water-projects.index')
            ->with('success', 'Water project deleted successfully.');
    }
}
