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

