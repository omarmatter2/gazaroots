@extends('dashboard.layouts.app')

@section('title', 'Edit Newsletter')

@section('content')
<div class="container-fixed p-5">
    <div class="flex flex-wrap items-center justify-between gap-5 pb-7.5">
        <div class="flex flex-col gap-2">
            <h1 class="text-xl font-semibold text-gray-900">Edit Newsletter</h1>
            <p class="text-sm text-gray-600">
                <span class="kt-badge kt-badge-sm kt-badge-info">{{ $subscribersCount }} active subscribers</span>
            </p>
        </div>
        <a href="{{ route('admin.newsletters.index') }}" class="kt-btn kt-btn-light">
            <i class="ki-filled ki-arrow-left"></i>
            Back to List
        </a>
    </div>

    <form action="{{ route('admin.newsletters.update', $newsletter) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5">
            <div class="lg:col-span-2 space-y-5">
                <div class="kt-card">
                    <div class="kt-card-header">
                        <h3 class="kt-card-title">Newsletter Content</h3>
                    </div>
                    <div class="kt-card-body space-y-5">
                        <div class="grid grid-cols-2 gap-5">
                            <div class="flex flex-col gap-1">
                                <label class="kt-form-label" for="subject_en">Subject (English) <span class="text-danger">*</span></label>
                                <input type="text" class="kt-input" id="subject_en" name="subject[en]" value="{{ old('subject.en', $newsletter->getTranslation('subject', 'en')) }}" required>
                            </div>
                            <div class="flex flex-col gap-1">
                                <label class="kt-form-label" for="subject_ar">Subject (Arabic) <span class="text-danger">*</span></label>
                                <input type="text" class="kt-input" id="subject_ar" name="subject[ar]" value="{{ old('subject.ar', $newsletter->getTranslation('subject', 'ar')) }}" dir="rtl" required>
                            </div>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="kt-form-label" for="content_en">Content (English) <span class="text-danger">*</span></label>
                            <textarea class="tinymce-editor" id="content_en" name="content[en]">{{ old('content.en', $newsletter->getTranslation('content', 'en')) }}</textarea>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="kt-form-label" for="content_ar">Content (Arabic) <span class="text-danger">*</span></label>
                            <textarea class="tinymce-editor-rtl" id="content_ar" name="content[ar]">{{ old('content.ar', $newsletter->getTranslation('content', 'ar')) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-5">
                <div class="kt-card">
                    <div class="kt-card-header">
                        <h3 class="kt-card-title">Send Options</h3>
                    </div>
                    <div class="kt-card-body space-y-5">
                        <div class="flex flex-col gap-3">
                            <label class="flex items-center gap-2.5">
                                <input type="radio" class="kt-radio" name="send_type" value="now" {{ $newsletter->scheduled_at ? '' : 'checked' }}>
                                <span class="flex flex-col">
                                    <span class="text-sm font-medium text-gray-900">Send Immediately</span>
                                    <span class="text-xs text-gray-600">Newsletter will be sent right away</span>
                                </span>
                            </label>
                            <label class="flex items-center gap-2.5">
                                <input type="radio" class="kt-radio" name="send_type" value="scheduled" id="send_type_scheduled" {{ $newsletter->scheduled_at ? 'checked' : '' }}>
                                <span class="flex flex-col">
                                    <span class="text-sm font-medium text-gray-900">Schedule for Later</span>
                                    <span class="text-xs text-gray-600">Choose when to send</span>
                                </span>
                            </label>
                        </div>
                        <div class="flex flex-col gap-1 {{ $newsletter->scheduled_at ? '' : 'hidden' }}" id="schedule_container">
                            <label class="kt-form-label" for="scheduled_at">Schedule Date & Time</label>
                            <input type="datetime-local" class="kt-input" id="scheduled_at" name="scheduled_at" value="{{ old('scheduled_at', $newsletter->scheduled_at?->format('Y-m-d\TH:i')) }}">
                        </div>
                        <div class="kt-separator"></div>
                        <button type="submit" class="kt-btn kt-btn-primary w-full">
                            <i class="ki-filled ki-send"></i>
                            Update Newsletter
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
// Toggle schedule container
const scheduleRadio = document.getElementById('send_type_scheduled');
const scheduleContainer = document.getElementById('schedule_container');
const scheduledAt = document.getElementById('scheduled_at');

document.querySelectorAll('input[name="send_type"]').forEach(radio => {
    radio.addEventListener('change', function() {
        if (this.value === 'scheduled') {
            scheduleContainer.classList.remove('hidden');
            scheduledAt.required = true;
        } else {
            scheduleContainer.classList.add('hidden');
            scheduledAt.required = false;
        }
    });
});

// TinyMCE Editor - English (LTR)
tinymce.init({
    selector: '.tinymce-editor',
    height: 350,
    menubar: true,
    plugins: ['advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen', 'insertdatetime', 'media', 'table', 'help', 'wordcount'],
    toolbar: 'undo redo | blocks | bold italic forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | link image | code fullscreen',
    content_style: 'body { font-family: Inter, sans-serif; font-size: 14px; }',
    directionality: 'ltr',
    branding: false
});

// TinyMCE Editor - Arabic (RTL)
tinymce.init({
    selector: '.tinymce-editor-rtl',
    height: 350,
    menubar: true,
    plugins: ['advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview', 'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen', 'insertdatetime', 'media', 'table', 'help', 'wordcount'],
    toolbar: 'undo redo | blocks | bold italic forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | link image | code fullscreen',
    content_style: 'body { font-family: Inter, sans-serif; font-size: 14px; direction: rtl; }',
    directionality: 'rtl',
    branding: false
});
</script>
@endpush

