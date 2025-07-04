@extends('dashboard.layouts.app')

@push('css')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
@endpush

@section('content')
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card">
            <!-- Card Header -->
            <div class="card-header border-1 pt-6">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1">
                        <h4>Edit Quick Link</h4>
                    </div>
                </div>
            </div>
            <!-- Card Body -->
            <div class="card-body pt-0 mt-4">
                <form action="{{ route('quick-links.update', $finance->id) }}" method="POST"
                    enctype="multipart/form-data" id="bannerForm">
                    @csrf
                    @method('PATCH') <!-- Make sure to use PUT for update -->

                    <div class="col-12 mb-3">
                        <label for="type_id">Language</label>
                        <select class="form-control" disabled>
                            <option value="{{ $finance->type_id }}">{{ ucfirst($finance->type->type) }}</option>
                        </select>
                        <input type="hidden" name="type" value="{{ $finance->type->type }}">
                        <input type="hidden" name="type_id" value="{{ $finance->type_id }}">
                    </div>

                    <!-- Title and URL Inputs (English) -->
                    <div class="col-12 mb-3 lang-field lang-english">
                        <label for="titleInput">Title (English)</label>
                        <input class="form-control @error('title') is-invalid @enderror" id="titleInput" type="text"
                            name="title" value="{{ old('title', $finance->title) }}">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 mb-3 lang-field lang-english">
                        <label for="urlInput">Link (English)</label>
                        <input class="form-control @error('url') is-invalid @enderror" id="urlInput" type="url"
                            name="url" value="{{ old('url', $finance->url) }}" placeholder="https://example.com">
                        @error('url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Title and URL Inputs (Japanese) -->
                    <div class="col-12 mb-3 lang-field lang-japanese d-none">
                        <label for="jp_titleInput">タイトル (Japanese)</label>
                        <input class="form-control @error('jp_title') is-invalid @enderror" id="jp_titleInput" type="text"
                            name="jp_title" value="{{ old('jp_title', $finance->jp_title) }}">
                        @error('jp_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 mb-3 lang-field lang-japanese d-none">
                        <label for="jp_urlInput">リンク (Japanese)</label>
                        <input class="form-control @error('jp_url') is-invalid @enderror" id="jp_urlInput" type="url"
                            name="jp_url" value="{{ old('jp_url', $finance->jp_url) }}" placeholder="https://example.com">
                        @error('jp_url')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Priority Input -->
                    <div class="col-12 mb-3">
                        <label for="priority" class="form-label">Priority</label>
                        <input type="number" class="form-control" name="priority" required
                            value="{{ old('priority', $finance->priority) }}">
                        @error('priority')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <select name="status" id="status" class="form-select" required>
                            <option value="1" {{ old('status', $finance->status) == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $finance->status) == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <!-- Submit & Cancel Buttons -->
                    <div class="card-footer text-end">
                        <div class="col-sm-9 offset-sm-3">
                            <button class="btn btn-primary me-3" type="submit">Update</button>
                            <a href="{{ route('quick-links.index') }}" class="btn btn-light">Cancel</a>
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
    <script>
        $(document).ready(function () {
            function updateLangFields(lang) {
                // Hide all language fields
                $('.lang-field').addClass('d-none');

                // Show the fields for the selected language
                $('.lang-' + lang).removeClass('d-none');
            }

            // When the language is changed, update the displayed fields
            $('#typeSelect').on('change', function () {
                const selectedLang = $(this).find(':selected').data('lang');
                updateLangFields(selectedLang);
            });

            // Trigger change event on load to display the default language fields
            $('#typeSelect').trigger('change');
        });
    </script>
@endpush
