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
                    <div class="d-flex align-items-center position-relative my-1">
                        <h4>Edit Offer</h4>
                    </div>
                </div>
            </div>

            <div class="card-body pt-0 mt-4">
                <form action="{{ route('offer.update', $banner->id) }}" method="POST" enctype="multipart/form-data" id="bannerForm">
                    @csrf
                    @method('PATCH')

                    <!-- Language Info -->
                    <div class="col-12 mb-3">
                        <label for="languageSelect">Language</label>
                        <select id="languageSelect" class="form-control" disabled>
                            <option value="{{ $banner->type_id }}">{{ ucfirst($banner->type->type) }}</option>
                        </select>
                        <input type="hidden" name="type" value="{{ $banner->type->type }}">
                        <input type="hidden" name="type_id" value="{{ $banner->type_id }}">
                    </div>

                    <!-- Title - English -->
                    <div class="col-12 mb-3 lang-field lang-english">
                        <label for="titleInput">Title</label>
                        <input class="form-control @error('title') is-invalid @enderror" id="titleInput" type="text"
                            name="title" value="{{ old('title', $banner->title) }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description - English -->
                    <div class="col-12 mb-3 lang-field lang-english">
                        <label for="descriptionInput">Description</label>
                        <textarea name="description" class="form-control summernote" id="summernote">{{ old('description', $banner->description) }}</textarea>
                    </div>

                    <!-- Title - Japanese -->
                    <div class="col-12 mb-3 lang-field lang-japanese">
                        <label for="jp_titleInput">Title (Japanese)</label>
                        <input class="form-control @error('jp_title') is-invalid @enderror" id="jp_titleInput" type="text"
                            name="jp_title" value="{{ old('jp_title', $banner->jp_title) }}">
                        @error('jp_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Description - Japanese -->
                    <div class="col-12 mb-3 lang-field lang-japanese">
                        <label for="jp_descriptionInput">Description (Japanese)</label>
                        <textarea name="jp_description" class="form-control summernote" id="jp_summernote">{{ old('jp_description', $banner->jp_description) }}</textarea>
                    </div>

                    <!-- Image Upload - English -->
                    <div class="col-12 mb-3 lang-field lang-english">
                        <label for="image">Upload Image</label>
                        <input class="form-control @error('image') is-invalid @enderror" id="image" type="file" name="image" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <!-- Current Image Preview -->
                        @if ($banner->image)
                            <div class="mt-2">
                                <p><strong>Current Image:</strong></p>
                                <img src="{{ asset('uploads/images/' . $banner->image) }}" alt="Current Image" style="max-width: 200px;">
                            </div>
                        @endif

                        <!-- New Image Preview -->
                        <div class="mt-2 d-none" id="newImagePreviewContainer">
                            <p><strong>Selected Image Preview:</strong></p>
                            <img id="newImagePreview" src="#" alt="New Image Preview" style="max-width: 200px;">
                        </div>
                    </div>

                    <!-- Image Upload - Japanese -->
                    <div class="col-12 mb-3 lang-field lang-japanese">
                        <label for="image2">アップロード画像</label>
                        <input class="form-control @error('image2') is-invalid @enderror" id="image2" type="file" name="image2" accept="image/*">
                        @error('image2')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        <!-- Current Japanese Image Preview -->
                        @if ($banner->image2)
                            <div class="mt-2">
                                <p><strong>現在の画像:</strong></p>
                                <img src="{{ asset('uploads/images2/' . $banner->image2) }}" alt="Current JP Image" style="max-width: 200px;">
                            </div>
                        @endif

                        <!-- New JP Image Preview -->
                        <div class="mt-2 d-none" id="newImage2PreviewContainer">
                            <p><strong>選択した画像プレビュー:</strong></p>
                            <img id="newImage2Preview" src="#" alt="New JP Image Preview" style="max-width: 200px;">
                        </div>
                    </div>

                    <!-- Status -->
                    <div class="col-12 mb-3">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="1" {{ old('status', $banner->status) == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $banner->status) == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <!-- Submit -->
                    <div class="card-footer text-end">
                        <button class="btn btn-primary me-3" type="submit">Submit</button>
                        <a href="{{ route('offer.index') }}" class="btn btn-light">Cancel</a>
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
            // Summernote init
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

            // Language display
            function updateLangFields(lang) {
                $('.lang-field').addClass('d-none');
                $('.lang-' + lang).removeClass('d-none');
            }

            const currentLang = '{{ $banner->type->type }}';
            updateLangFields(currentLang);

            // Image preview handlers
            $('#image').on('change', function () {
                const reader = new FileReader();
                reader.onload = function (e) {
                    $('#newImagePreview').attr('src', e.target.result);
                    $('#newImagePreviewContainer').removeClass('d-none');
                };
                reader.readAsDataURL(this.files[0]);
            });

            $('#image2').on('change', function () {
                const reader = new FileReader();
                reader.onload = function (e) {
                    $('#newImage2Preview').attr('src', e.target.result);
                    $('#newImage2PreviewContainer').removeClass('d-none');
                };
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>
@endpush
