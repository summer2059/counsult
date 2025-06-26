@extends('japan.layouts.app')

@section('content')
<!-- Page Header -->
<div class="container-fluid bg-dark p-5">
    <div class="row">
        <div class="col-12 text-center">
            <h1 class="display-4 text-white">{{ $blog->jp_title }}</h1>
            <a href="{{ route('jp.index') }}">Home</a>
            <i class="far fa-square text-primary px-2"></i>
            <a href="{{ route('jp.blog.detail', $blog->jp_slug) }}">Blog Detail</a>
        </div>
    </div>
</div>

<!-- Blog Detail -->
<div class="container-fluid py-6 px-5">
    <div class="row g-5">
        <div class="col-lg-8">
            <div class="mb-5">
                <img class="img-fluid w-100 mb-5" src="{{ asset('uploads/images/' . $blog->image) }}" alt="{{ $blog->jp_title }}">
                <h1 class="mb-4">{{ $blog->jp_title }}</h1>
                <p>{!! $blog->jp_description !!}</p>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Search -->
            <div class="mb-5">
                <div class="input-group">
                    <input type="text" class="form-control p-3" id="searchInput" placeholder="Keyword">
                    <button class="btn btn-primary px-4"><i class="bi bi-search"></i></button>
                </div>
                <div id="searchResults" class="mt-2"></div>
            </div>

            <!-- Categories -->
            <div class="mb-5">
                <h2 class="mb-4">Categories</h2>
                <div class="d-flex flex-column justify-content-start bg-secondary p-4">
                    @foreach($categories as $category)
                        <a class="h5 mb-3" href="{{ route('jp.blog', ['category' => $category->jp_slug]) }}">
                            <i class="bi bi-arrow-right text-primary me-2"></i>{{ $category->jp_title }}
                        </a>
                    @endforeach
                </div>
            </div>

            <!-- Recent Posts -->
            <div class="mb-5">
                <h2 class="mb-4">Recent Posts</h2>
                @foreach($recentBlogs as $item)
                    <div class="d-flex mb-3">
                        <img class="img-fluid" src="{{ asset('uploads/images/' . $item->image) }}"
                             style="width: 100px; height: 100px; object-fit: cover;" alt="{{ $item->jp_title }}">
                        <a href="{{ route('jp.blog.detail', $item->jp_slug) }}"
                           class="h5 d-flex align-items-center bg-secondary px-3 mb-0">{{ $item->jp_title }}</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
<script>
    document.getElementById('searchInput').addEventListener('keyup', function () {
        let query = this.value;
        if (query.length > 2) {
            fetch(`/jp/search-blog-json?q=${query}`)
                .then(response => response.json())
                .then(data => {
                    let results = '<ul class="list-group">';
                    data.forEach(item => {
                        results += `<li class="list-group-item"><a href="/jp/blog/${item.jp_slug}">${item.jp_title}</a></li>`;
                    });
                    results += '</ul>';
                    document.getElementById('searchResults').innerHTML = results;
                });
        } else {
            document.getElementById('searchResults').innerHTML = '';
        }
    });
</script>
@endpush
