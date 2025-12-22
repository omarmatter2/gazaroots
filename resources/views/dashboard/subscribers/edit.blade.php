@extends('dashboard.layouts.app')

@section('title', 'Edit Subscriber')

@section('content')
<div class="container-fixed p-5">
    <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
        <div class="flex flex-col justify-center gap-2">
            <h1 class="text-xl font-semibold leading-none text-mono">Edit Subscriber</h1>
            <div class="flex items-center gap-2 text-sm font-medium text-secondary-foreground">
                <a href="{{ route('admin.subscribers.index') }}" class="kt-link">Subscribers</a>
                <span>/</span>
                <span>{{ $subscriber->email }}</span>
            </div>
        </div>
    </div>

    @if($errors->any())
        <div class="kt-alert kt-alert-danger mb-5">
            <div class="kt-alert-icon"><i class="ki-filled ki-cross-circle"></i></div>
            <div class="kt-alert-content">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form action="{{ route('admin.subscribers.update', $subscriber) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="kt-card max-w-xl">
            <div class="kt-card-content p-7.5">
                <div class="grid gap-5 lg:gap-7.5">
                    <div class="flex flex-col gap-1">
                        <label class="kt-form-label" for="email">Email Address <span class="text-danger">*</span></label>
                        <input type="email" class="kt-input" id="email" name="email" value="{{ old('email', $subscriber->email) }}" required>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label class="kt-form-label">Status</label>
                        <div class="flex items-center gap-2.5">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" class="kt-switch" name="is_active" value="1" {{ old('is_active', $subscriber->is_active) ? 'checked' : '' }}>
                            <span class="text-sm text-secondary-foreground">Active Subscriber</span>
                        </div>
                    </div>
                    @if($subscriber->subscribed_at)
                    <div class="flex flex-col gap-1">
                        <label class="kt-form-label">Subscribed At</label>
                        <p class="text-sm text-secondary-foreground">{{ $subscriber->subscribed_at->format('M d, Y H:i') }}</p>
                    </div>
                    @endif
                    @if($subscriber->unsubscribed_at)
                    <div class="flex flex-col gap-1">
                        <label class="kt-form-label">Unsubscribed At</label>
                        <p class="text-sm text-secondary-foreground">{{ $subscriber->unsubscribed_at->format('M d, Y H:i') }}</p>
                    </div>
                    @endif
                </div>
            </div>
            <div class="kt-card-footer flex justify-end gap-2.5 p-7.5 border-t border-border">
                <a href="{{ route('admin.subscribers.index') }}" class="kt-btn kt-btn-outline">Cancel</a>
                <button type="submit" class="kt-btn kt-btn-primary">Update Subscriber</button>
            </div>
        </div>
    </form>
</div>
@endsection

