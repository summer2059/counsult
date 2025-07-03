@extends('dashboard.layouts.app')

@push('css')
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
@endpush

@section('content')
    <div class="app-container container-xxl">
        <div class="card">
            <div class="card-header pt-6">
                <h4>Edit Service</h4>
            </div>
            <div class="card-body pt-0 mt-4">
                <form id="serviceForm" method="POST" action="{{ route('services.update', $data->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="type_id" id="typeInput" value="{{ $data->type_id }}">
                    @php
                        $selectedType = $data->type_id;
                        $selectedLang = $selectedType == 2 ? 'japanese' : 'english';
                    @endphp

                    <!-- Language (disabled) -->
                    <div class="mb-4">
                        <label class="form-label">Selected Language</label>
                        <select id="languageSelect" class="form-select" disabled>
                            <option value="1" {{ $selectedType == 1 ? 'selected' : '' }}>English</option>
                            <option value="2" {{ $selectedType == 2 ? 'selected' : '' }}>Japanese</option>
                        </select>
                    </div>

                    <!-- Category Dropdown -->
                    <!-- Category Dropdown -->
                    <div class="mb-3">
                        <label for="categorySelect" class="form-label">Service Category</label>
                        <select id="categorySelect" name="service_category_id" class="form-select" required>
                            <option value="">-- Select Category --</option>
                            @foreach ($categories as $cate)
                                @php
                                    // Show only language-specific label
                                    $label = $data->type_id == 2 ? $cate->jp_title ?? '' : $cate->title ?? '';
                                @endphp
                                @if (!empty($label))
                                    <option value="{{ $cate->id }}"
                                        {{ $data->service_category_id == $cate->id ? 'selected' : '' }}>
                                        {{ $label }}
                                    </option>
                                @endif
                            @endforeach
                        </select>
                    </div>


                    <!-- Language-Based Input Fields -->
                    <div id="fieldsContainer">
                        <!-- English -->
                        <div class="lang-fields lang-english" style="{{ $selectedType == 1 ? '' : 'display:none;' }}">
                            <div class="mb-3">
                                <label for="titleEn" class="form-label">Title</label>
                                <input type="text" class="form-control" id="titleEn" name="title"
                                    value="{{ old('title', $data->title) }}">
                            </div>
                            <div class="mb-3">
                                <label for="descEn" class="form-label">Description</label>
                                <textarea class="form-control" id="descEn" name="description">{{ old('description', $data->description) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="imageEn" class="form-label">Upload Image</label>
                                <input type="file" class="form-control" id="imageEn" name="image" accept="image/*">
                                @if ($data->image)
                                    <img id="previewEn" src="{{ asset('uploads/images/' . $data->image) }}" class="mt-2"
                                        style="max-width:200px">
                                @else
                                    <img id="previewEn" src="#" class="mt-2" style="display:none; max-width:200px">
                                @endif
                            </div>
                        </div>

                        <!-- Japanese -->
                        <div class="lang-fields lang-japanese" style="{{ $selectedType == 2 ? '' : 'display:none;' }}">
                            <div class="mb-3">
                                <label for="titleJp" class="form-label">Japanese Title</label>
                                <input type="text" class="form-control" id="titleJp" name="jp_title"
                                    value="{{ old('jp_title', $data->jp_title) }}">
                            </div>
                            <div class="mb-3">
                                <label for="descJp" class="form-label">Japanese Description</label>
                                <textarea class="form-control" id="descJp" name="jp_description">{{ old('jp_description', $data->jp_description) }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="imageJp" class="form-label">Upload Japanese Image</label>
                                <input type="file" class="form-control" id="imageJp" name="image2" accept="image/*">
                                @if ($data->image2)
                                    <img id="previewJp" src="{{ asset('uploads/images2/' . $data->image2) }}"
                                        class="mt-2" style="max-width:200px">
                                @else
                                    <img id="previewJp" src="#" class="mt-2" style="display:none; max-width:200px">
                                @endif
                            </div>
                        </div>
                    </div>

                    <!-- Shared Fields -->
                    <div class="mb-3" id="priceContainer">
                        <label for="price" class="form-label">Price</label>
                        <input type="number" class="form-control" id="price" name="price"
                            value="{{ old('price', $data->price) }}">
                    </div>
                    <div class="mb-3">
                        <label for="priority" class="form-label">Priority</label>
                        <input type="number" class="form-control" id="priority" name="priority"
                            value="{{ old('priority', $data->priority) }}">
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select name="status" id="status" class="form-select">
                            <option value="1" {{ $data->status ? 'selected' : '' }}>Active</option>
                            <option value="0" {{ !$data->status ? 'selected' : '' }}>Inactive</option>
                        </select>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="{{ route('services.index') }}" class="btn btn-light">Cancel</a>
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
        $(function() {
            $('#descEn, #descJp').summernote({
                height: 120
            });

            const priceCategories = ['Restaurant', 'Halal Food', 'レストラン', 'ハラール 食品'];

            function togglePrice() {
                const selectedText = $('#categorySelect option:selected').text().trim();
                $('#priceContainer').toggle(priceCategories.includes(selectedText));
            }

            $('#categorySelect').on('change', togglePrice);
            togglePrice(); // call once on load

            function preview(input, selector) {
                if (input.files && input.files[0]) {
                    const reader = new FileReader();
                    reader.onload = e => $(selector).attr('src', e.target.result).show();
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $('#imageEn').on('change', function() {
                preview(this, '#previewEn');
            });
            $('#imageJp').on('change', function() {
                preview(this, '#previewJp');
            });
        });
    </script>
@endpush
