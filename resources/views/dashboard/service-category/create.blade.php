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
                    <h4>Add New Service Category</h4>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body pt-0 mt-4">
                <form action="{{ route('service-category.store') }}" method="POST" enctype="multipart/form-data" id="bannerForm">
                    @csrf

                    <!-- Language Selector -->
                    <div class="col-12 mb-3">
                        <label for="typeSelect">Language</label>
                        <select name="type_id" id="typeSelect" class="form-control @error('type_id') is-invalid @enderror">
                            @foreach ($categories as $type)
                                <option value="{{ $type->id }}" data-lang="{{ $type->type }}"
                                    {{ old('type_id', $categories->firstWhere('type', 'english')->id) == $type->id ? 'selected' : '' }}>
                                    {{ ucfirst($type->type) }}
                                </option>
                            @endforeach
                        </select>
                        @error('type_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- English Fields -->
                    <div class="col-12 mb-3 lang-field lang-english">
                        <label for="titleInputEn">Title (EN)</label>
                        <input class="form-control @error('title') is-invalid @enderror" id="titleInputEn" name="title" type="text"
                               placeholder="Title in English" value="{{ old('title') }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 mb-3 lang-field lang-english">
                        <label for="descInputEn">Description (EN)</label>
                        <textarea class="form-control summernote" id="descInputEn" name="description"
                                  placeholder="Enter description in English">{{ old('description') }}</textarea>
                    </div>

                    <!-- Japanese Fields -->
                    <div class="col-12 mb-3 lang-field lang-japanese">
                        <label for="titleInputJp">Title (JP)</label>
                        <input class="form-control @error('jp_title') is-invalid @enderror" id="titleInputJp" name="jp_title" type="text"
                               placeholder="タイトル" value="{{ old('jp_title') }}">
                        @error('jp_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 mb-3 lang-field lang-japanese">
                        <label for="descInputJp">Description (JP)</label>
                        <textarea class="form-control summernote" id="descInputJp" name="jp_description"
                                  placeholder="日本語の説明">{{ old('jp_description') }}</textarea>
                    </div>

                    <!-- Image Uploads -->
                    <div class="col-12 mb-3 lang-field lang-english">
                        <label for="imageInputEn">Upload Image (EN)</label>
                        <input class="form-control @error('image') is-invalid @enderror" id="imageInputEn" name="image"
                               type="file" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <img id="imagePreviewEn" src="#" alt="Preview English" class="mt-2" style="display:none; max-width:200px;">
                    </div>
                    <div class="col-12 mb-3 lang-field lang-japanese">
                        <label for="imageInputJp">アップロード画像 (JP)</label>
                        <input class="form-control @error('image2') is-invalid @enderror" id="imageInputJp" name="image2"
                               type="file" accept="image/*">
                        @error('image2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <img id="imagePreviewJp" src="#" alt="Preview Japanese" class="mt-2" style="display:none; max-width:200px;">
                    </div>

                    <!-- Priority -->
                    <div class="col-12 mb-3">
                        <label for="priorityInput">Priority</label>
                        <input class="form-control @error('priority') is-invalid @enderror" id="priorityInput" name="priority"
                               type="number" value="{{ old('priority') }}">
                        @error('priority')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="col-12 mb-3">
                        <label for="statusSelect">Status</label>
                        <select name="status" id="statusSelect" class="form-control @error('status') is-invalid @enderror">
                            <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status') == '0' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Actions -->
                    <div class="card-footer text-end">
                        <button class="btn btn-primary me-3" type="submit">Submit</button>
                        <a href="{{ route('service-category.index') }}" class="btn btn-light">Cancel</a>
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
        $(document).ready(function() {
            function initEditor() {
                $('.summernote').summernote({
                    height: 120,
                    placeholder: 'Enter description...',
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'underline', 'italic', 'clear']],
                        ['para', ['ul', 'ol', 'paragraph']],
                        ['insert', ['link', 'picture', 'video']],
                        ['view', ['fullscreen', 'codeview', 'help']]
                    ]
                });
            }

            function updateLang(lang) {
                $('.lang-field').addClass('d-none');
                $('.lang-' + lang).removeClass('d-none');
            }

            // Init editors and default language view
            initEditor();
            updateLang($('#typeSelect').find(':selected').data('lang'));

            $('#typeSelect').change(function() {
                updateLang($(this).find(':selected').data('lang'));
            });

            // Image preview helper
            function preview(input, previewEl) {
                var file = input.files[0];
                if (file && file.type.startsWith('image/')) {
                    var reader = new FileReader();
                    reader.onload = e => previewEl.src = e.target.result;
                    reader.onloadend = () => previewEl.style.display = 'block';
                    reader.readAsDataURL(file);
                } else previewEl.style.display = 'none';
            }

            $('#imageInputEn').change(function() { preview(this, document.getElementById('imagePreviewEn')); });
            $('#imageInputJp').change(function() { preview(this, document.getElementById('imagePreviewJp')); });
        });
    </script>
@endpush
