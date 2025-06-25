@extends('dashboard.layouts.app')
@push('css')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
    
@endpush

@section('content')
    <div id="kt_app_content_container" class="app-container container-xxl">
        <div class="card">
            <!--begin::Card header-->
            <div class="card-header border-1 pt-6">
                <div class="card-title">
                    <div class="d-flex align-items-center position-relative my-1">
                        <h4>Edit Team</h4>
                    </div>
                </div>
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body pt-0 mt-4">
                <form action="{{ route('team.update', $team->id) }}" method="POST"
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

                    <!-- Title Input -->
                    <div class="col-12 mb-3 lang-field lang-english">
                         <label for="titleInput">Full Name</label>
                            <input class="form-control @error('name') is-invalid @enderror" id="titleInput" type="text"
                                name="name" value="{{ old('name', $team->name) }}">
                           
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                       
                    </div>
                    <div class="col-12 mb-3 lang-field lang-japanese">
                        <label for="jp_titleInput">フルネーム</label>
                        <input class="form-control @error('jp_name') is-invalid @enderror" id="jp_titleInput" type="text"
                            name="jp_name" value="{{ old('jp_name', $team->jp_name) }}">
                        @error('jp_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3 lang-field lang-english">
                        <label for="titleInput">Position</label>
                            <input class="form-control @error('position') is-invalid @enderror" id="titleInput"
                                type="text" name="position" placeholder="Position"
                                value="{{ old('position', $team->position) }}">
                            
                            @error('position')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        
                    </div>
                    <div class="col-12 mb-3 lang-field lang-japanese">
                        <label for="jp_positionInput">役職</label>
                        <input class="form-control @error('jp_position') is-invalid @enderror" id="jp_positionInput"
                            type="text" name="jp_position" placeholder="役職"
                            value="{{ old('jp_position', $team->jp_position) }}">
                        @error('jp_position')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Conditional Fields -->

                    <!-- Image Upload -->
                    <div class="col-12 mb-3">
                        <div class="form-floating mb-3">
                            <input class="form-control @error('image') is-invalid @enderror" id="imageInput" type="file"
                                name="image" accept="image/*">
                            <label for="imageInput">Upload Image</label>
                            @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Image Preview -->
                    <div class="col-12 mb-3">
                        <img id="imagePreview" src="{{ asset('uploads/images/' . $team->image) }}" alt=""
                            style="max-width: 20%; height: auto;" />
                    </div>
                    <div class="col-12 mb-3">
                        <label for="priority" class="form-label">Priority</label>
                        <input type="number" class="form-control" name="priority" required
                            value="{{ old('priority', $team->priority) }}">
                        @error('priority')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <select name="status" id="status" class="form-select" required>
                            <option value="1" {{ old('status', $team->status) == 1 ? 'selected' : '' }}>Active
                            </option>
                            <option value="0" {{ old('status', $team->status) == 0 ? 'selected' : '' }}>
                                Inactive</option>
                        </select>
                    </div>
                    <!-- Submit & Cancel Buttons -->
                    <div class="card-footer text-end">
                        <div class="col-sm-9 offset-sm-3">
                            <button class="btn btn-primary me-3" type="submit">Submit</button>
                            <a href="{{ route('team.index') }}" class="btn btn-light">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
            <!--end::Card body-->
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

            // Auto trigger language field toggle based on stored type
            let currentLang = '{{ $team->type->type }}';
            updateLangFields(currentLang);
        });
    
    </script>
@endpush

