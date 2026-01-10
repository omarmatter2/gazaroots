<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\SocialMedia;
use App\Models\WaterProject;

class WaterProjectController extends Controller
{
    public function index()
    {
        $projects = WaterProject::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->get();

        // Stats - aggregate from all active projects
        $stats = [
            'wells_built' => WaterProject::where('is_active', true)->sum('wells_built'),
            'beneficiaries' => WaterProject::where('is_active', true)->sum('beneficiaries'),
            'families_served' => WaterProject::where('is_active', true)->sum('families_served'),
            'neighborhoods' => WaterProject::where('is_active', true)->sum('neighborhoods'),
        ];

        // Latest articles for water-related news
        $articles = Article::with(['category', 'author'])
            ->where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->take(5)
            ->get();

        return view('website.water-project.water', compact('projects', 'stats', 'articles'));
    }

    public function show(string $slug)
    {
        $project = WaterProject::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
       $socialMedia = SocialMedia::where('is_active', true)
            ->orderBy('order')
            ->get();
        // Other projects
        $otherProjects = WaterProject::where('is_active', true)
            ->where('id', '!=', $project->id)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        return view('website.water-projects.show', compact('project', 'otherProjects', 'socialMedia'));
    }
}

