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
                    <h4>Edit Blog</h4>
                </div>
            </div>

            <div class="card-body pt-0 mt-4">
                <form action="{{ route('blog.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <!-- Language Type -->
                    <div class="col-12 mb-3">
                        <label for="type">Language</label>
                        <select id="type" class="form-control" disabled>
                            <option value="english" {{ old('type', $data->type) == 'english' ? 'selected' : '' }}>English
                            </option>
                            <option value="nepali" {{ old('type', $data->type) == 'nepali' ? 'selected' : '' }}>Nepali
                            </option>
                            <option value="japanese" {{ old('type', $data->type) == 'japanese' ? 'selected' : '' }}>Japanese
                            </option>
                        </select>
                        <input type="hidden" name="type" value="{{ old('type', $data->type) }}">
                    </div>


                    <!-- Category -->
                    <div class="col-12 mb-3">
                        <label for="categorySelect">Blog Category</label>
                        <select name="blog_category_id" id="categorySelect" class="form-control">
                            @foreach ($categories as $cate)
                                <option value="{{ $cate->id }}" data-title="{{ $cate->title }}"
                                    data-np_title="{{ $cate->np_title }}" data-jp_title="{{ $cate->jp_title }}"
                                    {{ old('blog_category_id', $data->blog_category_id) == $cate->id ? 'selected' : '' }}>
                                    {{ $cate->title }}
                                </option>
                            @endforeach
                        </select>
                        @error('blog_category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Titles -->
                    <div class="col-12 mb-3 lang-field lang-english">
                        <label>Title (English)</label>
                        <input class="form-control" name="title" value="{{ old('title', $data->title) }}">
                    </div>

                    

                    <div class="col-12 mb-3 lang-field lang-japanese d-none">
                        <label>Title (Japanese)</label>
                        <input class="form-control" name="jp_title" value="{{ old('jp_title', $data->jp_title) }}">
                    </div>

                    <!-- Descriptions -->
                    <div class="col-12 mb-3 lang-field lang-english">
                        <label>Description (English)</label>
                        <textarea class="form-control summernote" name="description">{{ old('description', $data->description) }}</textarea>
                    </div>

                    

                    <div class="col-12 mb-3 lang-field lang-japanese d-none">
                        <label>Description (Japanese)</label>
                        <textarea class="form-control summernote" name="jp_description">{{ old('jp_description', $data->jp_description) }}</textarea>
                    </div>

                    <!-- Image Upload -->
                    <div class="col-12 mb-3">
                        <label for="imageInput">Upload Image</label>
                        <input class="form-control" id="imageInput" type="file" name="image" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Image Preview -->
                    <div class="col-12 mb-3">
                        <img id="imagePreview" src="{{ asset('uploads/images/' . $data->image) }}"
                            style="max-width: 20%; height: auto;" />
                    </div>

                    <!-- Status -->
                    <div class="col-12 mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ old('status', $data->status) == 1 ? 'selected' : '' }}>Active
                            </option>
                            <option value="0" {{ old('status', $data->status) == 0 ? 'selected' : '' }}>Inactive
                            </option>
                        </select>
                    </div>

                    <!-- Submit -->
                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Update</button>
                        <a href="{{ route('blog.index') }}" class="btn btn-light">Cancel</a>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 120,
                placeholder: 'Enter description',
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
                $('#categorySelect option').each(function() {
                    let label = $(this).data('title');
                    if (lang === 'japanese') label = $(this).data('jp_title');
                    $(this).text(label || 'N/A');
                });
            }

            $('#type').on('change', function() {
                let selectedLang = $(this).val();
                updateLangFields(selectedLang);
                updateCategoryLabels(selectedLang);
            });

            $('#type').trigger('change');

            // Preview selected image
            $('#imageInput').on('change', function(e) {
                const file = e.target.files[0];
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#imagePreview').attr('src', e.target.result).show();
                    };
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endpush
