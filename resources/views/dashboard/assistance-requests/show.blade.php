@extends('dashboard.layouts.app')

@section('title', 'View Assistance Request')

@section('content')
<div class="container-fixed p-5">
    <div class="flex flex-wrap items-center justify-between gap-5 pb-7.5">
        <div class="flex flex-col gap-2">
            <h1 class="text-xl font-semibold text-primary">View Assistance Request</h1>
            <nav class="flex gap-1.5 text-sm text-secondary-foreground">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>/</span>
                <a href="{{ route('admin.assistance-requests.index') }}">Assistance Requests</a>
                <span>/</span>
                <span class="text-foreground">#{{ $assistanceRequest->id }}</span>
            </nav>
        </div>
        <div class="flex gap-2.5">
            <a href="{{ route('admin.assistance-requests.edit', $assistanceRequest) }}" class="kt-btn kt-btn-primary">
                <i class="ki-filled ki-pencil"></i> Edit
            </a>
            <a href="{{ route('admin.assistance-requests.index') }}" class="kt-btn kt-btn-outline">Back to List</a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
        <!-- Main -->
        <div class="lg:col-span-2">
            <div class="kt-card">
                <div class="kt-card-header"><h3 class="kt-card-title">Request Details</h3></div>
                <div class="kt-card-body p-7.5 space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="text-sm text-secondary-foreground">Full Name</label>
                            <p class="font-medium">{{ $assistanceRequest->full_name }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-secondary-foreground">Phone</label>
                            <p class="font-medium">{{ $assistanceRequest->phone ?: 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-secondary-foreground">Email</label>
                            <p class="font-medium">{{ $assistanceRequest->email ?: 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-secondary-foreground">Location</label>
                            <p class="font-medium">{{ $assistanceRequest->location ?: 'N/A' }}</p>
                        </div>
                    </div>
                    <div>
                        <label class="text-sm text-secondary-foreground">Message</label>
                        <div class="mt-2 p-4 bg-muted/50 rounded-lg">{{ $assistanceRequest->message ?: 'No message provided' }}</div>
                    </div>
                    <div>
                        <label class="text-sm text-secondary-foreground">Admin Notes</label>
                        <div class="mt-2 p-4 bg-warning/10 rounded-lg border border-warning/20">{{ $assistanceRequest->admin_notes ?: 'No admin notes' }}</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-5">
            <div class="kt-card">
                <div class="kt-card-header"><h3 class="kt-card-title">Status</h3></div>
                <div class="kt-card-body p-5">
                    @php
                        $statusColors = [
                            'new' => 'kt-badge-info',
                            'in_progress' => 'kt-badge-warning',
                            'resolved' => 'kt-badge-success',
                            'rejected' => 'kt-badge-danger',
                        ];
                    @endphp
                    <span class="kt-badge kt-badge-lg {{ $statusColors[$assistanceRequest->status] ?? 'kt-badge-secondary' }}">
                        {{ ucfirst(str_replace('_', ' ', $assistanceRequest->status)) }}
                    </span>
                </div>
            </div>

            <div class="kt-card">
                <div class="kt-card-header"><h3 class="kt-card-title">Timeline</h3></div>
                <div class="kt-card-body p-5">
                    <div class="space-y-3 text-sm">
                        <div class="flex items-center gap-2">
                            <i class="ki-filled ki-calendar text-muted-foreground"></i>
                            <span class="text-secondary-foreground">Submitted:</span>
                            <span class="font-medium">{{ $assistanceRequest->created_at->format('M d, Y H:i') }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="ki-filled ki-time text-muted-foreground"></i>
                            <span class="text-secondary-foreground">Last Updated:</span>
                            <span class="font-medium">{{ $assistanceRequest->updated_at->format('M d, Y H:i') }}</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <i class="ki-filled ki-timer text-muted-foreground"></i>
                            <span class="text-secondary-foreground">Age:</span>
                            <span class="font-medium">{{ $assistanceRequest->created_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="kt-card">
                <div class="kt-card-header"><h3 class="kt-card-title">Quick Actions</h3></div>
                <div class="kt-card-body p-5 space-y-2">
                    @if($assistanceRequest->phone)
                        <a href="tel:{{ $assistanceRequest->phone }}" class="kt-btn kt-btn-outline w-full">
                            <i class="ki-filled ki-phone"></i> Call
                        </a>
                    @endif
                    @if($assistanceRequest->email)
                        <a href="mailto:{{ $assistanceRequest->email }}" class="kt-btn kt-btn-outline w-full">
                            <i class="ki-filled ki-sms"></i> Email
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

