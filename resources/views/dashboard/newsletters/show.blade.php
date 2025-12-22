@extends('dashboard.layouts.app')

@section('title', 'View Newsletter')

@section('content')
<div class="container-fixed p-5">
    <div class="flex flex-wrap items-center justify-between gap-5 pb-7.5">
        <div class="flex flex-col gap-2">
            <h1 class="text-xl font-semibold text-gray-900">Newsletter Details</h1>
            <p class="text-sm text-gray-600">View newsletter information and statistics</p>
        </div>
        <div class="flex items-center gap-2.5">
            @if($newsletter->isPending())
                <a href="{{ route('admin.newsletters.edit', $newsletter) }}" class="kt-btn kt-btn-light">
                    <i class="ki-filled ki-pencil"></i>
                    Edit
                </a>
                <form action="{{ route('admin.newsletters.send-now', $newsletter) }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="kt-btn kt-btn-success" onclick="return confirm('Send newsletter now?')">
                        <i class="ki-filled ki-send"></i>
                        Send Now
                    </button>
                </form>
            @endif
            <a href="{{ route('admin.newsletters.index') }}" class="kt-btn kt-btn-light">
                <i class="ki-filled ki-arrow-left"></i>
                Back to List
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
        <div class="lg:col-span-2 space-y-5">
            <div class="kt-card">
                <div class="kt-card-header">
                    <h3 class="kt-card-title">Content (English)</h3>
                </div>
                <div class="kt-card-body">
                    <h2 class="text-lg font-semibold mb-4">{{ $newsletter->getTranslation('subject', 'en') }}</h2>
                    <div class="prose max-w-none">
                        {!! $newsletter->getTranslation('content', 'en') !!}
                    </div>
                </div>
            </div>

            <div class="kt-card">
                <div class="kt-card-header">
                    <h3 class="kt-card-title">Content (Arabic)</h3>
                </div>
                <div class="kt-card-body" dir="rtl">
                    <h2 class="text-lg font-semibold mb-4">{{ $newsletter->getTranslation('subject', 'ar') }}</h2>
                    <div class="prose max-w-none">
                        {!! $newsletter->getTranslation('content', 'ar') !!}
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-5">
            <div class="kt-card">
                <div class="kt-card-header">
                    <h3 class="kt-card-title">Status</h3>
                </div>
                <div class="kt-card-body">
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Status</span>
                            @switch($newsletter->status)
                                @case('draft')
                                    <span class="kt-badge kt-badge-secondary">Draft</span>
                                    @break
                                @case('scheduled')
                                    <span class="kt-badge kt-badge-warning">Scheduled</span>
                                    @break
                                @case('sending')
                                    <span class="kt-badge kt-badge-info">Sending...</span>
                                    @break
                                @case('sent')
                                    <span class="kt-badge kt-badge-success">Sent</span>
                                    @break
                                @case('failed')
                                    <span class="kt-badge kt-badge-danger">Failed</span>
                                    @break
                            @endswitch
                        </div>
                        @if($newsletter->scheduled_at)
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Scheduled At</span>
                                <span class="text-sm font-medium">{{ $newsletter->scheduled_at->format('M d, Y H:i') }}</span>
                            </div>
                        @endif
                        @if($newsletter->sent_at)
                            <div class="flex items-center justify-between">
                                <span class="text-sm text-gray-600">Sent At</span>
                                <span class="text-sm font-medium">{{ $newsletter->sent_at->format('M d, Y H:i') }}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="kt-card">
                <div class="kt-card-header">
                    <h3 class="kt-card-title">Statistics</h3>
                </div>
                <div class="kt-card-body">
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Total Recipients</span>
                            <span class="text-sm font-medium">{{ number_format($newsletter->recipients_count) }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Successfully Sent</span>
                            <span class="text-sm font-medium text-success">{{ number_format($newsletter->sent_count) }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Failed</span>
                            <span class="text-sm font-medium text-danger">{{ number_format($newsletter->failed_count) }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="kt-card">
                <div class="kt-card-header">
                    <h3 class="kt-card-title">Dates</h3>
                </div>
                <div class="kt-card-body">
                    <div class="flex flex-col gap-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Created</span>
                            <span class="text-sm font-medium">{{ $newsletter->created_at->format('M d, Y H:i') }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm text-gray-600">Updated</span>
                            <span class="text-sm font-medium">{{ $newsletter->updated_at->format('M d, Y H:i') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

