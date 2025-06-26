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
                <form action="{{ route('why-us-banner.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @if (isset($ab))
                        <input type="hidden" name="id" value="{{ $ab->id }}">
                    @endif

                    <div class="row">
                        <!-- Left Column -->
                        <div class="col-md-6">
                            <!-- Title -->
                            <div class="form-group">
                                <label for="title">Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control" id="title"
                                    value="{{ isset($ab) ? $ab->title : '' }}">
                                @error('title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea name="description" id="description" class="form-control">{{ isset($ab) ? $ab->description : '' }}</textarea>
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Image Upload -->
                            <div class="form-group">
                                <label for="image">Image <span class="text-danger">*</span></label>
                                <input type="file" name="image" id="image" class="form-control" accept="image/*">
                                @error('image')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                @if (isset($ab->image))
                                    <div class="mt-2">
                                        <p>Current Image</p>
                                        <img src="{{ $ab->getImage() }}" id="currentImage" width="150" height="110" style="object-fit: cover;">
                                    </div>
                                @endif

                                <div id="newImagePreviewContainer" style="display: none;" class="mt-2">
                                    <p>New Selected Image Preview</p>
                                    <img id="newImagePreview" src="#" width="150" height="110" style="object-fit: cover;" />
                                </div>
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="col-md-6">
                            <!-- Japanese Title -->
                            <div class="form-group">
                                <label for="jp_title">Japanese Title</label>
                                <input type="text" name="jp_title" class="form-control" id="jp_title"
                                    value="{{ isset($ab) ? $ab->jp_title : '' }}">
                                @error('jp_title')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Japanese Description -->
                            <div class="form-group">
                                <label for="jp_description">Japanese Description</label>
                                <textarea name="jp_description" id="jp_description" class="form-control">{{ isset($ab) ? $ab->jp_description : '' }}</textarea>
                                @error('jp_description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <!-- Japanese Image -->
                            <div class="form-group">
                                <label for="image2">Japanese Image</label>
                                <input type="file" name="image2" id="image2" class="form-control" accept="image/*">
                                @error('image2')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                @if (isset($ab->image2))
                                    <div class="mt-2">
                                        <p>Current Image 2</p>
                                        <img src="{{ $ab->getImage2() }}" width="150" height="110" style="object-fit: cover;">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Submit</button>
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
            // Summernote Init for English Description
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

            // Summernote Init for Japanese Description
            $('#jp_description').summernote({
                placeholder: '日本語の説明を入力してください',
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

            // Image Preview for English image
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
