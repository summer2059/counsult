@extends('dashboard.layouts.app')

@push('css')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
@endpush

@section('content')
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card">
            <!--begin::Card header-->
            <div class="card-header border-1 pt-6">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1">
                        <h4>Edit offer</h4>
                    </div>
                </div>
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body pt-0 mt-4">
                <form action="{{ route('offer.update', $banner->id) }}" method="POST" enctype="multipart/form-data" id="bannerForm">
                    @csrf
                    @method('PATCH')

                    <div class="col-12 mb-3">
                        <label for="type_id">Language</label>
                        <select id="languageSelect" class="form-control" disabled>
                            <option value="{{ $banner->type_id }}">{{ ucfirst($banner->type->type) }}</option>
                        </select>
                        <input type="hidden" name="type" value="{{ $banner->type->type }}">
                        <input type="hidden" name="type_id" value="{{ $banner->type_id }}">
                    </div>

                    <!-- Language Switcher -->
                    <div class="col-12 mb-3">
                        <label for="languageSelect">Select Language</label>
                        <select id="languageSelect" class="form-control">
                            <option value="english" {{ $banner->type->type == 'english' ? 'selected' : '' }}>English</option>
                            <option value="japanese" {{ $banner->type->type == 'japanese' ? 'selected' : '' }}>Japanese</option>
                        </select>
                    </div>

                    <!-- Title Input - English -->
                    <div class="col-12 mb-3 lang-field lang-english">
                        <label for="titleInput">Title</label>
                        <input class="form-control @error('title') is-invalid @enderror" id="titleInput" type="text"
                               name="title" placeholder="Title" value="{{ old('title', $banner->title) }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description - English -->
                    <div class="col-12 mb-3 lang-field lang-english">
                        <label for="descriptionInput">Description:</label>
                        <textarea name="description" class="form-control summernote" id="summernote">{{ old('description', $banner->description) }}</textarea>
                    </div>

                    <!-- Title Input - Japanese -->
                    <div class="col-12 mb-3 lang-field lang-japanese">
                        <label for="jp_titleInput">Title (Japanese)</label>
                        <input class="form-control @error('jp_title') is-invalid @enderror" id="jp_titleInput" type="text"
                               name="jp_title" placeholder="Title (Japanese)" value="{{ old('jp_title', $banner->jp_title) }}">
                        @error('jp_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description - Japanese -->
                    <div class="col-12 mb-3 lang-field lang-japanese">
                        <label for="jp_descriptionInput">Description (Japanese):</label>
                        <textarea name="jp_description" class="form-control summernote" id="jp_summernote">{{ old('jp_description', $banner->jp_description) }}</textarea>
                    </div>

                    <!-- Image Upload - English -->
                    <div class="col-12 mb-3 lang-field lang-english">
                        <label for="image">Upload Image</label>
                        <input class="form-control @error('image') is-invalid @enderror" id="image" type="file"
                               name="image" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        @if ($banner->image)
                            <div class="mt-2">
                                <img id="imagePreview" src="{{ asset('uploads/images/' . $banner->image) }} "
                                     alt="Preview" style="max-width: 200px;">
                            </div>
                        @endif
                    </div>

                    <!-- Image Upload - Japanese -->
                    <div class="col-12 mb-3 lang-field lang-japanese">
                        <label for="image2">アップロード画像</label>
                        <input class="form-control @error('image2') is-invalid @enderror" id="image2" type="file"
                               name="image2" accept="image/*">
                        @error('image2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        @if ($banner->image2)
                            <div class="mt-2">
                                <img id="image2Preview" src="{{ asset('uploads/images2/' . $banner->image2) }}"
                                     alt="Preview" style="max-width: 200px;">
                            </div>
                        @endif
                    </div>

                    <!-- Status -->
                    <div class="col-12 mb-3">
                        <select name="status" id="status" class="form-select" required>
                            <option value="1" {{ old('status', $banner->status) == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $banner->status) == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <!-- Submit & Cancel Buttons -->
                    <div class="card-footer text-end">
                        <div class="col-sm-9 offset-sm-3">
                            <button class="btn btn-primary me-3" type="submit">Submit</button>
                            <a href="{{ route('offer.index') }}" class="btn btn-light">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
            <!--end::Card body-->
        </div>
    </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <script>
        $(document).ready(function () {

            // Function to update the language fields visibility
            function updateLangFields(lang) {
                // Hide all language fields
                $('.lang-field').addClass('d-none');
                
                // Show the fields for the selected language
                $('.lang-' + lang).removeClass('d-none');
            }

            // Initialize Summernote for both languages
            $('.summernote').summernote({
                height: 120, // Set the height of the editor
                placeholder: 'Enter description',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });

            // Get the current language type from the server-side variable
            let currentLang = '{{ $banner->type->type }}';
            
            // Update language fields based on the stored type
            updateLangFields(currentLang);

            // Listen for language change and update fields accordingly
            $('#languageSelect').on('change', function() {
                let selectedLang = $(this).val();
                updateLangFields(selectedLang);
            });

            // Handle image upload preview
            $('#image').on('change', function (e) {
                let reader = new FileReader();
                reader.onload = function (event) {
                    $('#newImagePreview').attr('src', event.target.result).show();
                    $('#newImagePreviewContainer').show();
                };
                reader.readAsDataURL(this.files[0]);
            });

            $('#image2').on('change', function (e) {
                let reader = new FileReader();
                reader.onload = function (event) {
                    $('#newImage2Preview').attr('src', event.target.result).show();
                    $('#newImage2PreviewContainer').show();
                };
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
@endpush
