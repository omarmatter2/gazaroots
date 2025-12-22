@extends('dashboard.layouts.app')

@section('title', 'Edit Water Project')

@section('content')
<div class="container-fixed p-5">
    <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
        <div class="flex flex-col justify-center gap-2">
            <h1 class="text-xl font-semibold leading-none text-mono">Edit Water Project</h1>
            <div class="flex items-center gap-2 text-sm font-medium text-secondary-foreground">
                <a href="{{ route('admin.water-projects.index') }}" class="kt-link">Water Projects</a>
                <span>/</span>
                <span>{{ $waterProject->getTranslation('title', 'en') }}</span>
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

    <form action="{{ route('admin.water-projects.update', $waterProject) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="kt-card">
            <div class="kt-card-content p-7.5">
                <div class="grid gap-5 lg:gap-7.5">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                        <div class="flex flex-col gap-1">
                            <label class="kt-form-label" for="title_en">Title (English) <span class="text-danger">*</span></label>
                            <input type="text" class="kt-input" id="title_en" name="title[en]" value="{{ old('title.en', $waterProject->getTranslation('title', 'en')) }}" required>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="kt-form-label" for="title_ar">Title (Arabic) <span class="text-danger">*</span></label>
                            <input type="text" class="kt-input" id="title_ar" name="title[ar]" value="{{ old('title.ar', $waterProject->getTranslation('title', 'ar')) }}" dir="rtl" required>
                        </div>
                    </div>
                    <div class="flex flex-col gap-1">
                        <label class="kt-form-label" for="location">Location</label>
                        <input type="text" class="kt-input" id="location" name="location" value="{{ old('location', $waterProject->location) }}">
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                        <div class="flex flex-col gap-1">
                            <label class="kt-form-label" for="description_en">Description (English)</label>
                            <textarea class="kt-textarea" id="description_en" name="description[en]" rows="4">{{ old('description.en', $waterProject->getTranslation('description', 'en')) }}</textarea>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="kt-form-label" for="description_ar">Description (Arabic)</label>
                            <textarea class="kt-textarea" id="description_ar" name="description[ar]" rows="4" dir="rtl">{{ old('description.ar', $waterProject->getTranslation('description', 'ar')) }}</textarea>
                        </div>
                    </div>
                    <div class="grid grid-cols-2 lg:grid-cols-4 gap-5">
                        <div class="flex flex-col gap-1">
                            <label class="kt-form-label" for="wells_built">Wells Built</label>
                            <input type="number" class="kt-input" id="wells_built" name="wells_built" value="{{ old('wells_built', $waterProject->wells_built) }}" min="0">
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="kt-form-label" for="beneficiaries">Beneficiaries</label>
                            <input type="number" class="kt-input" id="beneficiaries" name="beneficiaries" value="{{ old('beneficiaries', $waterProject->beneficiaries) }}" min="0">
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="kt-form-label" for="families_served">Families Served</label>
                            <input type="number" class="kt-input" id="families_served" name="families_served" value="{{ old('families_served', $waterProject->families_served) }}" min="0">
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="kt-form-label" for="neighborhoods">Neighborhoods</label>
                            <input type="number" class="kt-input" id="neighborhoods" name="neighborhoods" value="{{ old('neighborhoods', $waterProject->neighborhoods) }}" min="0">
                        </div>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-5">
                        <div class="flex flex-col gap-2">
                            <label class="kt-form-label">Image</label>
                            <div class="flex items-start gap-4">
                                @if($waterProject->image)
                                <img src="{{ Storage::url($waterProject->image) }}" class="w-20 h-20 object-cover rounded-lg border">
                                @endif
                                <label class="flex flex-col items-center justify-center w-20 h-20 border-2 border-dashed border-border rounded-lg cursor-pointer hover:bg-muted/50 transition-colors">
                                    <div class="flex flex-col items-center justify-center" id="image-placeholder">
                                        <i class="ki-filled ki-picture text-xl text-muted-foreground"></i>
                                    </div>
                                    <img id="image-preview" class="hidden w-full h-full object-cover rounded-lg" alt="Preview">
                                    <input type="file" name="image" accept=".png,.jpg,.jpeg" class="hidden" onchange="previewImage(this)">
                                </label>
                            </div>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="kt-form-label">Status</label>
                            <div class="flex items-center gap-2.5">
                                <input type="hidden" name="is_active" value="0">
                                <input type="checkbox" class="kt-switch" name="is_active" value="1" {{ old('is_active', $waterProject->is_active) ? 'checked' : '' }}>
                                <span class="text-sm text-secondary-foreground">Active</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="kt-card-footer flex justify-end gap-2.5 p-7.5 border-t border-border">
                <a href="{{ route('admin.water-projects.index') }}" class="kt-btn kt-btn-outline">Cancel</a>
                <button type="submit" class="kt-btn kt-btn-primary">Update Project</button>
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
