@extends('japan.layouts.app')

@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-dark p-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 text-white">Blog Grid</h1>
                <a href="{{ route('jp.index') }}">Home</a>
                <i class="far fa-square text-primary px-2"></i>
                <a>Blog</a>
            </div>
        </div>
    </div>
    <!-- Page Header End -->

    <!-- Blog Start -->
    <div class="container-fluid py-6 px-5">
        <div class="row g-5">
            <!-- Blog list Start -->
            <div class="col-lg-8">
                <div class="row g-5" id="blog-container">
                    @include('japan.partials.blog-list', ['blogs' => $blogs])
                </div>
            </div>
            <!-- Blog list End -->

            <!-- Sidebar Start -->
            <div class="col-lg-4">
                <!-- Search Form Start -->
                <div class="mb-5">
                    <div class="input-group">
                        <input type="text" id="search-input" class="form-control p-3"
                            placeholder="Search blog by title...">
                        <button class="btn btn-primary px-4" type="button"><i class="bi bi-search"></i></button>
                    </div>
                </div>
                <!-- Search Form End -->

                <!-- Category Start -->
                <div class="mb-5">
                    <h2 class="mb-4">Categories</h2>
                    <div class="d-flex flex-column justify-content-start bg-secondary p-4">
                        <a href="{{ route('jp.blog') }}" class="h5 mb-3 {{ request('category') ? '' : 'text-primary' }}">
                            <i class="bi bi-arrow-right text-primary me-2"></i>All
                        </a>
                        @foreach ($categories as $cat)
                            <a href="{{ route('jp.blog', ['category' => $cat->jp_slug]) }}"
                                class="h5 mb-3 {{ request('category') == $cat->jp_slug ? 'text-primary' : '' }}">
                                <i class="bi bi-arrow-right text-primary me-2"></i>{{ $cat->jp_title }}
                            </a>
                        @endforeach
                    </div>
                </div>
                <!-- Category End -->
            </div>
            <!-- Sidebar End -->
        </div>
    </div>
    <!-- Blog End -->
@endsection

@push('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        console.log('test');
        $(document).ready(function() {
            $('#search-input').on('keyup', function() {
                let keyword = $(this).val();
                let category = '{{ request('category') ?? '' }}'; // This is now the slug

                $.ajax({
                    url: "{{ route('jp.search.blog') }}",
                    type: "GET",
                    data: {
                        keyword: keyword,
                        category: category
                    },
                    success: function(response) {
                        $('#blog-container').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX error:", error);
                    }
                });
            });
        });
    </script>
@endpush
