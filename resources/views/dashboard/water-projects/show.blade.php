@extends('dashboard.layouts.app')

@section('title', 'View Water Project')

@section('content')
<div class="container-fixed p-5">
    <div class="flex flex-wrap items-center justify-between gap-5 pb-7.5">
        <div class="flex flex-col gap-2">
            <h1 class="text-xl font-semibold text-primary">View Water Project</h1>
            <nav class="flex gap-1.5 text-sm text-secondary-foreground">
                <a href="{{ route('admin.dashboard') }}">Dashboard</a>
                <span>/</span>
                <a href="{{ route('admin.water-projects.index') }}">Water Projects</a>
                <span>/</span>
                <span class="text-foreground">{{ Str::limit($waterProject->getTranslation('title', 'en'), 30) }}</span>
            </nav>
        </div>
        <div class="flex gap-2.5">
            <a href="{{ route('admin.water-projects.edit', $waterProject) }}" class="kt-btn kt-btn-primary">
                <i class="ki-filled ki-pencil"></i> Edit
            </a>
            <a href="{{ route('admin.water-projects.index') }}" class="kt-btn kt-btn-outline">Back to List</a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
        <!-- Main -->
        <div class="lg:col-span-2 space-y-5">
            <div class="kt-card">
                <div class="kt-card-header"><h3 class="kt-card-title">Project Details</h3></div>
                <div class="kt-card-body p-7.5 space-y-5">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <div>
                            <label class="text-sm text-secondary-foreground">Title (English)</label>
                            <p class="font-medium">{{ $waterProject->getTranslation('title', 'en') }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-secondary-foreground">Title (Arabic)</label>
                            <p class="font-medium" dir="rtl">{{ $waterProject->getTranslation('title', 'ar') }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-secondary-foreground">Location</label>
                            <p class="font-medium">{{ $waterProject->location ?: 'N/A' }}</p>
                        </div>
                        <div>
                            <label class="text-sm text-secondary-foreground">Slug</label>
                            <p class="font-mono text-sm bg-muted px-2 py-1 rounded inline-block">{{ $waterProject->slug }}</p>
                        </div>
                    </div>
                    <div>
                        <label class="text-sm text-secondary-foreground">Description (English)</label>
                        <p class="text-foreground mt-1">{{ $waterProject->getTranslation('description', 'en') ?: 'N/A' }}</p>
                    </div>
                    <div>
                        <label class="text-sm text-secondary-foreground">Description (Arabic)</label>
                        <p class="text-foreground mt-1" dir="rtl">{{ $waterProject->getTranslation('description', 'ar') ?: 'N/A' }}</p>
                    </div>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="kt-card p-5 text-center">
                    <div class="text-2xl font-bold text-primary">{{ number_format($waterProject->wells_built) }}</div>
                    <p class="text-sm text-secondary-foreground">Wells Built</p>
                </div>
                <div class="kt-card p-5 text-center">
                    <div class="text-2xl font-bold text-success">{{ number_format($waterProject->beneficiaries) }}</div>
                    <p class="text-sm text-secondary-foreground">Beneficiaries</p>
                </div>
                <div class="kt-card p-5 text-center">
                    <div class="text-2xl font-bold text-info">{{ number_format($waterProject->families_served) }}</div>
                    <p class="text-sm text-secondary-foreground">Families</p>
                </div>
                <div class="kt-card p-5 text-center">
                    <div class="text-2xl font-bold text-warning">{{ number_format($waterProject->neighborhoods) }}</div>
                    <p class="text-sm text-secondary-foreground">Neighborhoods</p>
                </div>
            </div>

            <!-- Donations -->
            @if($waterProject->donations->count() > 0)
            <div class="kt-card">
                <div class="kt-card-header"><h3 class="kt-card-title">Recent Donations</h3></div>
                <div class="kt-card-body p-0">
                    <div class="kt-table-container">
                        <table class="kt-table">
                            <thead><tr><th>Donor</th><th>Amount</th><th>Status</th><th>Date</th></tr></thead>
                            <tbody>
                            @foreach($waterProject->donations->take(5) as $donation)
                                <tr>
                                    <td>{{ $donation->donor_name }}</td>
                                    <td class="font-medium">${{ number_format($donation->amount, 2) }}</td>
                                    <td><span class="kt-badge kt-badge-{{ $donation->status === 'completed' ? 'success' : 'warning' }}">{{ ucfirst($donation->status) }}</span></td>
                                    <td>{{ $donation->created_at->format('M d, Y') }}</td>
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
                <div class="kt-card-header"><h3 class="kt-card-title">Image</h3></div>
                <div class="kt-card-body p-5">
                    @if($waterProject->image)
                        <img src="{{ Storage::url($waterProject->image) }}" alt="{{ $waterProject->getTranslation('title', 'en') }}" class="w-full rounded-lg">
                    @else
                        <div class="flex items-center justify-center h-32 bg-muted rounded-lg">
                            <i class="ki-filled ki-drop text-3xl text-muted-foreground"></i>
                        </div>
                    @endif
                </div>
            </div>

            <div class="kt-card">
                <div class="kt-card-header"><h3 class="kt-card-title">Donations Summary</h3></div>
                <div class="kt-card-body p-5">
                    <div class="text-2xl font-bold text-success">${{ number_format($waterProject->total_donations, 2) }}</div>
                    <p class="text-sm text-secondary-foreground">Total Donations</p>
                    <div class="mt-3">
                        <span class="kt-badge {{ $waterProject->is_active ? 'kt-badge-success' : 'kt-badge-danger' }}">{{ $waterProject->is_active ? 'Active' : 'Inactive' }}</span>
                    </div>
                    <div class="mt-3 text-xs text-secondary-foreground">
                        <p>Created: {{ $waterProject->created_at->format('M d, Y') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

