@extends('dashboard.layouts.app')

@section('title', 'View Testimonial')

@section('content')
<div class="container-fixed p-5">
    <div class="flex flex-wrap items-center justify-between gap-5 pb-7.5">
        <div class="flex flex-col gap-2">
            <h1 class="text-xl font-semibold text-primary">View Testimonial</h1>
            <nav class="flex gap-1.5 text-sm text-secondary-foreground">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>/</span>
                <a href="{{ route('admin.testimonials.index') }}">Testimonials</a>
                <span>/</span>
                <span class="text-foreground">{{ $testimonial->getTranslation('name', 'en') }}</span>
            </nav>
        </div>
        <div class="flex gap-2.5">
            <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="kt-btn kt-btn-primary">
                <i class="ki-filled ki-pencil"></i> Edit
            </a>
            <a href="{{ route('admin.testimonials.index') }}" class="kt-btn kt-btn-outline">Back to List</a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
        <!-- Main -->
        <div class="lg:col-span-2">
            <div class="kt-card">
                <div class="kt-card-header"><h3 class="kt-card-title">Testimonial Details</h3></div>
                <div class="kt-card-body p-7.5 space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="text-sm text-secondary-foreground">Name (English)</label>
                            <p class="font-medium">{{ $testimonial->getTranslation('name', 'en') }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-secondary-foreground">Name (Arabic)</label>
                            <p class="font-medium" dir="rtl">{{ $testimonial->getTranslation('name', 'ar') }}</p>
                        </div>
                    </div>
                    <div>
                        <label class="text-sm text-secondary-foreground">Testimonial (English)</label>
                        <div class="mt-2 p-4 bg-muted/50 rounded-lg italic">
                            <i class="ki-filled ki-quote-left text-muted-foreground mr-2"></i>
                            {{ $testimonial->getTranslation('content', 'en') }}
                        </div>
                    </div>
                    <div>
                        <label class="text-sm text-secondary-foreground">Testimonial (Arabic)</label>
                        <div class="mt-2 p-4 bg-muted/50 rounded-lg italic" dir="rtl">
                            {{ $testimonial->getTranslation('content', 'ar') }}
                            <i class="ki-filled ki-quote-right text-muted-foreground ml-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-5">
            <div class="kt-card">
                <div class="kt-card-header"><h3 class="kt-card-title">Photo</h3></div>
                <div class="kt-card-body p-5 flex justify-center">
                    @if($testimonial->image)
                        <img src="{{ Storage::url($testimonial->image) }}" alt="{{ $testimonial->getTranslation('name', 'en') }}" class="w-32 h-32 rounded-full object-cover">
                    @else
                        <div class="w-32 h-32 rounded-full bg-muted flex items-center justify-center">
                            <i class="ki-filled ki-user text-4xl text-muted-foreground"></i>
                        </div>
                    @endif
                </div>
            </div>

            <div class="kt-card">
                <div class="kt-card-header"><h3 class="kt-card-title">Info</h3></div>
                <div class="kt-card-body p-5 space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-secondary-foreground">Order</span>
                        <span class="font-medium">{{ $testimonial->order }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-secondary-foreground">Status</span>
                        <span class="kt-badge {{ $testimonial->is_active ? 'kt-badge-success' : 'kt-badge-danger' }}">
                            {{ $testimonial->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    <hr class="border-border">
                    <div class="text-xs text-secondary-foreground">
                        <p>Created: {{ $testimonial->created_at->format('M d, Y H:i') }}</p>
                        <p>Updated: {{ $testimonial->updated_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

