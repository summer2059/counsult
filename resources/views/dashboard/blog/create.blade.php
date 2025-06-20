@extends('dashboard.layouts.app')

@push('css')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
@endpush

@section('content')
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card">
            <div class="card-header border-1 pt-6">
                <div class="card-title">
                    <h4>Add New Blog</h4>
                </div>
            </div>

            <div class="card-body pt-0 mt-4">
                <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data" id="blogForm">
                    @csrf

                    <!-- Language Type -->
                    <div class="col-12 mb-3">
                        <label for="type">Language</label>
                        <select name="type" id="type" class="form-control">
                            <option value="english" {{ old('type') === 'english' ? 'selected' : '' }}>English</option>
                            <option value="nepali" {{ old('type') === 'nepali' ? 'selected' : '' }}>Nepali</option>
                            <option value="japanese" {{ old('type') === 'japanese' ? 'selected' : '' }}>Japanese</option>
                        </select>
                        @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Blog Category -->
                    <div class="col-12 mb-3">
                        <label for="categorySelect">Blog Category</label>
                        <select name="blog_category_id" id="categorySelect" class="form-control">
                            @foreach ($categories as $cate)
                                <option value="{{ $cate->id }}"
                                    data-title="{{ $cate->title }}"
                                    data-np_title="{{ $cate->np_title }}"
                                    data-jp_title="{{ $cate->jp_title }}"
                                    {{ old('blog_category_id') == $cate->id ? 'selected' : '' }}>
                                    {{ $cate->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('blog_category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Title Fields -->
                    <div class="col-12 mb-3 lang-field lang-english">
                        <label for="title">Title (English)</label>
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                    </div>

                    <div class="col-12 mb-3 lang-field lang-nepali d-none">
                        <label for="np_title">Title (Nepali)</label>
                        <input type="text" class="form-control" name="np_title" value="{{ old('np_title') }}">
                    </div>

                    <div class="col-12 mb-3 lang-field lang-japanese d-none">
                        <label for="jp_title">Title (Japanese)</label>
                        <input type="text" class="form-control" name="jp_title" value="{{ old('jp_title') }}">
                    </div>

                    <!-- Description Fields -->
                    <div class="col-12 mb-3 lang-field lang-english">
                        <label for="description">Description (English)</label>
                        <textarea name="description" class="form-control summernote">{{ old('description') }}</textarea>
                    </div>

                    <div class="col-12 mb-3 lang-field lang-nepali d-none">
                        <label for="np_description">Description (Nepali)</label>
                        <textarea name="np_description" class="form-control summernote">{{ old('np_description') }}</textarea>
                    </div>

                    <div class="col-12 mb-3 lang-field lang-japanese d-none">
                        <label for="jp_description">Description (Japanese)</label>
                        <textarea name="jp_description" class="form-control summernote">{{ old('jp_description') }}</textarea>
                    </div>

                    <!-- Image -->
                    <div class="col-12 mb-3">
                        <label for="imageInput">Image</label>
                        <input class="form-control @error('image') is-invalid @enderror" id="imageInput" type="file" name="image" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <img id="imagePreview" src="#" alt="Image Preview" style="display: none; max-width: 50%; height: auto;" />
                    </div>

                    <!-- Status -->
                    <div class="col-12 mb-3">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <!-- Buttons -->
                    <div class="card-footer text-end">
                        <button class="btn btn-primary me-3" type="submit">Submit</button>
                        <a href="{{ route('blog.index') }}" class="btn btn-light">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <!-- JS Libraries -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>

    <script>
        $(document).ready(function () {
            $('.summernote').summernote({
                placeholder: 'Enter description...',
                tabsize: 2,
                height: 120,
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });

            function updateLangFields(lang) {
                $('.lang-field').addClass('d-none');
                $('.lang-' + lang).removeClass('d-none');
            }

            function updateCategoryLabels(lang) {
                $('#categorySelect option').each(function () {
                    let defaultTitle = $(this).data('title');
                    let npTitle = $(this).data('np_title');
                    let jpTitle = $(this).data('jp_title');
                    let label = defaultTitle;

                    if (lang === 'nepali' && npTitle) label = npTitle;
                    else if (lang === 'japanese' && jpTitle) label = jpTitle;

                    $(this).text(label);
                });
            }

            $('#type').on('change', function () {
                let selectedLang = $(this).val();
                updateLangFields(selectedLang);
                updateCategoryLabels(selectedLang);
            });

            // Initialize on page load
            $('#type').trigger('change');

            // Image preview
            $('#imageInput').on('change', function (e) {
                const file = e.target.files[0];
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        $('#imagePreview').attr('src', e.target.result).show();
                    };
                    reader.readAsDataURL(file);
                } else {
                    $('#imagePreview').hide();
                }
            });
        });
    </script>
@endpush
