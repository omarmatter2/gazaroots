<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\AssistanceRequest;
use App\Models\Author;
use App\Models\Category;
use App\Models\Donation;
use App\Models\Subscriber;
use App\Models\Testimonial;
use App\Models\WaterProject;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'articles' => Article::count(),
            'categories' => Category::count(),
            'authors' => Author::count(),
            'subscribers' => Subscriber::active()->count(),
            'donations' => Donation::completed()->sum('amount'),
            'assistance_requests' => AssistanceRequest::new()->count(),
            'water_projects' => WaterProject::active()->count(),
            'testimonials' => Testimonial::active()->count(),
        ];

        $recentArticles = Article::with(['category', 'author'])
            ->latest()
            ->take(5)
            ->get();

        $recentRequests = AssistanceRequest::latest()
            ->take(5)
            ->get();

        $recentDonations = Donation::with('waterProject')
            ->latest()
            ->take(5)
            ->get();

        return view('dashboard.index', compact(
            'stats',
            'recentArticles',
            'recentRequests',
            'recentDonations'
        ));
    }
}
