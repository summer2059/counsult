@extends('dashboard.layouts.app')
@push('css')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
@endpush
@section('content')
    <div class="col-sm-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4>Vision Banner</h4>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <form action="{{ route('vision-banner.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if (isset($tb))
                            <input type="text" name="id" id="id" value="{{ $tb->id }}" hidden>
                        @endif
                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <!-- English Title -->
                                <div class="form-group">
                                    <label for="title">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control" id="title"
                                        value="{{ isset($tb) ? $tb->title : '' }}">
                                    @if ($errors->has('title'))
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>

                                <!-- English Image -->
                                <div class="form-group">
                                    <label for="image">Image <span class="text-danger">*</span></label>
                                    <input type="file" name="image" id="image" class="form-control">
                                    @if ($errors->has('image'))
                                        <span class="text-danger">{{ $errors->first('image') }}</span>
                                    @endif
                                    @if (isset($tb->image))
                                        <div class="mt-2">
                                            <p>Current Image</p>
                                            <img src="{{ $tb->getImage() }}" width="150" height="110">
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="col-md-6">
                                <!-- Japanese Title -->
                                <div class="form-group">
                                    <label for="jp_title">Japanese Title</label>
                                    <input type="text" name="jp_title" class="form-control" id="jp_title"
                                        value="{{ isset($tb) ? $tb->jp_title : '' }}">
                                    @if ($errors->has('jp_title'))
                                        <span class="text-danger">{{ $errors->first('jp_title') }}</span>
                                    @endif
                                </div>

                                <!-- Japanese Image -->
                                <div class="form-group">
                                    <label for="image2">Japanese Image </label>
                                    <input type="file" name="image2" id="image2" class="form-control">
                                    @if ($errors->has('image2'))
                                        <span class="text-danger">{{ $errors->first('image2') }}</span>
                                    @endif
                                    @if (isset($tb->image2))
                                        <div class="mt-2">
                                            <p>Current Image 2</p>
                                            <img src="{{ $tb->getImage2() }}" width="150" height="110">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

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
        $(document).ready(function() {
            // Initialize Summernote
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


        });
    </script>
@endpush
