<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\Testimonial;
use App\Models\WaterProject;

class HomeController extends Controller
{
    public function index()
    {
        // Featured articles for hero section
        $featuredArticles = Article::with(['category', 'author'])
            ->where('is_published', true)
            ->where('is_featured', true)
            ->orderBy('published_at', 'desc')
            ->take(4)
            ->get();

        // Urgent articles
        $urgentArticles = Article::with('category')
            ->where('is_published', true)
            ->where('is_urgent', true)
            ->orderBy('published_at', 'desc')
            ->take(5)
            ->get();

        // Latest articles
        $latestArticles = Article::with(['category', 'author'])
            ->where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->take(6)
            ->get();

        // Categories with article count (only those marked to show on home)
        $categories = Category::where('is_active', true)
            ->where('show_on_home', true)
            ->withCount(['articles' => function ($query) {
                $query->where('is_published', true);
            }])
            ->orderBy('order')
            ->take(4)
            ->get();

        // Water projects stats
        $waterStats = [
            'wells_built' => WaterProject::where('is_active', true)->sum('wells_built'),
            'beneficiaries' => WaterProject::where('is_active', true)->sum('beneficiaries'),
            'families_served' => WaterProject::where('is_active', true)->sum('families_served'),
            'neighborhoods' => WaterProject::where('is_active', true)->sum('neighborhoods'),
        ];

        // Latest water projects
        $waterProjects = WaterProject::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->take(3)
            ->get();

        // Testimonials
        $testimonials = Testimonial::where('is_active', true)
            ->orderBy('order')
            ->take(6)
            ->get();

        return view('website.index', compact(
            'featuredArticles',
            'urgentArticles',
            'latestArticles',
            'categories',
            'waterStats',
            'waterProjects',
            'testimonials'
        ));
    }
}

