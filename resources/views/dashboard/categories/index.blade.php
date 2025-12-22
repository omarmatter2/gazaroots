@extends('dashboard.layouts.app')

@section('title', 'Categories')

@section('content')
<div class="container-fixed p-5">
    <!-- Page Header -->
    <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
        <div class="flex flex-col justify-center gap-2">
            <h1 class="text-xl font-semibold leading-none text-mono">Categories</h1>
            <div class="flex items-center gap-2 text-sm font-medium text-secondary-foreground">
                Manage news categories
            </div>
        </div>
        <div class="flex items-center gap-2.5">
            <a href="{{ route('admin.categories.create') }}" class="kt-btn kt-btn-primary">
                <i class="ki-filled ki-plus-squared"></i>
                Add Category
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="kt-alert kt-alert-success mb-5">
            <div class="kt-alert-icon"><i class="ki-filled ki-check-circle"></i></div>
            <div class="kt-alert-content">{{ session('success') }}</div>
        </div>
    @endif

    <!-- Categories Table -->
    <div class="kt-card">
        <div class="kt-card-content">
            <div class="kt-scrollable-x-auto">
                <table class="kt-table kt-table-border">
                    <thead>
                        <tr>
                            <th class="w-[60px]">#</th>
                            <th>Name (EN)</th>
                            <th>Name (AR)</th>
                            <th>Slug</th>
                            <th class="w-[100px]">Status</th>
                            <th class="w-[100px]">On Home</th>
                            <th class="w-[80px]">Order</th>
                            <th class="w-[120px]">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>{{ $category->id }}</td>
                                <td>{{ $category->getTranslation('name', 'en') }}</td>
                                <td>{{ $category->getTranslation('name', 'ar') }}</td>
                                <td><code class="text-xs">{{ $category->slug }}</code></td>
                                <td>
                                    @if($category->is_active)
                                        <span class="kt-badge kt-badge-sm kt-badge-success">Active</span>
                                    @else
                                        <span class="kt-badge kt-badge-sm kt-badge-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    @if($category->show_on_home)
                                        <span class="kt-badge kt-badge-sm kt-badge-primary">Yes</span>
                                    @else
                                        <span class="kt-badge kt-badge-sm kt-badge-outline">No</span>
                                    @endif
                                </td>
                                <td>{{ $category->order }}</td>
                                <td>
                                    <div class="flex items-center gap-1">
                                        <a href="{{ route('admin.categories.show', $category) }}" class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" title="View">
                                            <i class="ki-filled ki-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.categories.edit', $category) }}" class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" title="Edit">
                                            <i class="ki-filled ki-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="inline delete-form">
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
                                    No categories found. <a href="{{ route('admin.categories.create') }}" class="kt-link">Create one</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Pagination -->
    <div class="mt-5">
        {{ $categories->links() }}
    </div>
</div>
@endsection

