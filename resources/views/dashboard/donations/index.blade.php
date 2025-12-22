@extends('dashboard.layouts.app')

@section('title', 'Donations')

@section('content')
<div class="container-fixed p-5">
    <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
        <div class="flex flex-col justify-center gap-2">
            <h1 class="text-xl font-semibold leading-none text-mono">Donations</h1>
            <div class="flex items-center gap-2 text-sm font-medium text-secondary-foreground">Manage donations</div>
        </div>
        <div class="flex items-center gap-2.5">
            <a href="{{ route('admin.donations.create') }}" class="kt-btn kt-btn-primary">
                <i class="ki-filled ki-plus-squared"></i> Add Donation
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="kt-alert kt-alert-success mb-5">
            <div class="kt-alert-icon"><i class="ki-filled ki-check-circle"></i></div>
            <div class="kt-alert-content">{{ session('success') }}</div>
        </div>
    @endif

    <div class="kt-card">
        <div class="kt-card-content">
            <div class="kt-scrollable-x-auto">
                <table class="kt-table kt-table-border">
                    <thead>
                        <tr>
                            <th class="w-[60px]">#</th>
                            <th>Donor</th>
                            <th>Project</th>
                            <th>Amount</th>
                            <th>Type</th>
                            <th class="w-[100px]">Status</th>
                            <th>Date</th>
                            <th class="w-[120px]">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($donations as $donation)
                            <tr>
                                <td>{{ $donation->id }}</td>
                                <td>{{ $donation->donor_name }}</td>
                                <td>{{ $donation->waterProject?->title_en ?? 'General' }}</td>
                                <td class="font-semibold">${{ number_format($donation->amount, 2) }}</td>
                                <td>
                                    @if($donation->type === 'monthly')
                                        <span class="kt-badge kt-badge-sm kt-badge-info">Monthly</span>
                                    @else
                                        <span class="kt-badge kt-badge-sm kt-badge-secondary">One-time</span>
                                    @endif
                                </td>
                                <td>
                                    @switch($donation->status)
                                        @case('completed')
                                            <span class="kt-badge kt-badge-sm kt-badge-success">Completed</span>
                                            @break
                                        @case('pending')
                                            <span class="kt-badge kt-badge-sm kt-badge-warning">Pending</span>
                                            @break
                                        @case('failed')
                                            <span class="kt-badge kt-badge-sm kt-badge-danger">Failed</span>
                                            @break
                                        @default
                                            <span class="kt-badge kt-badge-sm kt-badge-secondary">{{ $donation->status }}</span>
                                    @endswitch
                                </td>
                                <td>{{ $donation->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="flex items-center gap-1">
                                        <a href="{{ route('admin.donations.show', $donation) }}" class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" title="View">
                                            <i class="ki-filled ki-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.donations.edit', $donation) }}" class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" title="Edit">
                                            <i class="ki-filled ki-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.donations.destroy', $donation) }}" method="POST" class="inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost text-danger">
                                                <i class="ki-filled ki-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center py-10 text-secondary-foreground">
                                    No donations found. <a href="{{ route('admin.donations.create') }}" class="kt-link">Add one</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="mt-5">{{ $donations->links() }}</div>
</div>
@endsection

