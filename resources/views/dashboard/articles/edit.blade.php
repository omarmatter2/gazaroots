@extends('dashboard.layouts.app')

@section('title', 'Edit Article')

@section('content')
<div class="container-fixed p-5">
    <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
        <div class="flex flex-col justify-center gap-2">
            <h1 class="text-xl font-semibold leading-none text-mono">Edit Article</h1>
            <div class="flex items-center gap-2 text-sm font-medium text-secondary-foreground">
                <a href="{{ route('admin.articles.index') }}" class="kt-link">Articles</a>
                <span>/</span>
                <span>{{ Str::limit($article->getTranslation('title', 'en'), 30) }}</span>
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

    <form action="{{ route('admin.articles.update', $article) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-5 lg:gap-7.5">
            <div class="lg:col-span-2 space-y-5">
                <div class="kt-card">
                    <div class="kt-card-header"><h3 class="kt-card-title">Article Content</h3></div>
                    <div class="kt-card-content grid gap-5">
                        <div class="grid grid-cols-2 gap-5">
                            <div class="flex flex-col gap-1">
                                <label class="kt-form-label" for="title_en">Title (English) <span class="text-danger">*</span></label>
                                <input type="text" class="kt-input" id="title_en" name="title[en]" value="{{ old('title.en', $article->getTranslation('title', 'en')) }}" required>
                            </div>
                            <div class="flex flex-col gap-1">
                                <label class="kt-form-label" for="title_ar">Title (Arabic) <span class="text-danger">*</span></label>
                                <input type="text" class="kt-input" id="title_ar" name="title[ar]" value="{{ old('title.ar', $article->getTranslation('title', 'ar')) }}" dir="rtl" required>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-5">
                            <div class="flex flex-col gap-1">
                                <label class="kt-form-label" for="excerpt_en">Excerpt (English)</label>
                                <textarea class="kt-textarea" id="excerpt_en" name="excerpt[en]" rows="2">{{ old('excerpt.en', $article->getTranslation('excerpt', 'en')) }}</textarea>
                            </div>
                            <div class="flex flex-col gap-1">
                                <label class="kt-form-label" for="excerpt_ar">Excerpt (Arabic)</label>
                                <textarea class="kt-textarea" id="excerpt_ar" name="excerpt[ar]" rows="2" dir="rtl">{{ old('excerpt.ar', $article->getTranslation('excerpt', 'ar')) }}</textarea>
                            </div>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="kt-form-label" for="content_en">Content (English) <span class="text-danger">*</span></label>
                            <textarea class="tinymce-editor" id="content_en" name="content[en]">{{ old('content.en', $article->getTranslation('content', 'en')) }}</textarea>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="kt-form-label" for="content_ar">Content (Arabic) <span class="text-danger">*</span></label>
                            <textarea class="tinymce-editor-rtl" id="content_ar" name="content[ar]">{{ old('content.ar', $article->getTranslation('content', 'ar')) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="space-y-5">
                <div class="kt-card">
                    <div class="kt-card-header"><h3 class="kt-card-title">Settings</h3></div>
                    <div class="kt-card-content grid gap-5">
                        <div class="flex flex-col gap-1">
                            <label class="kt-form-label" for="category_id">Category <span class="text-danger">*</span></label>
                            <select class="kt-select" id="category_id" name="category_id" required>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $article->category_id) == $category->id ? 'selected' : '' }}>{{ $category->getTranslation('name', 'en') }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex flex-col gap-1">
                            <label class="kt-form-label" for="author_id">Author <span class="text-danger">*</span></label>
                            <select class="kt-select" id="author_id" name="author_id" required>
                                @foreach($authors as $author)
                                    <option value="{{ $author->id }}" {{ old('author_id', $article->author_id) == $author->id ? 'selected' : '' }}>{{ $author->getTranslation('name', 'en') }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="kt-form-label">Image</label>
                            <div class="flex items-start gap-3">
                                @if($article->image)
                                <img src="{{ Storage::url($article->image) }}" class="w-16 h-16 object-cover rounded-lg border">
                                @endif
                                <label class="flex flex-col items-center justify-center w-16 h-16 border-2 border-dashed border-border rounded-lg cursor-pointer hover:bg-muted/50 transition-colors">
                                    <div class="flex flex-col items-center justify-center" id="image-placeholder">
                                        <i class="ki-filled ki-picture text-xl text-muted-foreground"></i>
                                    </div>
                                    <img id="image-preview" class="hidden w-full h-full object-cover rounded-lg" alt="Preview">
                                    <input type="file" name="image" accept=".png,.jpg,.jpeg" class="hidden" onchange="previewImage(this)">
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="kt-card">
                    <div class="kt-card-header"><h3 class="kt-card-title">Status</h3></div>
                    <div class="kt-card-content grid gap-4">
                        <div class="flex items-center justify-between">
                            <span class="text-sm">Published</span>
                            <input type="hidden" name="is_published" value="0">
                            <input type="checkbox" class="kt-switch" name="is_published" value="1" {{ old('is_published', $article->is_published) ? 'checked' : '' }}>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm">Featured</span>
                            <input type="hidden" name="is_featured" value="0">
                            <input type="checkbox" class="kt-switch" name="is_featured" value="1" {{ old('is_featured', $article->is_featured) ? 'checked' : '' }}>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-sm">Urgent News</span>
                            <input type="hidden" name="is_urgent" value="0">
                            <input type="checkbox" class="kt-switch" name="is_urgent" value="1" {{ old('is_urgent', $article->is_urgent) ? 'checked' : '' }}>
                        </div>
                    </div>
                </div>
                <div class="flex gap-2.5">
                    <a href="{{ route('admin.articles.index') }}" class="kt-btn kt-btn-outline flex-1">Cancel</a>
                    <button type="submit" class="kt-btn kt-btn-primary flex-1">Update</button>
                </div>
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

// TinyMCE Editor - English (LTR)
tinymce.init({
    selector: '.tinymce-editor',
    height: 400,
    menubar: true,
    plugins: [
        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
        'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
        'insertdatetime', 'media', 'table', 'help', 'wordcount', 'directionality'
    ],
    toolbar: 'undo redo | blocks | bold italic forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | customquote | removeformat | link image | code fullscreen | help',
    content_style: 'body { font-family: Inter, sans-serif; font-size: 14px; } .gr-post__quote { border-left: 4px solid #e5e7eb; padding: 1.5rem; margin: 1.5rem 0; font-style: italic; background: #f9fafb; } .gr-post__quote cite { display: block; margin-top: 1rem; font-size: 0.875rem; color: #6b7280; font-style: normal; }',
    directionality: 'ltr',
    branding: false,
    setup: function(editor) {
        editor.ui.registry.addButton('customquote', {
            text: 'Custom Quote',
            icon: 'quote',
            tooltip: 'Insert custom blockquote',
            onAction: function() {
                editor.windowManager.open({
                    title: 'Insert Custom Blockquote',
                    body: {
                        type: 'panel',
                        items: [
                            {
                                type: 'textarea',
                                name: 'quoteText',
                                label: 'Quote Text',
                                placeholder: 'Enter the quote text...'
                            },
                            {
                                type: 'input',
                                name: 'author',
                                label: 'Author Name',
                                placeholder: 'e.g., Omar Moter'
                            },
                            {
                                type: 'input',
                                name: 'description',
                                label: 'Description',
                                placeholder: 'e.g., A reflection on Gaza\'s enduring resilience...'
                            }
                        ]
                    },
                    buttons: [
                        {
                            type: 'cancel',
                            text: 'Cancel'
                        },
                        {
                            type: 'submit',
                            text: 'Insert',
                            primary: true
                        }
                    ],
                    onSubmit: function(api) {
                        var data = api.getData();
                        var quoteText = data.quoteText || 'Your quote here...';
                        var author = data.author || '';
                        var description = data.description || '';

                        var html = '<blockquote class="gr-post__quote">' + quoteText;

                        if (author || description) {
                            html += '<cite>';
                            if (author) {
                                html += '<span>– ' + author + ', </span>';
                            }
                            if (description) {
                                html += ' ' + description;
                            }
                            html += '</cite>';
                        }

                        html += '</blockquote>';

                        editor.insertContent(html);
                        api.close();
                    }
                });
            }
        });
    }
});

// TinyMCE Editor - Arabic (RTL)
tinymce.init({
    selector: '.tinymce-editor-rtl',
    height: 400,
    menubar: true,
    plugins: [
        'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
        'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
        'insertdatetime', 'media', 'table', 'help', 'wordcount', 'directionality'
    ],
    toolbar: 'undo redo | blocks | bold italic forecolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | customquote | removeformat | link image | code fullscreen | help',
    content_style: 'body { font-family: Inter, sans-serif; font-size: 14px; direction: rtl; } .gr-post__quote { border-right: 4px solid #e5e7eb; padding: 1.5rem; margin: 1.5rem 0; font-style: italic; background: #f9fafb; } .gr-post__quote cite { display: block; margin-top: 1rem; font-size: 0.875rem; color: #6b7280; font-style: normal; }',
    directionality: 'rtl',
    branding: false,
    setup: function(editor) {
        editor.ui.registry.addButton('customquote', {
            text: 'اقتباس مخصص',
            icon: 'quote',
            tooltip: 'إدراج اقتباس مخصص',
            onAction: function() {
                editor.windowManager.open({
                    title: 'إدراج اقتباس مخصص',
                    body: {
                        type: 'panel',
                        items: [
                            {
                                type: 'textarea',
                                name: 'quoteText',
                                label: 'نص الاقتباس',
                                placeholder: 'أدخل نص الاقتباس...'
                            },
                            {
                                type: 'input',
                                name: 'author',
                                label: 'اسم الكاتب',
                                placeholder: 'مثال: عمر مطر'
                            },
                            {
                                type: 'input',
                                name: 'description',
                                label: 'الوصف',
                                placeholder: 'مثال: تأمل في صمود غزة الدائم...'
                            }
                        ]
                    },
                    buttons: [
                        {
                            type: 'cancel',
                            text: 'إلغاء'
                        },
                        {
                            type: 'submit',
                            text: 'إدراج',
                            primary: true
                        }
                    ],
                    onSubmit: function(api) {
                        var data = api.getData();
                        var quoteText = data.quoteText || 'اقتباسك هنا...';
                        var author = data.author || '';
                        var description = data.description || '';

                        var html = '<blockquote class="gr-post__quote">' + quoteText;

                        if (author || description) {
                            html += '<cite>';
                            if (author) {
                                html += '<span>– ' + author + '، </span>';
                            }
                            if (description) {
                                html += ' ' + description;
                            }
                            html += '</cite>';
                        }

                        html += '</blockquote>';

                        editor.insertContent(html);
                        api.close();
                    }
                });
            }
        });
    }
});
</script>
@endpush
