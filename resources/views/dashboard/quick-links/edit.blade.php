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
                    @method('PUT') <!-- Make sure to use PUT for update -->

                    <!-- Title Input -->
                    <div class="col-12 mb-3">
                        <label for="titleInput">Title</label>
                            <input class="form-control @error('title') is-invalid @enderror" id="titleInput" type="text"
                                name="title" value="{{ old('title', $finance->title) }}">
                            
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        
                    </div>
                    
                    <div class="col-12 mb-3">
                        <label for="titleInput">Link</label>
                            <input class="form-control @error('url') is-invalid @enderror" id="titleInput" type="text"
                                name="url" placeholder="Link" value="{{ old('url', $finance->url) }}">
                            
                            @error('url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        
                    </div>

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
                            <option value="1" {{ old('status', $finance->status) == 1 ? 'selected' : '' }}>Active
                            </option>
                            <option value="0" {{ old('status', $finance->status) == 0 ? 'selected' : '' }}>Inactive
                            </option>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>
@endpush

