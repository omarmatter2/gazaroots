@extends('dashboard.layouts.app')

@section('title', 'Articles')

@section('content')
<div class="container-fixed p-5">
    <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
        <div class="flex flex-col justify-center gap-2">
            <h1 class="text-xl font-semibold leading-none text-mono">Articles</h1>
            <div class="flex items-center gap-2 text-sm font-medium text-secondary-foreground">Manage news articles</div>
        </div>
        <div class="flex items-center gap-2.5">
            <a href="{{ route('admin.articles.create') }}" class="kt-btn kt-btn-primary">
                <i class="ki-filled ki-plus-squared"></i> Add Article
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="kt-alert kt-alert-success mb-5">
            <div class="kt-alert-icon"><i class="ki-filled ki-check-circle"></i></div>
            <div class="kt-alert-content">{{ session('success') }}</div>
        </div>
    @endif

    <!-- Search & Filter Card -->
    <div class="kt-card mb-5">
        <div class="kt-card-content p-5">
            <form method="GET" action="{{ route('admin.articles.index') }}">
                <div class="flex flex-wrap items-end gap-3">
                    <!-- Search -->
                    <div class="flex flex-col gap-1 flex-1 min-w-[200px]">
                        <label class="kt-form-label text-xs">Search</label>
                        <input type="text" class="kt-input" name="search" placeholder="Search by title..." value="{{ request('search') }}">
                    </div>

                    <!-- Category Filter -->
                    <div class="flex flex-col gap-1 w-[180px]">
                        <label class="kt-form-label text-xs">Category</label>
                        <select class="kt-select" name="category">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->getTranslation('name', 'en') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Author Filter -->
                    <div class="flex flex-col gap-1 w-[180px]">
                        <label class="kt-form-label text-xs">Author</label>
                        <select class="kt-select" name="author">
                            <option value="">All Authors</option>
                            @foreach($authors as $author)
                                <option value="{{ $author->id }}" {{ request('author') == $author->id ? 'selected' : '' }}>
                                    {{ $author->getTranslation('name', 'en') }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Status Filter -->
                    <div class="flex flex-col gap-1 w-[150px]">
                        <label class="kt-form-label text-xs">Status</label>
                        <select class="kt-select" name="status">
                            <option value="">All Status</option>
                            <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="featured" {{ request('status') == 'featured' ? 'selected' : '' }}>Featured</option>
                            <option value="urgent" {{ request('status') == 'urgent' ? 'selected' : '' }}>Urgent</option>
                        </select>
                    </div>

                    <!-- Buttons -->
                    <div class="flex items-center gap-2">
                        <button type="submit" class="kt-btn kt-btn-primary">
                            <i class="ki-filled ki-filter"></i>
                            Filter
                        </button>
                        <a href="{{ route('admin.articles.index') }}" class="kt-btn kt-btn-outline">
                            <i class="ki-filled ki-cross"></i>
                            Clear
                        </a>
                    </div>
                </div>

                @if(request()->anyFilled(['search', 'category', 'author', 'status']))
                    <div class="mt-3 text-xs text-secondary-foreground">
                        <i class="ki-filled ki-information-2"></i>
                        Showing filtered results
                    </div>
                @endif
            </form>
        </div>
    </div>

    <div class="kt-card">
        <div class="kt-card-content">
            <div class="kt-scrollable-x-auto">
                <table class="kt-table kt-table-border">
                    <thead>
                        <tr>
                            <th class="w-[60px]">#</th>
                            <th>Title (EN)</th>
                            <th>Category</th>
                            <th>Author</th>
                            <th class="w-[100px]">Status</th>
                            <th class="w-[80px]">Views</th>
                            <th class="w-[120px]">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($articles as $article)
                            <tr>
                                <td>{{ $article->id }}</td>
                                <td>{{ Str::limit($article->getTranslation('title', 'en'), 40) }}</td>
                                <td>{{ $article->category?->getTranslation('name', 'en') ?? '-' }}</td>
                                <td>{{ $article->author?->getTranslation('name', 'en') ?? '-' }}</td>
                                <td>
                                    @if($article->is_published)
                                        <span class="kt-badge kt-badge-sm kt-badge-success">Published</span>
                                    @else
                                        <span class="kt-badge kt-badge-sm kt-badge-warning">Draft</span>
                                    @endif
                                    @if($article->is_featured)
                                        <span class="kt-badge kt-badge-sm kt-badge-info">Featured</span>
                                    @endif
                                </td>
                                <td>{{ number_format($article->views) }}</td>
                                <td>
                                    <div class="flex items-center gap-1">
                                        <a href="{{ route('admin.articles.show', $article) }}" class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" title="View">
                                            <i class="ki-filled ki-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.articles.edit', $article) }}" class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" title="Edit">
                                            <i class="ki-filled ki-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.articles.destroy', $article) }}" method="POST" class="inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost text-danger">
                                                <i class="ki-filled ki-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-10 text-secondary-foreground">
                                    No articles found. <a href="{{ route('admin.articles.create') }}" class="kt-link">Create one</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="mt-5">{{ $articles->links() }}</div>
</div>
@endsection

