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
                    <h4>Edit Career</h4>
                </div>
            </div>

            <div class="card-body pt-0 mt-4">
                <form action="{{ route('career.update', $data->id) }}" method="POST" enctype="multipart/form-data">
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

                    <!-- Description Fields -->
                    <div class="col-12 mb-3 lang-field lang-english">
                        <label>Description (English)</label>
                        <textarea class="form-control summernote" name="description">{{ old('description', $data->description) }}</textarea>
                    </div>

                    <div class="col-12 mb-3 lang-field lang-japanese">
                        <label>Description (Japanese)</label>
                        <textarea class="form-control summernote" name="jp_description">{{ old('jp_description', $data->jp_description) }}</textarea>
                    </div>

                    <!-- Position -->
                    <div class="col-12 mb-3 lang-field lang-english">
                        <label>Position (English)</label>
                        <input class="form-control" name="position" value="{{ old('position', $data->position) }}">
                    </div>

                    <div class="col-12 mb-3 lang-field lang-japanese">
                        <label>Position (Japanese)</label>
                        <input class="form-control" name="jp_position" value="{{ old('jp_position', $data->jp_position) }}">
                    </div>

                    <!-- Location -->
                    <div class="col-12 mb-3 lang-field lang-english">
                        <label>Location (English)</label>
                        <input class="form-control" name="location" value="{{ old('location', $data->location) }}">
                    </div>

                    <div class="col-12 mb-3 lang-field lang-japanese">
                        <label>Location (Japanese)</label>
                        <input class="form-control" name="jp_location" value="{{ old('jp_location', $data->jp_location) }}">
                    </div>

                    <!-- Dates -->
                    <div class="col-12 mb-3 lang-field lang-english">
                        <label>Start Date (English)</label>
                        <input type="date" class="form-control" name="start_date" value="{{ old('start_date', $data->start_date) }}">
                    </div>

                    <div class="col-12 mb-3 lang-field lang-english">
                        <label>End Date (English)</label>
                        <input type="date" class="form-control" name="end_date" value="{{ old('end_date', $data->end_date) }}">
                    </div>

                    <div class="col-12 mb-3 lang-field lang-japanese">
                        <label>Start Date (Japanese)</label>
                        <input type="date" class="form-control" name="jp_start_date" value="{{ old('jp_start_date', $data->jp_start_date) }}">
                    </div>

                    <div class="col-12 mb-3 lang-field lang-japanese">
                        <label>End Date (Japanese)</label>
                        <input type="date" class="form-control" name="jp_end_date" value="{{ old('jp_end_date', $data->jp_end_date) }}">
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
                        <a href="{{ route('career.index') }}" class="btn btn-light">Cancel</a>
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
