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
                        <h4>Add New Service Category</h4>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body pt-0 mt-4">
                <form action="{{ route('service-category.store') }}" method="POST" enctype="multipart/form-data" id="bannerForm">
                    @csrf

                    <!-- Title Input -->
                    <div class="col-12 mb-3">
                        <label for="titleInput">Title</label>
                        <input class="form-control @error('title') is-invalid @enderror" id="titleInput" type="text"
                            name="title" value="{{ old('title') }}">

                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

                    <!-- Description with Summernote -->
                    <div class="col-12 mb-3">
                        <div class="form-floating mb-3">
                            <textarea name="description" class="form-control" id="summernote">{{ old('description') }}</textarea>

                        </div>
                    </div>

                    <!-- Conditional Fields -->
                    <div id="conditionalFields">
                        <!-- Upload Image -->
                        <div class="col-12 mb-3">
                            <div class="form-floating mb-3">
                                <input class="form-control @error('image') is-invalid @enderror" id="imageInput"
                                    type="file" name="image" accept="image/*">
                                <label for="imageInput">Upload Image</label>
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Image Preview -->
                        <div class="col-12 mb-3">
                            <img id="imagePreview" src="#" alt="Image Preview"
                                style="display: none; max-width: 50%; height: auto;" />
                        </div>

                    </div>
                    <div class="col-12 mb-3">
                        <label for="priority" class="form-label">Priority</label>
                        <input type="number" class="form-control" name="priority">
                        @error('priority')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="col-12 mb-3">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Submit & Cancel Buttons -->
                    <div class="card-footer text-end">
                        <div class="col-sm-9 offset-sm-3">
                            <button class="btn btn-primary me-3" type="submit">Submit</button>
                            <a href="{{ route('service-category.index') }}" class="btn btn-light">Cancel</a>
                        </div>
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
        $(document).ready(function() {
            // Initialize Summernote
            $('#summernote').summernote({
                placeholder: 'Enter Description',
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

            // Image Preview functionality
            const imageInput = document.getElementById('imageInput');
            const imagePreview = document.getElementById('imagePreview');

            // When user selects an image file
            imageInput.addEventListener('change', function(event) {
                previewFile(event, imagePreview);
            });

            // Preview selected image
            function previewFile(event, previewElement) {
                const file = event.target.files[0];
                if (file && file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        previewElement.src = e.target.result;
                        previewElement.style.display = 'block';
                    };
                    reader.readAsDataURL(file);
                } else {
                    previewElement.src = '#';
                    previewElement.style.display = 'none';
                }
            }
        });
    </script>
@endpush
