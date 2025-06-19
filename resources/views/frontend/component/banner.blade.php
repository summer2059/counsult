@if($banner->isNotEmpty())
    @php $bannerCount = $banner->count(); @endphp

    <div class="container-fluid p-0">
        <div id="header-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="3000">
            <div class="carousel-inner">
                @foreach($banner as $key => $ban)
                    <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                        <img class="w-100" src="{{ asset('uploads/images/' . $ban->image) }}" alt="Image">
                        <div class="carousel-caption d-flex flex-column align-items-center justify-content-center">
                            <div class="p-3" style="max-width: 900px;">
                                <h5 class="text-white text-uppercase">{{ $ban->title }}</h5>
                                <h1 class="display-1 text-white mb-md-4">{!! $ban->description !!}</h1>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#header-carousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#header-carousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const items = document.querySelectorAll('#header-carousel .carousel-item');
            const prevBtn = document.querySelector('#header-carousel .carousel-control-prev');
            const nextBtn = document.querySelector('#header-carousel .carousel-control-next');

            if (items.length <= 1) {
                // Hide controls if only one item
                prevBtn.style.display = 'none';
                nextBtn.style.display = 'none';
            }

            // Start the carousel (Bootstrap 5)
            const carousel = new bootstrap.Carousel('#header-carousel', {
                interval: 3000,
                ride: 'carousel'
            });
        });
    </script>
@endif
