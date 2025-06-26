@forelse($blogs as $blog)
    <div class="col-xl-6 col-lg-12 col-md-6">
        <div class="blog-item">
            <div class="position-relative overflow-hidden">
                <img class="img-fluid" src="{{ asset('uploads/images/'.$blog->image) }}" alt="{{ $blog->title }}">
            </div>
            <div class="bg-secondary d-flex">
                <div class="flex-shrink-0 d-flex flex-column justify-content-center text-center bg-primary text-white px-4">
                    <span>{{ \Carbon\Carbon::parse($blog->created_at)->format('d') }}</span>
                    <h5 class="text-uppercase m-0">{{ \Carbon\Carbon::parse($blog->created_at)->format('M') }}</h5>
                    <span>{{ \Carbon\Carbon::parse($blog->created_at)->format('Y') }}</span>
                </div>
                <div class="d-flex flex-column justify-content-center py-3 px-4">
                    <div class="d-flex mb-2">
                        <small class="text-uppercase me-3"><i class="bi bi-person me-2"></i>Admin</small>
                        <small class="text-uppercase me-3"><i class="bi bi-bookmarks me-2"></i>{{ $blog->blogCategory->title ?? 'Uncategorized' }}</small>
                    </div>
                    <a class="h4" href="{{ route('blog.detail', $blog->slug) }}">{{ $blog->title }}</a>
                </div>
            </div>
        </div>
    </div>
@empty
    <div class="col-12">
        <p>No blogs found.</p>
    </div>
@endforelse

@if(!request()->ajax())
    <div class="col-12">
        {{ $blogs->links('pagination::bootstrap-5') }}
    </div>
@endif
