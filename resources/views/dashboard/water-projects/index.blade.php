@extends('dashboard.layouts.app')

@section('title', 'Water Projects')

@section('content')
<div class="container-fixed p-5">
    <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
        <div class="flex flex-col justify-center gap-2">
            <h1 class="text-xl font-semibold leading-none text-mono">Water Projects</h1>
            <div class="flex items-center gap-2 text-sm font-medium text-secondary-foreground">Manage water well projects</div>
        </div>
        <div class="flex items-center gap-2.5">
            <a href="{{ route('admin.water-projects.create') }}" class="kt-btn kt-btn-primary">
                <i class="ki-filled ki-plus-squared"></i> Add Project
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
                            <th>Title (EN)</th>
                            <th>Location</th>
                            <th>Wells Built</th>
                            <th>Beneficiaries</th>
                            <th>Donations</th>
                            <th class="w-[100px]">Status</th>
                            <th class="w-[120px]">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($projects as $project)
                            <tr>
                                <td>{{ $project->id }}</td>
                                <td>{{ $project->getTranslation('title', 'en') }}</td>
                                <td>{{ $project->location ?? '-' }}</td>
                                <td>{{ number_format($project->wells_built) }}</td>
                                <td>{{ number_format($project->beneficiaries) }}</td>
                                <td>{{ $project->donations_count }}</td>
                                <td>
                                    @if($project->is_active)
                                        <span class="kt-badge kt-badge-sm kt-badge-success">Active</span>
                                    @else
                                        <span class="kt-badge kt-badge-sm kt-badge-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="flex items-center gap-1">
                                        <a href="{{ route('admin.water-projects.show', $project) }}" class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" title="View">
                                            <i class="ki-filled ki-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.water-projects.edit', $project) }}" class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" title="Edit">
                                            <i class="ki-filled ki-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.water-projects.destroy', $project) }}" method="POST" class="inline delete-form">
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
                                    No water projects found. <a href="{{ route('admin.water-projects.create') }}" class="kt-link">Create one</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="mt-5">{{ $projects->links() }}</div>
</div>
@endsection

