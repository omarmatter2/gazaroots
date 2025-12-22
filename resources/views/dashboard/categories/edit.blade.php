@extends('dashboard.layouts.app')

@section('title', 'Edit Category')

@section('content')
<div class="container-fixed p-5">
    <!-- Page Header -->
    <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
        <div class="flex flex-col justify-center gap-2">
            <h1 class="text-xl font-semibold leading-none text-mono">Edit Category</h1>
            <div class="flex items-center gap-2 text-sm font-medium text-secondary-foreground">
                <a href="{{ route('admin.categories.index') }}" class="kt-link">Categories</a>
                <span>/</span>
                <span>{{ $category->getTranslation('name', 'en') }}</span>
            </div>
        </div>
    </div>

    @if($errors->any())
        <div class="kt-alert kt-alert-danger mb-5">
            <div class="kt-alert-icon"><i class="ki-filled ki-cross-circle"></i></div>
            <div class="kt-alert-content">
                <ul class="list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="kt-card">
            <div class="kt-card-content p-7.5">
                <div class="grid gap-5 lg:gap-7.5">
                    <!-- Name EN -->
                    <div class="flex flex-col gap-1">
                        <label class="kt-form-label" for="name_en">Name (English) <span class="text-danger">*</span></label>
                        <input type="text" class="kt-input" id="name_en" name="name[en]" value="{{ old('name.en', $category->getTranslation('name', 'en')) }}" required>
                    </div>

                    <!-- Name AR -->
                    <div class="flex flex-col gap-1">
                        <label class="kt-form-label" for="name_ar">Name (Arabic) <span class="text-danger">*</span></label>
                        <input type="text" class="kt-input" id="name_ar" name="name[ar]" value="{{ old('name.ar', $category->getTranslation('name', 'ar')) }}" dir="rtl" required>
                    </div>

                    <!-- Description EN -->
                    <div class="flex flex-col gap-1">
                        <label class="kt-form-label" for="description_en">Description (English)</label>
                        <textarea class="kt-textarea" id="description_en" name="description[en]" rows="3">{{ old('description.en', $category->getTranslation('description', 'en')) }}</textarea>
                    </div>

                    <!-- Description AR -->
                    <div class="flex flex-col gap-1">
                        <label class="kt-form-label" for="description_ar">Description (Arabic)</label>
                        <textarea class="kt-textarea" id="description_ar" name="description[ar]" rows="3" dir="rtl">{{ old('description.ar', $category->getTranslation('description', 'ar')) }}</textarea>
                    </div>

                    <!-- Image -->
                    <div class="flex flex-col gap-2">
                        <label class="kt-form-label">Image</label>
                        <div class="flex items-start gap-5">
                            @if($category->image)
                            <div class="flex flex-col gap-2">
                                <img src="{{ Storage::url($category->image) }}" alt="{{ $category->getTranslation('name', 'en') }}" class="w-24 h-24 object-cover rounded-lg border border-border">
                                <span class="text-xs text-secondary-foreground">Current image</span>
                            </div>
                            @endif
                            <div class="flex flex-col gap-2">
                                <label class="flex flex-col items-center justify-center w-24 h-24 border-2 border-dashed border-border rounded-lg cursor-pointer hover:bg-muted/50 transition-colors">
                                    <div class="flex flex-col items-center justify-center" id="image-placeholder">
                                        <i class="ki-filled ki-picture text-2xl text-muted-foreground mb-1"></i>
                                        <span class="text-xs text-secondary-foreground">Upload</span>
                                    </div>
                                    <img id="image-preview" class="hidden w-full h-full object-cover rounded-lg" alt="Preview">
                                    <input type="file" name="image" accept=".png,.jpg,.jpeg" class="hidden" onchange="previewImage(this)">
                                </label>
                                <span class="text-xs text-secondary-foreground">{{ $category->image ? 'Upload new' : 'PNG, JPG' }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-5">
                        <!-- Order -->
                        <div class="flex flex-col gap-1">
                            <label class="kt-form-label" for="order">Order</label>
                            <input type="number" class="kt-input" id="order" name="order" value="{{ old('order', $category->order) }}" min="0">
                        </div>

                        <!-- Status -->
                        <div class="flex flex-col gap-2">
                            <label class="kt-form-label">Status</label>
                            <div class="flex items-center gap-2.5">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" class="kt-switch" name="is_active" value="1" {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                                <span class="text-sm text-secondary-foreground">Active</span>
                            </div>
                        </div>

                        <!-- Show on Home -->
                        <div class="flex flex-col gap-2">
                            <label class="kt-form-label">Show on Home Page</label>
                            <div class="flex items-center gap-2.5">
                                <input type="hidden" name="show_on_home" value="0">
                                <input type="checkbox" class="kt-switch" name="show_on_home" value="1" {{ old('show_on_home', $category->show_on_home) ? 'checked' : '' }}>
                                <span class="text-sm text-secondary-foreground">Display in categories section on homepage</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-card-footer flex justify-end gap-2.5 p-7.5 border-t border-border">
                <a href="{{ route('admin.categories.index') }}" class="kt-btn kt-btn-outline">Cancel</a>
                <button type="submit" class="kt-btn kt-btn-primary">Update Category</button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
function previewImage(input) {
    const preview = document.getElementById('image-preview');
    const placeholder = document.getElementById('image-placeholder');

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            placeholder.classList.add('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush
