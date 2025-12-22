@extends('dashboard.layouts.app')

@section('title', 'View Subscriber')

@section('content')
<div class="container-fixed p-5">
    <div class="flex flex-wrap items-center justify-between gap-5 pb-7.5">
        <div class="flex flex-col gap-2">
            <h1 class="text-xl font-semibold text-primary">View Subscriber</h1>
            <nav class="flex gap-1.5 text-sm text-secondary-foreground">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>/</span>
                <a href="{{ route('admin.subscribers.index') }}">Subscribers</a>
                <span>/</span>
                <span class="text-foreground">{{ $subscriber->email }}</span>
            </nav>
        </div>
        <div class="flex gap-2.5">
            <a href="{{ route('admin.subscribers.edit', $subscriber) }}" class="kt-btn kt-btn-primary">
                <i class="ki-filled ki-pencil"></i> Edit
            </a>
            <a href="{{ route('admin.subscribers.index') }}" class="kt-btn kt-btn-outline">Back to List</a>
        </div>
    </div>

    <div class="max-w-2xl mx-auto">
        <div class="kt-card">
            <div class="kt-card-header"><h3 class="kt-card-title">Subscriber Details</h3></div>
            <div class="kt-card-body p-7.5">
                <div class="flex items-center gap-5 mb-6">
                    <div class="w-20 h-20 rounded-full bg-primary/10 flex items-center justify-center">
                        <i class="ki-filled ki-sms text-3xl text-primary"></i>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold">{{ $subscriber->email }}</h2>
                        <span class="kt-badge {{ $subscriber->is_active ? 'kt-badge-success' : 'kt-badge-danger' }}">
                            {{ $subscriber->is_active ? 'Active' : 'Unsubscribed' }}
                        </span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="p-4 bg-muted/50 rounded-lg">
                        <div class="flex items-center gap-2 mb-2">
                            <i class="ki-filled ki-calendar text-success"></i>
                            <span class="text-sm text-secondary-foreground">Subscribed At</span>
                        </div>
                        <p class="font-medium">{{ $subscriber->subscribed_at?->format('M d, Y H:i') ?? $subscriber->created_at->format('M d, Y H:i') }}</p>
                    </div>

                    @if($subscriber->unsubscribed_at)
                    <div class="p-4 bg-danger/10 rounded-lg">
                        <div class="flex items-center gap-2 mb-2">
                            <i class="ki-filled ki-cross-circle text-danger"></i>
                            <span class="text-sm text-secondary-foreground">Unsubscribed At</span>
                        </div>
                        <p class="font-medium">{{ $subscriber->unsubscribed_at->format('M d, Y H:i') }}</p>
                    </div>
                    @endif

                    <div class="p-4 bg-muted/50 rounded-lg">
                        <div class="flex items-center gap-2 mb-2">
                            <i class="ki-filled ki-time text-info"></i>
                            <span class="text-sm text-secondary-foreground">Subscription Age</span>
                        </div>
                        <p class="font-medium">{{ $subscriber->created_at->diffForHumans() }}</p>
                    </div>

                    <div class="p-4 bg-muted/50 rounded-lg">
                        <div class="flex items-center gap-2 mb-2">
                            <i class="ki-filled ki-update-file text-warning"></i>
                            <span class="text-sm text-secondary-foreground">Last Updated</span>
                        </div>
                        <p class="font-medium">{{ $subscriber->updated_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t border-border">
                    <a href="mailto:{{ $subscriber->email }}" class="kt-btn kt-btn-primary">
                        <i class="ki-filled ki-sms"></i> Send Email
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

