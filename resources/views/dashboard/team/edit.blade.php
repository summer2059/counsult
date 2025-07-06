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
                    <div class="d-flex align-items-center position-relative my-1">
                        <h4>Edit Team</h4>
                    </div>
                </div>
            </div>

            <div class="card-body pt-0 mt-4">
                <form action="{{ route('team.update', $team->id) }}" method="POST" enctype="multipart/form-data" id="teamForm">
                    @csrf
                    @method('PATCH')

                    <div class="col-12 mb-3">
                        <label for="type_id">Language</label>
                        <select class="form-control" disabled>
                            <option value="{{ $team->type_id }}">{{ ucfirst($team->type->type) }}</option>
                        </select>
                        <input type="hidden" name="type" value="{{ $team->type->type }}">
                        <input type="hidden" name="type_id" value="{{ $team->type_id }}">
                    </div>

                    <!-- English Name -->
                    <div class="col-12 mb-3 lang-field lang-english">
                        <label for="name">Full Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" id="name" type="text"
                            name="name" value="{{ old('name', $team->name) }}">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Japanese Name -->
                    <div class="col-12 mb-3 lang-field lang-japanese">
                        <label for="jp_name">フルネーム</label>
                        <input class="form-control @error('jp_name') is-invalid @enderror" id="jp_name" type="text"
                            name="jp_name" value="{{ old('jp_name', $team->jp_name) }}">
                        @error('jp_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- English Position -->
                    <div class="col-12 mb-3 lang-field lang-english">
                        <label for="position">Position</label>
                        <input class="form-control @error('position') is-invalid @enderror" id="position" type="text"
                            name="position" value="{{ old('position', $team->position) }}">
                        @error('position')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Japanese Position -->
                    <div class="col-12 mb-3 lang-field lang-japanese">
                        <label for="jp_position">役職</label>
                        <input class="form-control @error('jp_position') is-invalid @enderror" id="jp_position" type="text"
                            name="jp_position" value="{{ old('jp_position', $team->jp_position) }}">
                        @error('jp_position')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Image Upload -->
                    <div class="col-12 mb-3">
                        <label for="image">Upload Image</label>
                        <input class="form-control @error('image') is-invalid @enderror" id="imageInput" type="file"
                            name="image" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Image Preview -->
                    <div class="col-12 mb-3">
                        <label>Image Preview</label><br>
                        <img id="imagePreview"
                            src="{{ $team->image ? asset('uploads/images/' . $team->image) : 'https://via.placeholder.com/150' }}"
                            alt="Preview" style="max-width: 200px; height: auto;">
                    </div>

                    <!-- Priority -->
                    <div class="col-12 mb-3">
                        <label for="priority" class="form-label">Priority</label>
                        <input type="number" class="form-control" name="priority" required
                            value="{{ old('priority', $team->priority) }}">
                        @error('priority')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="col-12 mb-3">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-select" required>
                            <option value="1" {{ old('status', $team->status) == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $team->status) == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <!-- Buttons -->
                    <div class="card-footer text-end">
                        <div class="col-sm-9 offset-sm-3">
                            <button class="btn btn-primary me-3" type="submit">Submit</button>
                            <a href="{{ route('team.index') }}" class="btn btn-light">Cancel</a>
                        </div>
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
            function updateLangFields(lang) {
                $('.lang-field').addClass('d-none');
                $('.lang-' + lang).removeClass('d-none');
            }

            // Detect language and toggle inputs
            let currentLang = '{{ $team->type->type }}';
            updateLangFields(currentLang);

            // Live preview of image before upload
            $('#imageInput').on('change', function (e) {
                const file = e.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        $('#imagePreview').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(file);
                }
            });
        });
    </script>
@endpush
