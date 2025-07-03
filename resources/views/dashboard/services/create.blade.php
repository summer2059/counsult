@extends('dashboard.layouts.app')

@push('css')
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="app-container container-xxl">
  <div class="card">
    <div class="card-header pt-6">
      <h4>Add New Service</h4>
    </div>
    <div class="card-body pt-0 mt-4">
      <!-- Language Dropdown -->
      <div class="mb-4">
        <label for="languageSelect" class="form-label">Select Language</label>
        <select id="languageSelect" class="form-select">
          <option value="1" selected>English</option>
          <option value="2">Japanese</option>
        </select>
      </div>

      <form id="serviceForm" method="POST" action="{{ route('services.store') }}" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="type_id" id="typeInput" value="1">

        <!-- Category Dropdown -->
        <div class="mb-3">
          <label for="categorySelect" class="form-label">Service Category</label>
          <select id="categorySelect" name="service_category_id" class="form-select" required>
            <option value="">-- Select Category --</option>
            @foreach ($categories as $cate)
              <option value="{{ $cate->id }}">{{ $cate->title }}</option>
            @endforeach
          </select>
        </div>

        <!-- Language-Based Input Fields -->
        <div id="fieldsContainer">
          <!-- English -->
          <div class="lang-fields lang-english">
            <div class="mb-3">
              <label for="titleEn" class="form-label">Title</label>
              <input type="text" class="form-control" id="titleEn" name="title" value="{{ old('title') }}">
            </div>
            <div class="mb-3">
              <label for="descEn" class="form-label">Description</label>
              <textarea class="form-control" id="descEn" name="description">{{ old('description') }}</textarea>
            </div>
            <div class="mb-3">
              <label for="imageEn" class="form-label">Upload Image</label>
              <input type="file" class="form-control" id="imageEn" name="image" accept="image/*">
              <img id="previewEn" src="#" alt="" class="mt-2" style="display:none; max-width:200px">
            </div>
          </div>

          <!-- Japanese -->
          <div class="lang-fields lang-japanese" style="display:none;">
            <div class="mb-3">
              <label for="titleJp" class="form-label">Japanese Title</label>
              <input type="text" class="form-control" id="titleJp" name="jp_title" value="{{ old('jp_title') }}">
            </div>
            <div class="mb-3">
              <label for="descJp" class="form-label">Japanese Description</label>
              <textarea class="form-control" id="descJp" name="jp_description">{{ old('jp_description') }}</textarea>
            </div>
            <div class="mb-3">
              <label for="imageJp" class="form-label">Upload Japanese Image</label>
              <input type="file" class="form-control" id="imageJp" name="image2" accept="image/*">
              <img id="previewJp" src="#" alt="" class="mt-2" style="display:none; max-width:200px">
            </div>
          </div>
        </div>

        <!-- Shared Fields -->
        <div class="mb-3" id="priceContainer">
          <label for="price" class="form-label">Price</label>
          <input type="number" class="form-control" id="price" name="price" value="{{ old('price') }}">
        </div>
        <div class="mb-3">
          <label for="priority" class="form-label">Priority</label>
          <input type="number" class="form-control" id="priority" name="priority" value="{{ old('priority') }}">
        </div>
        <div class="mb-3">
          <label for="status" class="form-label">Status</label>
          <select name="status" id="status" class="form-select">
            <option value="1" selected>Active</option>
            <option value="0">Inactive</option>
          </select>
        </div>

        <div class="text-end">
          <button type="submit" class="btn btn-primary">Submit</button>
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
  // Initialize Summernote editors
  $('#descEn, #descJp').summernote({ height: 120 });

  // Language switch logic
  $('#languageSelect').on('change', function() {
  const typeId = $(this).val(); // now it's "1" or "2"
  $('#typeInput').val(typeId);

  // map type ID to language string for category filter
  const lang = typeId === '2' ? 'japanese' : 'english';

  $('.lang-fields').hide();
  $('.lang-' + lang).show();

  $.ajax({
    url: '{{ route("services.getByLanguage") }}',
    data: { language: lang },
    success: function(categories) {
      let html = '<option value="">-- Select Category --</option>';
      categories.forEach(c => {
        html += `<option value="${c.id}">${c.title}</option>`;
      });
      $('#categorySelect').html(html);
      togglePrice();
    }
  });
}).trigger('change');


  // Price toggler based on category name
  const priceCategories = ['Restaurant', 'Halal Food', 'レストラン', 'ハラール 食品'];
  function togglePrice() {
    const sel = $('#categorySelect option:selected').text().trim();
    $('#priceContainer').toggle(priceCategories.includes(sel));
  }
  $('#categorySelect').on('change', togglePrice);

  // Image preview handlers
  function preview(input, selector) {
    if (input.files && input.files[0]) {
      const reader = new FileReader();
      reader.onload = e => $(selector).attr('src', e.target.result).show();
      reader.readAsDataURL(input.files[0]);
    }
  }
  $('#imageEn').on('change', function() { preview(this, '#previewEn'); });
  $('#imageJp').on('change', function() { preview(this, '#previewJp'); });
});
</script>
@endpush
