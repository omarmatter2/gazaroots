<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Category;
use App\Models\SocialMedia;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with(['category', 'author'])
            ->where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->paginate(12);

        $categories = Category::where('is_active', true)
            ->orderBy('order')
            ->get();

                   $socialMedia = SocialMedia::where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('website.articles.index', compact('articles', 'categories', 'socialMedia'));
    }

    public function show(string $slug)
    {
        $article = Article::with(['category', 'author'])
            ->where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        // Increment views
        $article->increment('views');

        // Urgent articles for sidebar
        $urgentArticles = Article::with(['category'])
            ->where('is_published', true)
            ->where('is_urgent', true)
            ->where('id', '!=', $article->id)
            ->orderBy('published_at', 'desc')
            ->take(5)
            ->get();

        // Related/Selection articles from same category
        $relatedArticles = Article::with(['category', 'author'])
            ->where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->take(4)
            ->get();

        // Testimonials for carousel
        $testimonials = \App\Models\Testimonial::where('is_active', true)
            ->take(6)
            ->get();

                   $socialMedia = SocialMedia::where('is_active', true)
            ->orderBy('order')
            ->get();
        return view('website.articles.show', compact('article', 'urgentArticles', 'relatedArticles', 'testimonials', 'socialMedia'));
    }
}

