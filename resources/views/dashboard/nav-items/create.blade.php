@extends('dashboard.layouts.app')

@section('title', 'Add Navigation Item')

@section('toolbar')
    <a href="{{ route('admin.nav-items.index') }}" class="kt-btn kt-btn-light">
        <i class="ki-filled ki-arrow-left"></i>
        Back to List
    </a>
@endsection

@section('content')
    <div class="card p-5">
        <div class="card-header p-0 pb-5">
            <h3 class="card-title">Add Navigation Item</h3>
        </div>
        <div class="card-body p-0">
            <form action="{{ route('admin.nav-items.store') }}" method="POST">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                    <!-- Left Column -->
                    <div class="flex flex-col gap-5">
                        <!-- Title EN -->
                        <div class="flex flex-col gap-2">
                            <label class="kt-form-label" for="title_en">Title (English) <span class="text-danger">*</span></label>
                            <input type="text" class="kt-input @error('title_en') border-danger @enderror" id="title_en" name="title_en" value="{{ old('title_en') }}" required>
                            @error('title_en')<span class="text-danger text-sm">{{ $message }}</span>@enderror
                        </div>

                        <!-- Title AR -->
                        <div class="flex flex-col gap-2">
                            <label class="kt-form-label" for="title_ar">Title (Arabic) <span class="text-danger">*</span></label>
                            <input type="text" class="kt-input @error('title_ar') border-danger @enderror" id="title_ar" name="title_ar" value="{{ old('title_ar') }}" dir="rtl" required>
                            @error('title_ar')<span class="text-danger text-sm">{{ $message }}</span>@enderror
                        </div>

                        <!-- URL -->
                        <div class="flex flex-col gap-2">
                            <label class="kt-form-label" for="url">URL / Route Name</label>
                            <input type="text" class="kt-input @error('url') border-danger @enderror" id="url" name="url" value="{{ old('url') }}" placeholder="e.g. home, /about, https://...">
                            <span class="text-sm text-gray-500">Enter a route name (e.g. home) or full URL. Leave empty for dropdowns.</span>
                            @error('url')<span class="text-danger text-sm">{{ $message }}</span>@enderror
                        </div>

                        <!-- Type -->
                        <div class="flex flex-col gap-2">
                            <label class="kt-form-label" for="type">Type <span class="text-danger">*</span></label>
                            <select class="kt-select @error('type') border-danger @enderror" id="type" name="type" required>
                                <option value="link" {{ old('type') == 'link' ? 'selected' : '' }}>Link</option>
                                <option value="dropdown" {{ old('type') == 'dropdown' ? 'selected' : '' }}>Dropdown</option>
                                <option value="button" {{ old('type') == 'button' ? 'selected' : '' }}>Button</option>
                            </select>
                            @error('type')<span class="text-danger text-sm">{{ $message }}</span>@enderror
                        </div>
                    </div>

                    <!-- Right Column -->
                    <div class="flex flex-col gap-5">
                        <!-- Parent -->
                        <div class="flex flex-col gap-2">
                            <label class="kt-form-label" for="parent_id">Parent Item</label>
                            <select class="kt-select @error('parent_id') border-danger @enderror" id="parent_id" name="parent_id">
                                <option value="">— None (Top Level) —</option>
                                @foreach($parentItems as $parent)
                                    <option value="{{ $parent->id }}" {{ old('parent_id') == $parent->id ? 'selected' : '' }}>
                                        {{ $parent->getTranslation('title', 'en') }}
                                    </option>
                                @endforeach
                            </select>
                            <span class="text-sm text-gray-500">Select a parent to make this a dropdown child item.</span>
                            @error('parent_id')<span class="text-danger text-sm">{{ $message }}</span>@enderror
                        </div>

                        <!-- Target -->
                        <div class="flex flex-col gap-2">
                            <label class="kt-form-label" for="target">Target</label>
                            <select class="kt-select @error('target') border-danger @enderror" id="target" name="target">
                                <option value="_self" {{ old('target') == '_self' ? 'selected' : '' }}>Same Tab (_self)</option>
                                <option value="_blank" {{ old('target') == '_blank' ? 'selected' : '' }}>New Tab (_blank)</option>
                            </select>
                        </div>

                        <!-- CSS Class -->
                        <div class="flex flex-col gap-2">
                            <label class="kt-form-label" for="css_class">CSS Class</label>
                            <input type="text" class="kt-input" id="css_class" name="css_class" value="{{ old('css_class') }}" placeholder="e.g. gr-btn--donate">
                            <span class="text-sm text-gray-500">Optional custom CSS class for styling.</span>
                        </div>

                        <!-- Order -->
                        <div class="flex flex-col gap-2">
                            <label class="kt-form-label" for="order">Order</label>
                            <input type="number" class="kt-input" id="order" name="order" value="{{ old('order', 0) }}">
                        </div>

                        <!-- Status -->
                        <div class="flex flex-col gap-2">
                            <label class="kt-form-label">Status</label>
                            <div class="flex items-center gap-2.5">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" class="kt-switch" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                                <span class="text-sm text-secondary-foreground">Active</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-end gap-3 mt-6 pt-5 border-t">
                    <a href="{{ route('admin.nav-items.index') }}" class="kt-btn kt-btn-light">Cancel</a>
                    <button type="submit" class="kt-btn kt-btn-primary">Create Navigation Item</button>
                </div>
            </form>
        </div>
    </div>
@endsection

