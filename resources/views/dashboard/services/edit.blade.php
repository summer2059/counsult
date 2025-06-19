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
                        <h4>Edit Service</h4>
                    </div>
                </div>
            </div>
            <!--end::Card header-->

            <!--begin::Card body-->
            <div class="card-body pt-0 mt-4">
                <form action="{{ route('services.update', $data->id) }}" method="POST" enctype="multipart/form-data"
                    id="bannerForm">
                    @csrf
                    @method('PATCH')

                    <div class="col-12 col-3">
                        <div class="form-floating mb-3">
                           <select name="service_category_id" id="categorySelect" class="form-select" required>
                            @foreach ($categories as $cate)
                                <option value="{{$cate->id}}" @if($cate->id == $data->service_category_id) selected @endif>{{ $cate->title }}</option>
                            @endforeach
                           </select>

                        </div>
                    </div>

                    <!-- Title Input -->
                    <div class="col-12 mb-3">
                        <label for="titleInput">Title</label>
                        <input class="form-control @error('title') is-invalid @enderror" id="titleInput" type="text"
                            name="title" placeholder="Title" value="{{ old('title', $data->title) }}">

                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror

                    </div>

                    <!-- Description -->
                    <div class="col-12 mb-3">
                    <label for="descriptionInput">Description:</label>
                            <textarea name="description" class="form-control" id="summernote">{{ old('description', $data->description) }}</textarea>
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
                        <img id="imagePreview" src="{{ asset('uploads/images/' . $data->image) }}" alt=""
                            style="max-width: 20%; height: auto;" />
                    </div>

                    
                    <div class="col-12 mb-3" id="priceContainer">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" name="price" required
                            value="{{ old('price', $data->price) }}">
                        @error('price')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                     <div class="col-12 mb-3">
                        <label for="priority" class="form-label">Priority</label>
                        <input type="number" class="form-control" name="priority" required
                            value="{{ old('priority', $data->priority) }}">
                        @error('priority')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12 mb-3">
                        <select name="status" id="status" class="form-select" required>
                            <option value="1" {{ old('status', $data->status) == 1 ? 'selected' : '' }}>Active
                            </option>
                            <option value="0" {{ old('status', $data->status) == 0 ? 'selected' : '' }}>Inactive
                            </option>
                        </select>
                    </div>
                    <!-- Submit & Cancel Buttons -->
                    <div class="card-footer text-end">
                        <div class="col-sm-9 offset-sm-3">
                            <button class="btn btn-primary me-3" type="submit">Submit</button>
                            <a href="{{ route('banner.index') }}" class="btn btn-light">Cancel</a>
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
    // Initialize Summernote
    $('#summernote').summernote({
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

    const categorySelect = $('#categorySelect');
    const priceContainer = $('#priceContainer');

    // Define category names that should show the price field
    const categoriesToShowPrice = ['Restaurant', 'Halal Food'];

    function togglePriceField() {
        const selectedText = categorySelect.find('option:selected').text().trim();
        if (categoriesToShowPrice.includes(selectedText)) {
            priceContainer.show();
        } else {
            priceContainer.hide();
        }
    }

    // Initial check
    togglePriceField();

    // Change event
    categorySelect.on('change', togglePriceField);
});

    </script>
@endpush
