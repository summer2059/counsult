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
                    <h4>Add New Mission</h4>
                </div>
            </div>

            <div class="card-body pt-0 mt-4">
                <form action="{{ route('mission.store') }}" method="POST" enctype="multipart/form-data" id="missionForm">
                    @csrf

                    <!-- Language Type -->
                    <div class="col-12 mb-3">
                        <label for="type_id">Language</label>
                        <select name="type_id" id="typeSelect" class="form-control">
                            @foreach($categories as $type)
                                <option value="{{ $type->id }}"
                                    data-lang="{{ $type->type }}"
                                    {{ old('type_id') == $type->id ? 'selected' : ($type->type === 'english' ? 'selected' : '') }}>
                                    {{ ucfirst($type->type) }}
                                </option>
                            @endforeach
                        </select>
                        @error('type_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Title Fields -->
                    <div class="col-12 mb-3 lang-field lang-english">
                        <label for="title">Title (English)</label>
                        <input type="text" class="form-control" name="title" value="{{ old('title') }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3 lang-field lang-japanese d-none">
                        <label for="jp_title">Title (Japanese)</label>
                        <input type="text" class="form-control" name="jp_title" value="{{ old('jp_title') }}">
                        @error('jp_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="col-12 mb-3">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1" {{ old('status') == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status') == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="card-footer text-end">
                        <button class="btn btn-primary me-3" type="submit">Submit</button>
                        <a href="{{ route('mission.index') }}" class="btn btn-light">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>

    <script>
        $(document).ready(function () {
            // Initialize Summernote
            $('.summernote').summernote({
                placeholder: 'Enter description...',
                tabsize: 2,
                height: 120,
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

            $('#typeSelect').on('change', function () {
                let selectedLang = $(this).find(':selected').data('lang');
                updateLangFields(selectedLang);
            });

            // Trigger default view
            $('#typeSelect').trigger('change');
        });
    </script>
@endpush
