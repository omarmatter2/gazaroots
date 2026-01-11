<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\SocialMedia;

class CategoryController extends Controller
{
    public function show(string $slug)
    {
        $category = Category::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Top articles in this category (for hero section)
        $featuredArticles = $category->articles()
            ->with(['author', 'category'])
            ->where('is_published', true)
            ->orderByDesc('is_featured')
            ->orderBy('published_at', 'desc')
            ->take(4)
            ->get();

        // If not enough articles in this category, get from other categories
        if ($featuredArticles->count() < 4) {
            $remaining = 4 - $featuredArticles->count();
            $existingIds = $featuredArticles->pluck('id')->toArray();

            $moreArticles = Article::with(['author', 'category'])
                ->where('is_published', true)
                ->whereNotIn('id', $existingIds)
                ->orderByDesc('is_featured')
                ->orderBy('published_at', 'desc')
                ->take($remaining)
                ->get();

            $featuredArticles = $featuredArticles->concat($moreArticles);
        }

        // All articles in this category (paginated)
        $articles = $category->articles()
            ->with(['author', 'category'])
            ->where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->paginate(10);

        // Urgent articles (across all categories)
        $urgentArticles = Article::with(['category'])
            ->where('is_published', true)
            ->where('is_urgent', true)
            ->orderBy('published_at', 'desc')
            ->take(5)
            ->get();

        // Featured articles from other categories (for selections)
        $selectionArticles = Article::with(['category', 'author'])
            ->where('is_published', true)
            ->where('category_id', '!=', $category->id)
            ->where('is_featured', true)
            ->orderBy('published_at', 'desc')
            ->take(4)
            ->get();
                   $socialMedia = SocialMedia::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('website.categories.show', compact(
            'category',
            'articles',
            'featuredArticles',
            'urgentArticles',
            'selectionArticles',
            'socialMedia'
        ));
    }
}

