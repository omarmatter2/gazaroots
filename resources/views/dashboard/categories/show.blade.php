@extends('dashboard.layouts.app')

@section('title', 'View Category')

@section('content')
<div class="container-fixed p-5">
    <div class="flex flex-wrap items-center justify-between gap-5 pb-7.5">
        <div class="flex flex-col gap-2">
            <h1 class="text-xl font-semibold text-primary">View Category</h1>
            <nav class="flex gap-1.5 text-sm text-secondary-foreground">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>/</span>
                <a href="{{ route('admin.categories.index') }}">Categories</a>
                <span>/</span>
                <span class="text-foreground">{{ $category->getTranslation('name', 'en') }}</span>
            </nav>
        </div>
        <div class="flex gap-2.5">
            <a href="{{ route('admin.categories.edit', $category) }}" class="kt-btn kt-btn-primary">
                <i class="ki-filled ki-pencil"></i> Edit
            </a>
            <a href="{{ route('admin.categories.index') }}" class="kt-btn kt-btn-outline">Back to List</a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
        <!-- Main Info -->
        <div class="lg:col-span-2">
            <div class="kt-card">
                <div class="kt-card-header">
                    <h3 class="kt-card-title">Category Details</h3>
                </div>
                <div class="kt-card-body p-7.5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="text-sm text-secondary-foreground">Name (English)</label>
                            <p class="font-medium">{{ $category->getTranslation('name', 'en') }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-secondary-foreground">Name (Arabic)</label>
                            <p class="font-medium" dir="rtl">{{ $category->getTranslation('name', 'ar') }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-secondary-foreground">Slug</label>
                            <p class="font-mono text-sm bg-muted px-2 py-1 rounded">{{ $category->slug }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-secondary-foreground">Order</label>
                            <p class="font-medium">{{ $category->order }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="text-sm text-secondary-foreground">Description (English)</label>
                            <p class="text-foreground">{{ $category->description_en ?: 'N/A' }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="text-sm text-secondary-foreground">Description (Arabic)</label>
                            <p class="text-foreground" dir="rtl">{{ $category->description_ar ?: 'N/A' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-5">
            <!-- Image -->
            <div class="kt-card">
                <div class="kt-card-header">
                    <h3 class="kt-card-title">Image</h3>
                </div>
                <div class="kt-card-body p-5">
                    @if($category->image)
                        <img src="{{ Storage::url($category->image) }}" alt="{{ $category->getTranslation('name', 'en') }}" class="w-full rounded-lg">
                    @else
                        <div class="flex items-center justify-center h-32 bg-muted rounded-lg">
                            <i class="ki-filled ki-picture text-3xl text-muted-foreground"></i>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Status -->
            <div class="kt-card">
                <div class="kt-card-header">
                    <h3 class="kt-card-title">Status</h3>
                </div>
                <div class="kt-card-body p-5">
                    <div class="flex items-center gap-2">
                        @if($category->is_active)
                            <span class="kt-badge kt-badge-success">Active</span>
                        @else
                            <span class="kt-badge kt-badge-danger">Inactive</span>
                        @endif
                    </div>
                    <div class="mt-4 text-sm text-secondary-foreground">
                        <p>Created: {{ $category->created_at->format('M d, Y H:i') }}</p>
                        <p>Updated: {{ $category->updated_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>
            </div>

            <!-- Articles Count -->
            <div class="kt-card">
                <div class="kt-card-header">
                    <h3 class="kt-card-title">Articles</h3>
                </div>
                <div class="kt-card-body p-5">
                    <div class="text-3xl font-bold text-primary">{{ $category->articles->count() }}</div>
                    <p class="text-sm text-secondary-foreground">Total articles in this category</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

