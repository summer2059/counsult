@extends('dashboard.layouts.app')

@push('css')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
@endpush

@section('content')
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card">
            <!-- Card Header -->
            <div class="card-header border-1 pt-6">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1">
                        <h4>Add New Consult Detail</h4>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body pt-0 mt-4">
                <form action="{{ route('consult-detail.store') }}" method="POST" enctype="multipart/form-data" id="bannerForm">
                    @csrf

                    <div class="col-12 mb-3">
                        <label for="typeSelect">Language</label>
                        <select name="type_id" id="typeSelect" class="form-control">
                            @foreach ($categories as $type)
                                <option value="{{ $type->id }}" data-lang="{{ $type->type }}"
                                    {{ old('type_id', $type->type === 'english' ? $type->id : '') == $type->id ? 'selected' : '' }}>
                                    {{ ucfirst($type->type) }}
                                </option>
                            @endforeach
                        </select>
                        @error('type_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- English Title -->
                    <div class="col-12 mb-3 lang-field lang-english">
                        <label for="titleInputEn">Title</label>
                        <input class="form-control @error('title') is-invalid @enderror" id="titleInputEn" type="text"
                               name="title" value="{{ old('title') }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- English Description -->
                    <div class="col-12 mb-3 lang-field lang-english">
                        <div class="form-floating mb-3">
                            <textarea name="description" class="form-control summernote" id="summernoteEn" placeholder="Enter description...">{{ old('description') }}</textarea>
                        </div>
                    </div>

                    <!-- Japanese Title -->
                    <div class="col-12 mb-3 lang-field lang-japanese">
                        <label for="titleInputJp">Title (JP)</label>
                        <input class="form-control @error('jp_title') is-invalid @enderror" id="titleInputJp" type="text"
                               name="jp_title" value="{{ old('jp_title') }}">
                        @error('jp_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Japanese Description -->
                    <div class="col-12 mb-3 lang-field lang-japanese">
                        <div class="form-floating mb-3">
                            <textarea name="jp_description" class="form-control summernote" id="summernoteJp" placeholder="日本語の説明を入力してください...">{{ old('jp_description') }}</textarea>
                        </div>
                    </div>

                    <!-- Image Upload (English) -->
                    <div class="col-12 mb-3 lang-field lang-english">
                        <div class="form-floating mb-3">
                            <input class="form-control @error('image') is-invalid @enderror" id="imageInput"
                                   type="file" name="image" accept="image/*">
                            <label for="imageInput">Upload Image</label>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Image Upload (Japanese) -->
                    <div class="col-12 mb-3 lang-field lang-japanese">
                        <div class="form-floating mb-3">
                            <input class="form-control @error('image2') is-invalid @enderror" id="image2Input"
                                   type="file" name="image2" accept="image/*">
                            <label for="image2Input">Upload Japanese Image</label>
                            @error('image2')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Image Preview -->
                    <div class="col-12 mb-3 lang-field lang-english">
                        <img id="imagePreview" src="#" alt="Image Preview"
                             style="display: none; max-width: 50%; height: auto;" />
                    </div>

                    <div class="col-12 mb-3 lang-field lang-japanese">
                        <img id="image2Preview" src="#" alt="Japanese Image Preview"
                             style="display: none; max-width: 50%; height: auto;" />
                    </div>

                    <!-- Status -->
                    <div class="col-12 mb-3">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1" {{ old('status') == '1' ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit -->
                    <div class="card-footer text-end">
                        <div class="col-sm-9 offset-sm-3">
                            <button class="btn btn-primary me-3" type="submit">Submit</button>
                            <a href="{{ route('consult-detail.index') }}" class="btn btn-light">Cancel</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>

    <script>
        $(document).ready(function () {

            function initSummernote(selector) {
                $(selector).summernote({
                    placeholder: 'Enter description...',
                    tabsize: 2,
                    height: 120,
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'underline', 'italic', 'clear']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['fullscreen', 'codeview', 'help']]
                    ]
                });
            }

            function destroySummernote() {
                $('.summernote').each(function () {
                    if ($(this).next().hasClass('note-editor')) {
                        $(this).summernote('destroy');
                    }
                });
            }

            function updateLangFields(lang) {
                $('.lang-field').addClass('d-none');
                destroySummernote();
                $('.lang-' + lang).removeClass('d-none');

                // Re-init Summernote only for the visible fields
                $('.lang-' + lang + ' .summernote').each(function () {
                    initSummernote(this);
                });
            }

            $('#typeSelect').on('change', function () {
                const selectedLang = $(this).find(':selected').data('lang');
                updateLangFields(selectedLang);
            });

            $('#typeSelect').trigger('change'); // Initialize

            function previewFile(event, previewElement) {
                const file = event.target.files[0];
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        previewElement.src = e.target.result;
                        previewElement.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    previewElement.src = '#';
                    previewElement.style.display = 'none';
                }
            }

            const imageInput = document.getElementById('imageInput');
            const image2Input = document.getElementById('image2Input');

            if (imageInput) {
                imageInput.addEventListener('change', function (e) {
                    previewFile(e, document.getElementById('imagePreview'));
                });
            }

            if (image2Input) {
                image2Input.addEventListener('change', function (e) {
                    previewFile(e, document.getElementById('image2Preview'));
                });
            }
        });
    </script>
@endpush
