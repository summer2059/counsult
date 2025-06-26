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
                    <h4>Edit Mission</h4>
                </div>
            </div>

            <div class="card-body pt-0 mt-4">
                <form action="{{ route('mission.update', $data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PATCH')

                    <!-- Language (read-only) -->
                    <div class="col-12 mb-3">
                        <label for="type_id">Language</label>
                        <select class="form-control" disabled>
                            <option value="{{ $data->type_id }}">{{ ucfirst($data->type->type) }}</option>
                        </select>
                        <input type="hidden" name="type" value="{{ $data->type->type }}">
                        <input type="hidden" name="type_id" value="{{ $data->type_id }}">
                    </div>

                    <!-- Title Fields -->
                    <div class="col-12 mb-3 lang-field lang-english">
                        <label>Title (English)</label>
                        <input class="form-control" name="title" value="{{ old('title', $data->title) }}">
                    </div>

                    <div class="col-12 mb-3 lang-field lang-japanese">
                        <label>Title (Japanese)</label>
                        <input class="form-control" name="jp_title" value="{{ old('jp_title', $data->jp_title) }}">
                    </div>

                    <!-- Status -->
                    <div class="col-12 mb-3">
                        <label>Status</label>
                        <select name="status" class="form-control">
                            <option value="1" {{ old('status', $data->status) == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $data->status) == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <!-- Submit -->
                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Update</button>
                        <a href="{{ route('mission.index') }}" class="btn btn-light">Cancel</a>
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
        $(document).ready(function () {
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

            function updateLangFields(lang) {
                $('.lang-field').addClass('d-none');
                $('.lang-' + lang).removeClass('d-none');
            }

            // Auto trigger language field toggle based on stored type
            let currentLang = '{{ $data->type->type }}';
            updateLangFields(currentLang);
        });
    
    </script>
@endpush
