<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Author;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::with(['category', 'author']);

        // Search by title
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title->en', 'LIKE', "%{$search}%")
                  ->orWhere('title->ar', 'LIKE', "%{$search}%");
            });
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        // Filter by author
        if ($request->filled('author')) {
            $query->where('author_id', $request->author);
        }

        // Filter by status
        if ($request->filled('status')) {
            switch ($request->status) {
                case 'published':
                    $query->where('is_published', true);
                    break;
                case 'draft':
                    $query->where('is_published', false);
                    break;
                case 'featured':
                    $query->where('is_featured', true);
                    break;
                case 'urgent':
                    $query->where('is_urgent', true);
                    break;
            }
        }

        $articles = $query->latest('created_at')->paginate(15)->withQueryString();

        // Get categories and authors for filters
        $categories = Category::active()->ordered()->get();
        $authors = Author::active()->get();

        return view('dashboard.articles.index', compact('articles', 'categories', 'authors'));
    }

    public function create()
    {
        $categories = Category::active()->ordered()->get();
        $authors = Author::active()->get();
        return view('dashboard.articles.create', compact('categories', 'authors'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
            'title.en' => 'required|string|max:255',
            'title.ar' => 'required|string|max:255',
            'excerpt.en' => 'nullable|string',
            'excerpt.ar' => 'nullable|string',
            'content.en' => 'required|string',
            'content.ar' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean',
            'is_urgent' => 'boolean',
            'is_published' => 'boolean',
        ]);

        $article = new Article();
        $article->category_id = $request->input('category_id');
        $article->author_id = $request->input('author_id');
        $article->setTranslations('title', $request->input('title'));
        $article->setTranslations('excerpt', $request->input('excerpt', []));
        $article->setTranslations('content', $request->input('content'));
        $article->slug = Str::slug($request->input('title.en'));
        $article->is_featured = $request->boolean('is_featured');
        $article->is_urgent = $request->boolean('is_urgent');
        $article->is_published = $request->boolean('is_published');
        $article->published_at = $request->boolean('is_published') ? now() : null;

        if ($request->hasFile('image')) {
            $article->image = $request->file('image')->store('articles', 'public');
        }

        $article->save();

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article created successfully.');
    }

    public function show(Article $article)
    {
        return view('dashboard.articles.show', compact('article'));
    }

    public function edit(Article $article)
    {
        $categories = Category::active()->ordered()->get();
        $authors = Author::active()->get();
        return view('dashboard.articles.edit', compact('article', 'categories', 'authors'));
    }

    public function update(Request $request, Article $article)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
            'title.en' => 'required|string|max:255',
            'title.ar' => 'required|string|max:255',
            'excerpt.en' => 'nullable|string',
            'excerpt.ar' => 'nullable|string',
            'content.en' => 'required|string',
            'content.ar' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_featured' => 'boolean',
            'is_urgent' => 'boolean',
            'is_published' => 'boolean',
        ]);

        $article->category_id = $request->input('category_id');
        $article->author_id = $request->input('author_id');
        $article->setTranslations('title', $request->input('title'));
        $article->setTranslations('excerpt', $request->input('excerpt', []));
        $article->setTranslations('content', $request->input('content'));
        $article->slug = Str::slug($request->input('title.en'));
        $article->is_featured = $request->boolean('is_featured');
        $article->is_urgent = $request->boolean('is_urgent');
        $article->is_published = $request->boolean('is_published');

        if ($request->boolean('is_published') && !$article->published_at) {
            $article->published_at = now();
        }

        if ($request->hasFile('image')) {
            $article->image = $request->file('image')->store('articles', 'public');
        }

        $article->save();

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article updated successfully.');
    }

    public function destroy(Article $article)
    {
        $article->delete();

        return redirect()->route('admin.articles.index')
            ->with('success', 'Article deleted successfully.');
    }
}
