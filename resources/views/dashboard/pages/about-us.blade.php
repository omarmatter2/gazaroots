@extends('dashboard.layouts.app')

@section('title', 'About Us Page')

@section('content')
<div class="container-fixed p-5">
    <!-- Page Header -->
    <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
        <div class="flex flex-col justify-center gap-2">
            <h1 class="text-xl font-semibold leading-none text-mono">About Us Page</h1>
            <div class="flex items-center gap-2 text-sm font-medium text-secondary-foreground">
                Manage the About Us page content
            </div>
        </div>
    </div>

    @if(session('success'))
        <div class="kt-alert kt-alert-success mb-5">
            <div class="kt-alert-icon"><i class="ki-filled ki-check-circle"></i></div>
            <div class="kt-alert-content">{{ session('success') }}</div>
        </div>
    @endif

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

    <form action="{{ route('admin.pages.about-us.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="kt-card">
            <div class="kt-card-content p-7.5">
                <div class="grid gap-5 lg:gap-7.5">
                    <!-- Title EN -->
                    <div class="flex flex-col gap-1">
                        <label class="kt-form-label" for="title_en">Title (English) <span class="text-danger">*</span></label>
                        <input type="text" class="kt-input" id="title_en" name="title[en]" value="{{ old('title.en', $page->getTranslation('title', 'en')) }}" required>
                    </div>

                    <!-- Title AR -->
                    <div class="flex flex-col gap-1">
                        <label class="kt-form-label" for="title_ar">Title (Arabic) <span class="text-danger">*</span></label>
                        <input type="text" class="kt-input" id="title_ar" name="title[ar]" value="{{ old('title.ar', $page->getTranslation('title', 'ar')) }}" dir="rtl" required>
                    </div>

                    <!-- Content EN -->
                    <div class="flex flex-col gap-1">
                        <label class="kt-form-label" for="content_en">Content (English) <span class="text-danger">*</span></label>
                        <textarea class="kt-textarea tinymce-editor" id="content_en" name="content[en]" rows="15">{{ old('content.en', $page->getTranslation('content', 'en')) }}</textarea>
                    </div>

                    <!-- Content AR -->
                    <div class="flex flex-col gap-1">
                        <label class="kt-form-label" for="content_ar">Content (Arabic) <span class="text-danger">*</span></label>
                        <textarea class="kt-textarea tinymce-editor" id="content_ar" name="content[ar]" rows="15" dir="rtl">{{ old('content.ar', $page->getTranslation('content', 'ar')) }}</textarea>
                    </div>
                </div>
            </div>
            <div class="kt-card-footer flex justify-end gap-2.5 p-7.5 border-t border-border">
                <button type="submit" class="kt-btn kt-btn-primary">Save Changes</button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('styles')
<style>
    .tox-tinymce {
        border-radius: 0.5rem !important;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.tiny.cloud/1/yxt0wjkty6bsfgmrdyl4x94ekcpegaa7u0qpav1izndh4d2m/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: '.tinymce-editor',
        height: 400,
        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
        toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table | align lineheight | numlist bullist indent outdent | emoticons charmap | removeformat',
        content_style: 'body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; font-size: 14px; }',
        directionality: 'ltr',
        setup: function(editor) {
            if (editor.id === 'content_ar') {
                editor.on('init', function() {
                    editor.getBody().dir = 'rtl';
                });
            }
        }
    });
</script>
@endpush

