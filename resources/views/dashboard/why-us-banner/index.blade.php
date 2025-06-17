@extends('dashboard.layouts.app')

@push('css')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="col-sm-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4>Why Us Banner</h4>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <form action="{{ route('why-us-banner.update') }}" method="post" enctype="multipart/form-data">
                        @csrf

                        @if (isset($ab))
                            <input type="hidden" name="id" value="{{ $ab->id }}">
                        @endif

                        <!-- Title -->
                        <div class="form-group">
                            <label for="title" class="col-sm-2 control-label">Title <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" name="title" class="form-control" id="title" 
                                    value="{{ isset($ab) ? $ab->title : '' }}">
                                @if ($errors->has('title'))
                                    <span class="text-danger">{{ $errors->first('title') }}</span>
                                @endif
                            </div>
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                            <label for="description" class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-10">
                                <textarea name="description" id="description" class="form-control" rows="4">{{ isset($ab) ? $ab->description : '' }}</textarea>
                                @if ($errors->has('description'))
                                    <span class="text-danger">{{ $errors->first('description') }}</span>
                                @endif
                            </div>
                        </div>

                        <!-- Image Upload -->
                        <div class="form-group">
                            <label for="image" class="col-sm-2 control-label">Image <span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="file" name="image" id="image" class="form-control" accept="image/*">
                                @if ($errors->has('image'))
                                    <span class="text-danger">{{ $errors->first('image') }}</span>
                                @endif

                                <!-- Current Image Preview -->
                                @if (isset($ab->image))
                                    <div style="margin-top: 10px;">
                                        <p>Current Image</p>
                                        <img src="{{ $ab->getImage() }}" id="currentImage" width="150" height="110" style="object-fit: cover;">
                                    </div>
                                @endif

                                <!-- New Selected Image Preview -->
                                <div id="newImagePreviewContainer" style="margin-top: 10px; display: none;">
                                    <p>New Selected Image Preview</p>
                                    <img id="newImagePreview" src="#" width="150" height="110" style="object-fit: cover;" />
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="card-footer text-end">
                            <div class="col-sm-9 offset-sm-3">
                                <button class="btn btn-primary me-3" type="submit">Submit</button>
                            </div>
                        </div>
                    </form>
                </div>
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
            // Summernote Init
            $('#description').summernote({
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

            // Image Preview
            $('#image').on('change', function (e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (event) {
                        $('#newImagePreview').attr('src', event.target.result);
                        $('#newImagePreviewContainer').show();
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endpush
