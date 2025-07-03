@extends('dashboard.layouts.app')

@push('css')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="col-sm-12 col-xl-12">
        <div class="card">
            <div class="card-header">
                <h4>Enquiry Banner</h4>
            </div>
            <div class="card-body">
                <div class="row g-3">
                    <form action="{{ route('enquiry-banner.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @if (isset($eb))
                            <input type="hidden" name="id" id="id" value="{{ $eb->id }}">
                        @endif

                        <div class="row">
                            {{-- English Section --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="title_en">Title (English) <span class="text-danger">*</span></label>
                                    <input type="text" name="title" class="form-control" id="title_en"
                                        value="{{ isset($eb) ? $eb->title : '' }}">
                                    @error('title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="description_en">Description (English)</label>
                                    <textarea name="description" id="description_en" class="form-control summernote" rows="4">{{ isset($eb) ? $eb->description : '' }}</textarea>
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="image">Image (English) <span class="text-danger">*</span></label>
                                    <input type="file" name="image" id="image" class="form-control">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    @if (isset($eb->image))
                                        <div style="margin-top: 10px;">
                                            <p>Current Image</p>
                                            <img src="{{ $eb->getImage() }}" width="150" height="110">
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Japanese Section --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="jp_title">タイトル (Japanese) <span class="text-danger">*</span></label>
                                    <input type="text" name="jp_title" class="form-control" id="jp_title"
                                        value="{{ isset($eb) ? $eb->jp_title : '' }}">
                                    @error('jp_title')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="jp_description">説明 (Japanese)</label>
                                    <textarea name="jp_description" id="jp_description" class="form-control summernote" rows="4">{{ isset($eb) ? $eb->jp_description : '' }}</textarea>
                                    @error('jp_description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="image2">画像 (Japanese) <span class="text-danger">*</span></label>
                                    <input type="file" name="image2" id="image2" class="form-control">
                                    @error('image2')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                    @if (isset($eb->image2))
                                        <div style="margin-top: 10px;">
                                            <p>Current Image</p>
                                            <img src="{{ $eb->getImage2() }}" width="150" height="110">
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <button class="btn btn-primary" type="submit">Submit</button>
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
            // Initialize Summernote on all .summernote fields
            $('.summernote').summernote({
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
