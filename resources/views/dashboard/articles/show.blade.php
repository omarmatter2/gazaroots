@extends('dashboard.layouts.app')

@section('title', 'View Article')

@section('content')
<div class="container-fixed p-5">
    <div class="flex flex-wrap items-center justify-between gap-5 pb-7.5">
        <div class="flex flex-col gap-2">
            <h1 class="text-xl font-semibold text-primary">View Article</h1>
            <nav class="flex gap-1.5 text-sm text-secondary-foreground">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>/</span>
                <a href="{{ route('admin.articles.index') }}">Articles</a>
                <span>/</span>
                <span class="text-foreground">{{ Str::limit($article->getTranslation('title', 'en'), 30) }}</span>
            </nav>
        </div>
        <div class="flex gap-2.5">
            <a href="{{ route('admin.articles.edit', $article) }}" class="kt-btn kt-btn-primary">
                <i class="ki-filled ki-pencil"></i> Edit
            </a>
            <a href="{{ route('admin.articles.index') }}" class="kt-btn kt-btn-outline">Back to List</a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-5">
            <div class="kt-card">
                <div class="kt-card-header">
                    <h3 class="kt-card-title">Article Details</h3>
                </div>
                <div class="kt-card-body p-7.5 space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="text-sm text-secondary-foreground">Title (English)</label>
                            <p class="font-medium">{{ $article->getTranslation('title', 'en') }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-secondary-foreground">Title (Arabic)</label>
                            <p class="font-medium" dir="rtl">{{ $article->getTranslation('title', 'ar') }}</p>
                        </div>
                    </div>
                    <div>
                        <label class="text-sm text-secondary-foreground">Slug</label>
                        <p class="font-mono text-sm bg-muted px-2 py-1 rounded inline-block">{{ $article->slug }}</p>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="text-sm text-secondary-foreground">Excerpt (English)</label>
                            <p class="text-foreground">{{ $article->getTranslation('excerpt', 'en') ?: 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-secondary-foreground">Excerpt (Arabic)</label>
                            <p class="text-foreground" dir="rtl">{{ $article->getTranslation('excerpt', 'ar') ?: 'N/A' }}</p>
                        </div>
                    </div>
                    <div>
                        <label class="text-sm text-secondary-foreground">Content (English)</label>
                        <div class="prose max-w-none mt-2 p-4 bg-muted/50 rounded-lg">{!! $article->getTranslation('content', 'en') !!}</div>
                    </div>
                    <div>
                        <label class="text-sm text-secondary-foreground">Content (Arabic)</label>
                        <div class="prose max-w-none mt-2 p-4 bg-muted/50 rounded-lg" dir="rtl">{!! $article->getTranslation('content', 'ar') !!}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-5">
            <!-- Image -->
            <div class="kt-card">
                <div class="kt-card-header"><h3 class="kt-card-title">Featured Image</h3></div>
                <div class="kt-card-body p-5">
                    @if($article->image)
                        <img src="{{ Storage::url($article->image) }}" alt="{{ $article->getTranslation('title', 'en') }}" class="w-full rounded-lg">
                    @else
                        <div class="flex items-center justify-center h-32 bg-muted rounded-lg">
                            <i class="ki-filled ki-picture text-3xl text-muted-foreground"></i>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Meta -->
            <div class="kt-card">
                <div class="kt-card-header"><h3 class="kt-card-title">Meta Info</h3></div>
                <div class="kt-card-body p-5 space-y-3">
                    <div><span class="text-sm text-secondary-foreground">Category:</span>
                        <span class="font-medium">{{ $article->category?->name_en ?? 'N/A' }}</span></div>
                    <div><span class="text-sm text-secondary-foreground">Author:</span>
                        <span class="font-medium">{{ $article->author?->name_en ?? 'N/A' }}</span></div>
                    <div><span class="text-sm text-secondary-foreground">Views:</span>
                        <span class="font-medium">{{ number_format($article->views) }}</span></div>
                    <div><span class="text-sm text-secondary-foreground">Published:</span>
                        <span class="font-medium">{{ $article->published_at?->format('M d, Y') ?? 'Not set' }}</span></div>
                </div>
            </div>

            <!-- Status -->
            <div class="kt-card">
                <div class="kt-card-header"><h3 class="kt-card-title">Status</h3></div>
                <div class="kt-card-body p-5 space-y-2">
                    <div class="flex flex-wrap gap-2">
                        <span class="kt-badge {{ $article->is_published ? 'kt-badge-success' : 'kt-badge-secondary' }}">
                            {{ $article->is_published ? 'Published' : 'Draft' }}</span>
                        @if($article->is_featured)<span class="kt-badge kt-badge-warning">Featured</span>@endif
                        @if($article->is_urgent)<span class="kt-badge kt-badge-danger">Urgent</span>@endif
                    </div>
                    <div class="mt-3 text-xs text-secondary-foreground">
                        <p>Created: {{ $article->created_at->format('M d, Y H:i') }}</p>
                        <p>Updated: {{ $article->updated_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

