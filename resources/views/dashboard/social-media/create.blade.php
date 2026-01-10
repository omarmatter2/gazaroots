@extends('dashboard.layouts.app')

@section('title', 'Add Social Media')

@section('content')
<div class="container-fixed p-5">
    <!-- Page Header -->
    <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
        <div class="flex flex-col justify-center gap-2">
            <h1 class="text-xl font-semibold leading-none text-mono">Add Social Media</h1>
            <div class="flex items-center gap-2 text-sm font-medium text-secondary-foreground">
                <a href="{{ route('admin.social-media.index') }}" class="kt-link">Social Media</a>
                <span>/</span>
                <span>Create</span>
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

    <form action="{{ route('admin.social-media.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="kt-card">
            <div class="kt-card-content p-7.5">
                <div class="grid gap-5 lg:gap-7.5">
                    <!-- Platform Name -->
                    <div class="flex flex-col gap-1">
                        <label class="kt-form-label" for="platform">Platform Name <span class="text-danger">*</span></label>
                        <input type="text" class="kt-input" id="platform" name="platform" value="{{ old('platform') }}"
                               placeholder="e.g. Instagram, Twitter, TikTok" required>
                    </div>

                    <!-- URL -->
                    <div class="flex flex-col gap-1">
                        <label class="kt-form-label" for="url">Social Media URL <span class="text-danger">*</span></label>
                        <input type="url" class="kt-input" id="url" name="url" value="{{ old('url') }}"
                               placeholder="https://instagram.com/yourprofile" required>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Image Upload -->
                        <div class="flex flex-col gap-2">
                            <label class="kt-form-label">Icon Image <span class="text-danger">*</span></label>
                            <label class="flex flex-col items-center justify-center w-32 h-32 border-2 border-dashed border-border rounded-lg cursor-pointer hover:bg-muted/50 transition-colors" id="image-upload-label">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6" id="image-placeholder">
                                    <i class="ki-filled ki-picture text-3xl text-muted-foreground mb-2"></i>
                                    <span class="text-xs text-secondary-foreground">Click to upload</span>
                                </div>
                                <img id="image-preview" class="hidden w-full h-full object-contain rounded-lg p-2" alt="Preview">
                                <input type="file" name="image" accept=".svg,.png,.jpg,.jpeg,.webp" class="hidden" id="image-input" onchange="previewImage(this, 'image-preview', 'image-placeholder')" required>
                            </label>
                            <span class="text-xs text-secondary-foreground">SVG, PNG, JPG up to 1MB</span>
                        </div>

                        <!-- Hover Image Upload -->
                        <div class="flex flex-col gap-2">
                            <label class="kt-form-label">Hover Icon Image</label>
                            <label class="flex flex-col items-center justify-center w-32 h-32 border-2 border-dashed border-border rounded-lg cursor-pointer hover:bg-muted/50 transition-colors">
                                <div class="flex flex-col items-center justify-center pt-5 pb-6" id="hover-placeholder">
                                    <i class="ki-filled ki-picture text-3xl text-muted-foreground mb-2"></i>
                                    <span class="text-xs text-secondary-foreground">Click to upload</span>
                                </div>
                                <img id="hover-preview" class="hidden w-full h-full object-contain rounded-lg p-2" alt="Preview">
                                <input type="file" name="hover_image" accept=".svg,.png,.jpg,.jpeg,.webp" class="hidden" onchange="previewImage(this, 'hover-preview', 'hover-placeholder')">
                            </label>
                            <span class="text-xs text-secondary-foreground">Optional - shown on hover</span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-5">
                        <!-- Order -->
                        <div class="flex flex-col gap-1">
                            <label class="kt-form-label" for="order">Display Order</label>
                            <input type="number" class="kt-input" id="order" name="order" value="{{ old('order', 0) }}" min="0">
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
            </div>
            <div class="kt-card-footer flex justify-end gap-2.5 p-7.5 border-t border-border">
                <a href="{{ route('admin.social-media.index') }}" class="kt-btn kt-btn-outline">Cancel</a>
                <button type="submit" class="kt-btn kt-btn-primary">Add Social Media</button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
function previewImage(input, previewId, placeholderId) {
    const preview = document.getElementById(previewId);
    const placeholder = document.getElementById(placeholderId);

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

