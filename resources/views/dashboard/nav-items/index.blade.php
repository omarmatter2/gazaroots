@extends('dashboard.layouts.app')

@section('title', 'Navigation Items')

@section('toolbar')
    <div class="flex items-center gap-2">
        <a href="{{ route('admin.nav-items.create') }}" class="kt-btn kt-btn-primary">
            <i class="ki-filled ki-plus"></i>
            Add Nav Item
        </a>
    </div>
@endsection

@section('content')
    <div class="card p-5">
        <div class="card-header p-0 pb-5">
            <h3 class="card-title">Navigation Items</h3>
        </div>
        <div class="card-body p-0">
            <div class="kt-scrollable-x-auto">
                <table class="kt-table kt-table-border">
                    <thead>
                        <tr>
                            <th class="w-[60px]">#</th>
                            <th>Title (EN)</th>
                            <th>Title (AR)</th>
                            <th>Type</th>
                            <th>Parent</th>
                            <th>URL / Route</th>
                            <th class="w-[80px]">Order</th>
                            <th class="w-[100px]">Status</th>
                            <th class="w-[120px]">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($navItems as $navItem)
                            <tr class="bg-gray-50">
                                <td><strong>{{ $navItem->id }}</strong></td>
                                <td><strong>{{ $navItem->getTranslation('title', 'en') }}</strong></td>
                                <td><strong>{{ $navItem->getTranslation('title', 'ar') }}</strong></td>
                                <td>
                                    @if($navItem->type == 'dropdown')
                                        <span class="kt-badge kt-badge-sm kt-badge-warning">Dropdown</span>
                                    @elseif($navItem->type == 'button')
                                        <span class="kt-badge kt-badge-sm kt-badge-info">Button</span>
                                    @else
                                        <span class="kt-badge kt-badge-sm kt-badge-outline">Link</span>
                                    @endif
                                </td>
                                <td>—</td>
                                <td><code class="text-xs">{{ $navItem->url ?? '—' }}</code></td>
                                <td>{{ $navItem->order }}</td>
                                <td>
                                    @if($navItem->is_active)
                                        <span class="kt-badge kt-badge-sm kt-badge-success">Active</span>
                                    @else
                                        <span class="kt-badge kt-badge-sm kt-badge-danger">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="flex items-center gap-1">
                                        <a href="{{ route('admin.nav-items.edit', $navItem) }}" class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" title="Edit">
                                            <i class="ki-filled ki-pencil"></i>
                                        </a>
                                        <form action="{{ route('admin.nav-items.destroy', $navItem) }}" method="POST" class="inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost text-danger" title="Delete">
                                                <i class="ki-filled ki-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            {{-- Children --}}
                            @foreach($navItem->children as $child)
                                <tr>
                                    <td class="ps-6">↳ {{ $child->id }}</td>
                                    <td class="ps-6">{{ $child->getTranslation('title', 'en') }}</td>
                                    <td>{{ $child->getTranslation('title', 'ar') }}</td>
                                    <td><span class="kt-badge kt-badge-sm kt-badge-outline">Link</span></td>
                                    <td>{{ $navItem->getTranslation('title', 'en') }}</td>
                                    <td><code class="text-xs">{{ $child->url ?? '—' }}</code></td>
                                    <td>{{ $child->order }}</td>
                                    <td>
                                        @if($child->is_active)
                                            <span class="kt-badge kt-badge-sm kt-badge-success">Active</span>
                                        @else
                                            <span class="kt-badge kt-badge-sm kt-badge-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="flex items-center gap-1">
                                            <a href="{{ route('admin.nav-items.edit', $child) }}" class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost" title="Edit">
                                                <i class="ki-filled ki-pencil"></i>
                                            </a>
                                            <form action="{{ route('admin.nav-items.destroy', $child) }}" method="POST" class="inline delete-form">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="kt-btn kt-btn-sm kt-btn-icon kt-btn-ghost text-danger" title="Delete">
                                                    <i class="ki-filled ki-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        @empty
                            <tr>
                                <td colspan="9" class="text-center py-8 text-gray-500">
                                    No navigation items yet. <a href="{{ route('admin.nav-items.create') }}" class="text-primary">Create one</a>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

