@extends('dashboard.layouts.app')

@push('css')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
@endpush

@section('content')
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card">
            <!-- Card Header -->
            <div class="card-header border-1 pt-6">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1">
                        <h4>Edit Team</h4>
                    </div>
                </div>
            </div>

            <!-- Card Body -->
            <div class="card-body pt-0 mt-4">
                <form action="{{ route('message.update', $team->id) }}" method="POST"
                      enctype="multipart/form-data" id="bannerForm">
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

                    <!-- English Full Name -->
                    <div class="col-12 mb-3 lang-field lang-english">
                        <label for="name">Full Name</label>
                        <input class="form-control @error('name') is-invalid @enderror" id="name" type="text"
                               name="name" value="{{ old('name', $team->name) }}">
                        @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Japanese Full Name -->
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
                        <input class="form-control @error('jp_position') is-invalid @enderror" id="jp_position"
                               type="text" name="jp_position" value="{{ old('jp_position', $team->jp_position) }}">
                        @error('jp_position')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- English Message -->
                    <div class="col-12 mb-3 lang-field lang-english">
                        <label>Message (English)</label>
                        <textarea class="form-control summernote" name="message">{{ old('message', $team->message) }}</textarea>
                    </div>

                    <!-- Japanese Message -->
                    <div class="col-12 mb-3 lang-field lang-japanese">
                        <label>Message (Japanese)</label>
                        <textarea class="form-control summernote" name="jp_message">{{ old('jp_message', $team->jp_message) }}</textarea>
                    </div>

                    <!-- English Image Upload -->
                    <div class="col-12 mb-3 lang-field lang-english">
                        <label for="image">Upload Image</label>
                        <input class="form-control @error('image') is-invalid @enderror" id="image" type="file"
                               name="image" accept="image/*">
                        @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        @if ($team->image)
                            <div class="mt-2">
                                <img id="imagePreview" src="{{ asset('uploads/images/' . $team->image) }} "
                                     alt="Preview" style="max-width: 200px;">
                            </div>
                        @endif
                    </div>

                    <!-- Japanese Image2 Upload -->
                    <div class="col-12 mb-3 lang-field lang-japanese">
                        <label for="image2">アップロード画像</label>
                        <input class="form-control @error('image2') is-invalid @enderror" id="image2" type="file"
                               name="image2" accept="image/*">
                        @error('image2')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                        @if ($team->image2)
                            <div class="mt-2">
                                <img id="image2Preview" src="{{ asset('uploads/images2/' . $team->image2) }}"
                                     alt="Preview" style="max-width: 200px;">
                            </div>
                        @endif
                    </div>

                    <!-- Priority -->
                    <div class="col-12 mb-3">
                        <label for="priority">Priority</label>
                        <input type="number" class="form-control @error('priority') is-invalid @enderror"
                               name="priority" value="{{ old('priority', $team->priority) }}">
                        @error('priority')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="col-12 mb-3">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="1" {{ old('status', $team->status) == 1 ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ old('status', $team->status) == 0 ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Buttons -->
                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-primary me-3">Update</button>
                        <a href="{{ route('team.index') }}" class="btn btn-light">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>

    <script>
        $(document).ready(function () {

            // Function to update the language fields visibility
            function updateLangFields(lang) {
                // Hide all language fields
                $('.lang-field').addClass('d-none');
                
                // Show the fields for the selected language
                $('.lang-' + lang).removeClass('d-none');
            }

            // Initialize Summernote
            $('.summernote').summernote({
                height: 120, // Set the height of the editor
                placeholder: 'Enter description',
                toolbar: [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['insert', ['link', 'picture']],
                    ['view', ['fullscreen', 'codeview']]
                ]
            });

            // Get the current language type from the server-side variable
            let currentLang = '{{ $team->type->type }}';
            
            // Update language fields based on the stored type
            updateLangFields(currentLang);
        });
    </script>
@endpush

