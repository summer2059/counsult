@extends('dashboard.layouts.app')

@push('css')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="col-sm-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4>Consult Banner</h4>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <form action="{{ route('consult-banner.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if (isset($ab))
                            <input type="hidden" name="id" value="{{ $ab->id }}">
                        @endif

                        <div class="row">
                            <!-- Left Column -->
                            <div class="col-md-6">
                                <!-- English Title -->
                                <div class="form-group">
                                    <label for="title">Title <span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control" id="title"
                                        value="{{ old('title', $ab->title ?? '') }}">
                                    @if ($errors->has('title'))
                                        <span class="text-danger">{{ $errors->first('title') }}</span>
                                    @endif
                                </div>

                                <!-- English Description -->
                                <div class="form-group">
                                    <label for="description_en">Description</label>
                                    <textarea name="description" id="description_en" class="form-control" rows="4">{{ old('description', $ab->description ?? '') }}</textarea>
                                    @if ($errors->has('description'))
                                        <span class="text-danger">{{ $errors->first('description') }}</span>
                                    @endif
                                </div>
                            </div>

                            <!-- Right Column -->
                            <div class="col-md-6">
                                <!-- Japanese Title -->
                                <div class="form-group">
                                    <label for="jp_title">Japanese Title</label>
                                    <input type="text" name="jp_title" class="form-control" id="jp_title"
                                        value="{{ old('jp_title', $ab->jp_title ?? '') }}">
                                    @if ($errors->has('jp_title'))
                                        <span class="text-danger">{{ $errors->first('jp_title') }}</span>
                                    @endif
                                </div>

                                <!-- Japanese Description -->
                                <div class="form-group">
                                    <label for="description_jp">Description (JP)</label>
                                    <textarea name="jp_description" id="description_jp" class="form-control" rows="4">{{ old('jp_description', $ab->jp_description ?? '') }}</textarea>
                                    @if ($errors->has('jp_description'))
                                        <span class="text-danger">{{ $errors->first('jp_description') }}</span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <button class="btn btn-primary me-3" type="submit">Submit</button>
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
            $('#description_en, #description_jp').summernote({
                placeholder: 'Enter description here...',
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
