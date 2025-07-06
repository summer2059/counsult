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
                    <h4>Edit Why Us Detail</h4>
                </div>
            </div>

            <div class="card-body pt-0 mt-4">
                <form action="{{ route('whyus-detail.update', $why->id) }}" method="POST" enctype="multipart/form-data" id="bannerForm">
                    @csrf
                    @method('PATCH')

                    <div class="col-12 mb-3">
                        <label for="type_id">Language</label>
                        <select class="form-control" disabled>
                            <option value="{{ $why->type_id }}">{{ ucfirst($why->type->type) }}</option>
                        </select>
                        <input type="hidden" name="type" value="{{ $why->type->type }}">
                        <input type="hidden" name="type_id" value="{{ $why->type_id }}">
                    </div>

                    <!-- English Title -->
                    <div class="col-12 mb-3 lang-field lang-english">
                        <label for="titleInput">Title</label>
                        <input class="form-control @error('title') is-invalid @enderror" id="titleInput" type="text"
                            name="title" placeholder="Title" value="{{ old('title', $why->title) }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Japanese Title -->
                    <div class="col-12 mb-3 lang-field lang-japanese">
                        <label for="jp_title">Title (JP)</label>
                        <input class="form-control @error('jp_title') is-invalid @enderror" id="jp_title" type="text"
                            name="jp_title" value="{{ old('jp_title', $why->jp_title) }}">
                        @error('jp_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- English Description -->
                    <div class="col-12 mb-3 lang-field lang-english">
                        <label for="descriptionInput">Description:</label>
                        <textarea name="description" class="form-control summernote" id="summernote">{{ old('description', $why->description) }}</textarea>
                    </div>

                    <!-- Japanese Description -->
                    <div class="col-12 mb-3 lang-field lang-japanese">
                        <label>Description (Japanese)</label>
                        <textarea class="form-control summernote" name="jp_description">{{ old('jp_description', $why->jp_description) }}</textarea>
                    </div>

                    <!-- English Image Upload -->
                    <div class="col-12 mb-3 lang-field lang-english">
                        <label for="image">Upload Icon (English)</label>
                        <input class="form-control @error('image') is-invalid @enderror" id="image" type="file" name="image" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <!-- Current Image -->
                        @if ($why->image)
                            <div class="mt-2">
                                <p>Current Image:</p>
                                <img src="{{ asset('uploads/images/' . $why->image) }}" alt="Current Image" style="max-width: 200px;">
                            </div>
                        @endif

                        <!-- New Preview -->
                        <div id="newImagePreviewContainer" class="mt-2" style="display: none;">
                            <p>New Preview:</p>
                            <img id="newImagePreview" src="#" alt="New Preview" style="max-width: 200px;">
                        </div>
                    </div>

                    <!-- Japanese Image Upload -->
                    <div class="col-12 mb-3 lang-field lang-japanese">
                        <label for="image2">アップロード画像 (Japanese)</label>
                        <input class="form-control @error('image2') is-invalid @enderror" id="image2" type="file" name="image2" accept="image/*">
                        @error('image2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <!-- Current Image -->
                        @if ($why->image2)
                            <div class="mt-2">
                                <p>Current Image:</p>
                                <img src="{{ asset('uploads/images2/' . $why->image2) }}" alt="Current Image JP" style="max-width: 200px;">
                            </div>
                        @endif

                        <!-- New Preview -->
                        <div id="newImage2PreviewContainer" class="mt-2" style="display: none;">
                            <p>New Preview:</p>
                            <img id="newImage2Preview" src="#" alt="New Preview JP" style="max-width: 200px;">
                        </div>
                    </div>

                    <!-- Priority -->
                    <div class="col-12 mb-3">
                        <label for="priority">Priority</label>
                        <input type="number" class="form-control" name="priority" required value="{{ old('priority', $why->priority) }}">
                        @error('priority')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="col-12 mb-3">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="1" {{ old('status', $why->status) == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $why->status) == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <!-- Buttons -->
                    <div class="card-footer text-end">
                        <div class="col-sm-9 offset-sm-3">
                            <button class="btn btn-primary me-3" type="submit">Submit</button>
                            <a href="{{ route('whyus-detail.index') }}" class="btn btn-light">Cancel</a>
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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script>
        $(document).ready(function() {
            // Show/hide language fields
            function updateLangFields(lang) {
                $('.lang-field').addClass('d-none');
                $('.lang-' + lang).removeClass('d-none');
            }

            // Initialize Summernote
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

            // Initial field display
            let currentLang = '{{ $why->type->type }}';
            updateLangFields(currentLang);

            // Image preview for English
            $('#image').on('change', function() {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $('#newImagePreview').attr('src', event.target.result);
                    $('#newImagePreviewContainer').show();
                };
                if (this.files[0]) {
                    reader.readAsDataURL(this.files[0]);
                }
            });

            // Image preview for Japanese
            $('#image2').on('change', function() {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $('#newImage2Preview').attr('src', event.target.result);
                    $('#newImage2PreviewContainer').show();
                };
                if (this.files[0]) {
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    </script>
@endpush
