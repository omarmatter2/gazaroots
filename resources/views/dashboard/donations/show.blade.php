@extends('dashboard.layouts.app')

@section('title', 'View Donation')

@section('content')
<div class="container-fixed p-5">
    <div class="flex flex-wrap items-center justify-between gap-5 pb-7.5">
        <div class="flex flex-col gap-2">
            <h1 class="text-xl font-semibold text-primary">View Donation</h1>
            <nav class="flex gap-1.5 text-sm text-secondary-foreground">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>/</span>
                <a href="{{ route('admin.donations.index') }}">Donations</a>
                <span>/</span>
                <span class="text-foreground">#{{ $donation->id }}</span>
            </nav>
        </div>
        <div class="flex gap-2.5">
            <a href="{{ route('admin.donations.edit', $donation) }}" class="kt-btn kt-btn-primary">
                <i class="ki-filled ki-pencil"></i> Edit
            </a>
            <a href="{{ route('admin.donations.index') }}" class="kt-btn kt-btn-outline">Back to List</a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
        <!-- Main -->
        <div class="lg:col-span-2">
            <div class="kt-card">
                <div class="kt-card-header"><h3 class="kt-card-title">Donation Details</h3></div>
                <div class="kt-card-body p-7.5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="text-sm text-secondary-foreground">Donor Name</label>
                            <p class="font-medium">{{ $donation->donor_name }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-secondary-foreground">Email</label>
                            <p class="font-medium">{{ $donation->donor_email ?: 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-secondary-foreground">Phone</label>
                            <p class="font-medium">{{ $donation->donor_phone ?: 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-secondary-foreground">Water Project</label>
                            <p class="font-medium">
                                @if($donation->waterProject)
                                    <a href="{{ route('admin.water-projects.show', $donation->waterProject) }}" class="text-primary hover:underline">{{ $donation->waterProject->title_en }}</a>
                                @else
                                    N/A
                                @endif
                            </p>
                        </div>
                        <div>
                            <label class="text-sm text-secondary-foreground">Payment Method</label>
                            <p class="font-medium">{{ ucfirst($donation->payment_method ?? 'N/A') }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-secondary-foreground">Transaction ID</label>
                            <p class="font-mono text-sm bg-muted px-2 py-1 rounded inline-block">{{ $donation->transaction_id ?: 'N/A' }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="text-sm text-secondary-foreground">Notes</label>
                            <p class="text-foreground">{{ $donation->notes ?: 'No notes' }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-5">
            <div class="kt-card">
                <div class="kt-card-header"><h3 class="kt-card-title">Amount</h3></div>
                <div class="kt-card-body p-5 text-center">
                    <div class="text-4xl font-bold text-success">${{ number_format($donation->amount, 2) }}</div>
                    <p class="text-sm text-secondary-foreground mt-2">{{ ucfirst(str_replace('_', ' ', $donation->type)) }} Donation</p>
                </div>
            </div>

            <div class="kt-card">
                <div class="kt-card-header"><h3 class="kt-card-title">Status</h3></div>
                <div class="kt-card-body p-5">
                    <span class="kt-badge kt-badge-lg {{ $donation->status === 'completed' ? 'kt-badge-success' : ($donation->status === 'pending' ? 'kt-badge-warning' : 'kt-badge-danger') }}">
                        {{ ucfirst($donation->status) }}
                    </span>
                    <div class="mt-4 text-sm text-secondary-foreground">
                        <p>Created: {{ $donation->created_at->format('M d, Y H:i') }}</p>
                        <p>Updated: {{ $donation->updated_at->format('M d, Y H:i') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

