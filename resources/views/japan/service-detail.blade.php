@extends('japan.layouts.app')

@section('content')

    <!-- Banner Section -->
    <div class="py-6 text-white d-flex align-items-center"
        style="background: url('{{ asset('uploads/images2/' . $category->image2) }}') center center / cover no-repeat;">
        <div class="container text-center">
            <h1 class="font-weight-bold">{{ $category->jp_title }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb justify-content-center mb-0">
                    <li class="breadcrumb-item">
                        <a href="{{ url('/jp/services') }}" class="text-decoration-none">Service</a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">{{ $category->jp_title }}</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Main Container -->
    <div class="container py-6">
        <div class="row">
            <!-- Left: Service Detail -->
            @if ($hasMenu)
                <!-- Centered when has menu -->
                <div class="col-lg-8 offset-lg-2 mb-4 mb-lg-0">
                @else
                    <!-- Default two-column layout -->
                    <div class="col-lg-8 mb-4 mb-lg-0">
            @endif
            <div id="service-detail" class="p-4 bg-white shadow-sm rounded">
                <h2 class="mb-3" id="detail-title">{{ $category->jp_title }}</h2>
                <div id="detail-description">{!! $category->jp_description !!}</div>
            </div>
        </div>


        <!-- Right: Related Services (only if no menu) -->
        @if (!$hasMenu)
            <div class="col-lg-4">
                <div class="bg-white shadow-sm rounded p-4">
                    <h4 class="mb-3 text-uppercase text-primary">Related Services</h4>
                    <ul class="list-group list-group-flush" id="service-list">
                        @foreach ($nonMenuServices as $service)
                            <li class="list-group-item list-hover cursor-pointer" data-title="{{ $service->jp_title }}"
                                data-description="{{ e($service->jp_description) }}">
                                {{ $service->jp_title }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
    </div>
    </div>

    <!-- Food Menu Section (only if price is available) -->
    @if ($hasMenu)
        <div class="container py-6">
            <h2 class="mb-4 font-weight-bold">Our Food Menu</h2>
            <div class="row g-4">
                @foreach ($menuServices as $service)
                    <div class="col-md-4">
                        <div class="card menu-card shadow-sm border-0" data-bs-toggle="modal" data-bs-target="#menuModal"
                            data-image="{{ asset('uploads/images2/' . $service->image2) }}" data-title="{{ $service->jp_title }}"
                            data-description="{{ e($service->jp_description) }}"
                            data-price="{{ number_format($service->price, 2) }}">
                            <img src="{{ asset('uploads/images2/' . $service->image2) }}" class="card-img-top"
                                alt="{{ $service->jp_title }}" style="height: 200px; object-fit: cover;">
                            <div class="card-body d-flex justify-content-between align-items-center">
                                <h5 class="card-title mb-0">{{ $service->jp_title }}</h5>
                                <span class="menu-price text-primary">${{ number_format($service->price, 2) }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

@endsection

<!-- Modal -->
<div class="modal fade" id="menuModal" tabindex="-1" aria-labelledby="menuModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="menuModalLabel">Menu Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <img id="modal-image" src="" alt="" class="img-fluid"
                        style="max-height: 300px; object-fit: cover;">
                    <h5 id="modal-title" class="mt-3"></h5>
                    <p id="modal-description"></p>
                    <p id="modal-price" class="text-primary font-weight-bold"></p>
                </div>
            </div>
        </div>
    </div>
</div>

@push('js')
    <script>
        // Handle menu item click to display the modal
        document.getElementById('service-list')?.addEventListener('click', function(e) {
            const li = e.target.closest("li[data-title]");
            if (li) {
                const title = li.getAttribute('data-title');
                const rawDescription = li.getAttribute('data-description');

                const textarea = document.createElement('textarea');
                textarea.innerHTML = rawDescription;
                const decodedDescription = textarea.value;

                document.getElementById('detail-title').innerText = title;
                document.getElementById('detail-description').innerHTML = decodedDescription;

                document.querySelectorAll('#service-list li').forEach(item => item.classList.remove('active'));
                li.classList.add('active');
            }
        });
        document.querySelectorAll('.menu-card').forEach(item => {
            item.addEventListener('click', function() {
                const image = this.getAttribute('data-image');
                const title = this.getAttribute('data-title');
                const rawDescription = this.getAttribute('data-description');
                const price = this.getAttribute('data-price');

                // Decode the description (HTML entities)
                const description = decodeHTML(rawDescription);

                // Set modal content
                document.getElementById('modal-image').src = image;
                document.getElementById('modal-title').innerText = title;
                document.getElementById('modal-description').innerHTML =
                description; // Use innerHTML for HTML content
                document.getElementById('modal-price').innerText = `$${price}`;
            });
        });

        // Function to decode HTML entities
        function decodeHTML(text) {
            const txt = document.createElement("textarea");
            txt.innerHTML = text;
            return txt.value;
        }
    </script>
@endpush
