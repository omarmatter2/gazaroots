@extends('dashboard.layouts.app')

@section('title', 'View Author')

@section('content')
<div class="container-fixed p-5">
    <div class="flex flex-wrap items-center justify-between gap-5 pb-7.5">
        <div class="flex flex-col gap-2">
            <h1 class="text-xl font-semibold text-primary">View Author</h1>
            <nav class="flex gap-1.5 text-sm text-secondary-foreground">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>/</span>
                <a href="{{ route('admin.authors.index') }}">Authors</a>
                <span>/</span>
                <span class="text-foreground">{{ $author->getTranslation('name', 'en') }}</span>
            </nav>
        </div>
        <div class="flex gap-2.5">
            <a href="{{ route('admin.authors.edit', $author) }}" class="kt-btn kt-btn-primary">
                <i class="ki-filled ki-pencil"></i> Edit
            </a>
            <a href="{{ route('admin.authors.index') }}" class="kt-btn kt-btn-outline">Back to List</a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
        <!-- Main Info -->
        <div class="lg:col-span-2">
            <div class="kt-card">
                <div class="kt-card-header">
                    <h3 class="kt-card-title">Author Details</h3>
                </div>
                <div class="kt-card-body p-7.5 space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="text-sm text-secondary-foreground">Name (English)</label>
                            <p class="font-medium">{{ $author->getTranslation('name', 'en') }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-secondary-foreground">Name (Arabic)</label>
                            <p class="font-medium" dir="rtl">{{ $author->getTranslation('name', 'ar') }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-secondary-foreground">Email</label>
                            <p class="font-medium">{{ $author->email ?: 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-secondary-foreground">Phone</label>
                            <p class="font-medium">{{ $author->phone ?: 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-secondary-foreground">Location</label>
                            <p class="font-medium">{{ $author->location ?: 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-secondary-foreground">Slug</label>
                            <p class="font-mono text-sm bg-muted px-2 py-1 rounded inline-block">{{ $author->slug }}</p>
                        </div>
                    </div>
                    <div>
                        <label class="text-sm text-secondary-foreground">Bio (English)</label>
                        <p class="text-foreground mt-1">{{ $author->getTranslation('bio', 'en') ?: 'N/A' }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-secondary-foreground">Bio (Arabic)</label>
                        <p class="text-foreground mt-1" dir="rtl">{{ $author->getTranslation('bio', 'ar') ?: 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <!-- Articles -->
            @if($author->articles->count() > 0)
            <div class="kt-card mt-5">
                <div class="kt-card-header">
                    <h3 class="kt-card-title">Articles by {{ $author->getTranslation('name', 'en') }}</h3>
                </div>
                <div class="kt-card-body p-0">
                    <div class="kt-table-container">
                        <table class="kt-table">
                            <thead><tr><th>Title</th><th>Category</th><th>Status</th><th>Date</th></tr></thead>
                            <tbody>
                            @foreach($author->articles->take(5) as $article)
                                <tr>
                                    <td><a href="{{ route('admin.articles.show', $article) }}" class="text-primary hover:underline">{{ Str::limit($article->getTranslation('title', 'en'), 40) }}</a></td>
                                    <td>{{ $article->category?->getTranslation('name', 'en') ?? 'N/A' }}</td>
                                    <td><span class="kt-badge {{ $article->is_published ? 'kt-badge-success' : 'kt-badge-secondary' }}">{{ $article->is_published ? 'Published' : 'Draft' }}</span></td>
                                    <td>{{ $article->created_at->format('M d, Y') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="space-y-5">
            <div class="kt-card">
                <div class="kt-card-header"><h3 class="kt-card-title">Avatar</h3></div>
                <div class="kt-card-body p-5 flex justify-center">
                    @if($author->avatar)
                        <img src="{{ Storage::url($author->avatar) }}" alt="{{ $author->getTranslation('name', 'en') }}" class="w-32 h-32 rounded-full object-cover">
                    @else
                        <div class="w-32 h-32 rounded-full bg-muted flex items-center justify-center">
                            <i class="ki-filled ki-user text-4xl text-muted-foreground"></i>
                        </div>
                    @endif
                </div>
            </div>

            <div class="kt-card">
                <div class="kt-card-header"><h3 class="kt-card-title">Statistics</h3></div>
                <div class="kt-card-body p-5">
                    <div class="text-3xl font-bold text-primary">{{ $author->articles->count() }}</div>
                    <p class="text-sm text-secondary-foreground">Total articles</p>
                    <div class="mt-3 flex items-center gap-2">
                        <span class="kt-badge {{ $author->is_active ? 'kt-badge-success' : 'kt-badge-danger' }}">{{ $author->is_active ? 'Active' : 'Inactive' }}</span>
                    </div>
                    <div class="mt-3 text-xs text-secondary-foreground">
                        <p>Created: {{ $author->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

