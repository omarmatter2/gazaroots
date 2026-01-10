@extends('dashboard.layouts.app')

@section('title', 'Social Media')

@section('content')
<div class="container-fixed p-5">
    <!-- Page Header -->
    <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
        <div class="flex flex-col justify-center gap-2">
            <h1 class="text-xl font-semibold leading-none text-mono">Social Media</h1>
            <div class="flex items-center gap-2 text-sm font-medium text-secondary-foreground">
                Manage social media links
            </div>
        </div>
        <div class="flex items-center gap-2.5">
            <a href="{{ route('admin.social-media.create') }}" class="kt-btn kt-btn-primary">
                <i class="ki-filled ki-plus-squared"></i>
                Add Social Media
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="kt-alert kt-alert-success mb-5">
            <div class="kt-alert-icon"><i class="ki-filled ki-check-circle"></i></div>
            <div class="kt-alert-content">{{ session('success') }}</div>
        </div>
    @endif

    <!-- Social Media Table -->
    <div class="kt-card">
        <div class="kt-card-content">
            <div class="kt-scrollable-x-auto">
                <table class="kt-table kt-table-border">
                    <thead>
                        <tr>
                            <th class="w-[60px]">Order</th>
                            <th>Platform</th>
                            <th class="w-[80px]">Image</th>
                            <th>URL</th>
                            <th class="w-[100px]">Status</th>
                            <th class="w-[120px]">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($socialMedia as $item)
                            <tr>
                                <td>{{ $item->order }}</td>
                                <td>
                                    <span class="font-medium">{{ $item->platform }}</span>
                                </td>
                                <td>
                                    @if($item->image)
                                        <img src="{{ $item->image_url }}"
                                             alt="{{ $item->platform }}" class="w-8 h-8">
                                    @else
                                        <span class="text-secondary-foreground">-</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ $item->url }}" target="_blank" class="kt-link text-sm truncate max-w-[200px] inline-block">
                                        {{ $item->url }}
                                    </a>
                                </td>
                                <td>
                                    @if($item->is_active)
                                        <span class="kt-badge kt-badge-sm kt-badge-success">Active</span>
                                    @else
                                        <span class="kt-badge kt-badge-sm kt-badge-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="flex items-center gap-1">
                                        <a href="{{ route('admin.social-media.edit', $item) }}" class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" title="Edit">
                                            <i class="ki-filled ki-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.social-media.destroy', $item) }}" method="POST" class="inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost text-danger" title="Delete">
                                                <i class="ki-filled ki-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-10 text-secondary-foreground">
                                    No social media links found. <a href="{{ route('admin.social-media.create') }}" class="kt-link">Create one</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

