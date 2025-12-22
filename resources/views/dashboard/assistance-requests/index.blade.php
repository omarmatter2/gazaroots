@extends('dashboard.layouts.app')

@section('title', 'Assistance Requests')

@section('content')
<div class="container-fixed p-5">
    <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
        <div class="flex flex-col justify-center gap-2">
            <h1 class="text-xl font-semibold leading-none text-mono">Assistance Requests</h1>
            <div class="flex items-center gap-2 text-sm font-medium text-secondary-foreground">Manage assistance requests</div>
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
                            <th>Name</th>
                            <th>Phone</th>
                            <th>Location</th>
                            <th class="w-[100px]">Status</th>
                            <th>Date</th>
                            <th class="w-[120px]">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($requests as $request)
                            <tr>
                                <td>{{ $request->id }}</td>
                                <td>{{ $request->full_name }}</td>
                                <td>{{ $request->phone }}</td>
                                <td>{{ $request->location ?? '-' }}</td>
                                <td>
                                    @switch($request->status)
                                        @case('new')
                                            <span class="kt-badge kt-badge-sm kt-badge-info">New</span>
                                            @break
                                        @case('in_progress')
                                            <span class="kt-badge kt-badge-sm kt-badge-warning">In Progress</span>
                                            @break
                                        @case('resolved')
                                            <span class="kt-badge kt-badge-sm kt-badge-success">Resolved</span>
                                            @break
                                        @case('rejected')
                                            <span class="kt-badge kt-badge-sm kt-badge-danger">Rejected</span>
                                            @break
                                    @endswitch
                                </td>
                                <td>{{ $request->created_at->format('M d, Y') }}</td>
                                <td>
                                    <div class="flex items-center gap-1">
                                        <a href="{{ route('admin.assistance-requests.show', $request) }}" class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" title="View">
                                            <i class="ki-filled ki-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.assistance-requests.edit', $request) }}" class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" title="Edit">
                                            <i class="ki-filled ki-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.assistance-requests.destroy', $request) }}" method="POST" class="inline delete-form">
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
                                <td colspan="7" class="text-center py-10 text-secondary-foreground">
                                    No assistance requests found.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="mt-5">{{ $requests->links() }}</div>
</div>
@endsection

