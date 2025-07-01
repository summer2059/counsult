@extends('frontend.layouts.app')

@section('content')

<!-- Banner Section -->
<div class="py-6 text-white d-flex align-items-center"
     style="background: url('{{ asset('uploads/images/' . $category->image) }}') center center / cover no-repeat;">
    <div class="container text-center">
        <h1 class="font-weight-bold">{{ $category->title }}</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb justify-content-center mb-0">
                <li class="breadcrumb-item">
                    <a href="{{ url('/services') }}" class="text-decoration-none">Service</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">{{ $category->title }}</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Main Container -->
<div class="container py-6">
    <div class="row">
        <!-- Left: Service Detail -->
        <div class="col-lg-8 mb-4 mb-lg-0">
            <div id="service-detail" class="p-4 bg-white shadow-sm rounded">
                <h2 class="mb-3" id="detail-title">{{ $category->title }}</h2>
                <div id="detail-description">{!! $category->description !!}</div>
            </div>
        </div>

        <!-- Right: Related Services -->
        <div class="col-lg-4">
            <div class="bg-white shadow-sm rounded p-4">
                <h4 class="mb-3 text-uppercase text-primary">Related Services</h4>
                <ul class="list-group list-group-flush" id="service-list">
                    @foreach ($relatedServices as $service)
                        <li class="list-group-item list-hover cursor-pointer"
                            data-title="{{ $service->title }}"
                            data-description="{{ e($service->description) }}">
                            {{ $service->title }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>

<!-- Conditional Food Menu Section -->
@if($hasMenu)
<div class="container py-6">
    <h2 class="mb-4 font-weight-bold">Our Food Menu</h2>
    <div class="row g-4">
        @foreach($relatedServices->whereNotNull('price') as $service)
            <div class="col-md-4">
                <div class="card menu-card shadow-sm border-0">
                    <img src="{{ asset('uploads/services/' . $service->image) }}" class="card-img-top"
                         alt="{{ $service->title }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">{{ $service->title }}</h5>
                        <span class="menu-price text-primary">${{ number_format($service->price, 2) }}</span>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endif

@endsection

@push('js')
<script>
    document.getElementById('service-list').addEventListener('click', function (e) {
        const li = e.target.closest("li[data-title]");
        if (li) {
            const title = li.getAttribute('data-title');
            const rawDescription = li.getAttribute('data-description');

            // Decode the HTML-encoded string
            const textarea = document.createElement('textarea');
            textarea.innerHTML = rawDescription;
            const decodedDescription = textarea.value; 

            // Update the main section
            document.getElementById('detail-title').innerText = title;
            document.getElementById('detail-description').innerHTML = decodedDescription;

            // Highlight active item
            document.querySelectorAll('#service-list li').forEach(item => item.classList.remove('active'));
            li.classList.add('active');
        }
    });
</script>
@endpush
