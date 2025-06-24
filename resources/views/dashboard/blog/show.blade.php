@extends('dashboard.layouts.app')
@push('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
@endpush
@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Blog Details</h4>
        </div>
        <div class="card-body">
            <dl class="row">

                <dt class="col-sm-3 font-weight-bold">Category</dt>
                <dd class="col-sm-9">
                    @if($blog->type == 'japanese')
                        {{ $blog->blogCategory->jp_title ?? 'N/A' }}
                    @else
                        {{ $blog->blogCategory->title ?? 'N/A' }}
                    @endif
                </dd>

                <dt class="col-sm-3 font-weight-bold">Language</dt>
                <dd class="col-sm-9">{{ ucfirst($blog->type) }}</dd>

                <dt class="col-sm-3 font-weight-bold">Title</dt>
                <dd class="col-sm-9">
                    @if($blog->type == 'japanese')
                        {{ $blog->jp_title }}
                    @else
                        {{ $blog->title }}
                    @endif
                </dd>

                <dt class="col-sm-3 font-weight-bold">Description</dt>
                <dd class="col-sm-9">
                    <div class="border rounded p-3" style="white-space: pre-wrap;">
                        @if($blog->type == 'japanese')
                            {!! $blog->jp_description !!}
                        @else
                            {!! $blog->description !!}
                        @endif
                    </div>
                </dd>

                @if($blog->image)
                <dt class="col-sm-3 font-weight-bold">Image</dt>
                <dd class="col-sm-9">
                    <img src="{{ asset('uploads/images/' . $blog->image) }}" alt="Blog Image" class="img-fluid rounded shadow-sm" style="max-height: 300px;">
                </dd>
                @endif

                <dt class="col-sm-3 font-weight-bold">Status</dt>
                <dd class="col-sm-9">
                    <span class="badge {{ $blog->status ? 'badge-success' : 'badge-danger' }}">
                        {{ $blog->status ? 'Active' : 'Inactive' }}
                    </span>
                </dd>
            </dl>

            <a href="{{ route('blog.index') }}" class="btn btn-outline-primary mt-4">
                <i class="fas fa-arrow-left"></i> Back to List
            </a>
        </div>
    </div>
</div>
@endsection
