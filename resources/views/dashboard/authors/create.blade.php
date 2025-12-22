@extends('dashboard.layouts.app')

@section('title', 'Create Author')

@section('content')
<div class="container-fixed p-5">
    <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
        <div class="flex flex-col justify-center gap-2">
            <h1 class="text-xl font-semibold leading-none text-mono">Create Author</h1>
            <div class="flex items-center gap-2 text-sm font-medium text-secondary-foreground">
                <a href="{{ route('admin.authors.index') }}" class="kt-link">Authors</a>
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

    <form action="{{ route('admin.authors.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="kt-card">
            <div class="kt-card-content p-7.5">
                <div class="grid gap-5 lg:gap-7.5">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                        <div class="flex flex-col gap-1">
                            <label class="kt-form-label" for="name_en">Name (English) <span class="text-danger">*</span></label>
                            <input type="text" class="kt-input" id="name_en" name="name[en]" value="{{ old('name.en') }}" required>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="kt-form-label" for="name_ar">Name (Arabic) <span class="text-danger">*</span></label>
                            <input type="text" class="kt-input" id="name_ar" name="name[ar]" value="{{ old('name.ar') }}" dir="rtl" required>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
                        <div class="flex flex-col gap-1">
                            <label class="kt-form-label" for="email">Email</label>
                            <input type="email" class="kt-input" id="email" name="email" value="{{ old('email') }}">
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="kt-form-label" for="phone">Phone</label>
                            <input type="text" class="kt-input" id="phone" name="phone" value="{{ old('phone') }}">
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="kt-form-label" for="location">Location</label>
                            <input type="text" class="kt-input" id="location" name="location" value="{{ old('location') }}">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                        <div class="flex flex-col gap-1">
                            <label class="kt-form-label" for="bio_en">Bio (English)</label>
                            <textarea class="kt-textarea" id="bio_en" name="bio[en]" rows="4">{{ old('bio.en') }}</textarea>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="kt-form-label" for="bio_ar">Bio (Arabic)</label>
                            <textarea class="kt-textarea" id="bio_ar" name="bio[ar]" rows="4" dir="rtl">{{ old('bio.ar') }}</textarea>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                        <div class="flex flex-col gap-2">
                            <label class="kt-form-label">Avatar</label>
                            <label class="flex flex-col items-center justify-center w-24 h-24 border-2 border-dashed border-border rounded-full cursor-pointer hover:bg-muted/50 transition-colors overflow-hidden">
                                <div class="flex flex-col items-center justify-center" id="image-placeholder">
                                    <i class="ki-filled ki-user text-2xl text-muted-foreground mb-1"></i>
                                    <span class="text-xs text-secondary-foreground">Upload</span>
                                </div>
                                <img id="image-preview" class="hidden w-full h-full object-cover" alt="Preview">
                                <input type="file" name="avatar" accept=".png,.jpg,.jpeg" class="hidden" onchange="previewImage(this)">
                            </label>
                            <span class="text-xs text-secondary-foreground">PNG, JPG up to 2MB</span>
                        </div>
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
                <a href="{{ route('admin.authors.index') }}" class="kt-btn kt-btn-outline">Cancel</a>
                <button type="submit" class="kt-btn kt-btn-primary">Create Author</button>
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
