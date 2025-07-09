@if($team->isNotEmpty())
<div class="container-fluid py-6 px-5">
    <div class="text-center mx-auto mb-5" style="max-width: 600px;">
        <h1 class="display-5 mb-0">Our Team Members</h1>
        <hr class="w-25 mx-auto bg-primary">
    </div>

    <!-- Carousel Wrapper -->
    <div id="teamCarousel" class="carousel slide" data-bs-interval="false">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <div class="row g-5 flex-wrap">
                    @foreach($team as $index => $tea)
                        <div class="col-12 col-sm-6 col-md-4">
                            <div class="team-item position-relative overflow-hidden">
                                <img class="img-fluid w-100" src="{{ asset('uploads/images/' . $tea->image) }}" alt="">
                                <div class="team-text w-100 position-absolute top-50 text-center bg-primary p-4">
                                    <h3 class="text-white">{{ $tea->name }}</h3>
                                    <p class="text-white text-uppercase mb-0">{{ $tea->position }}</p>
                                </div>
                            </div>
                        </div>
                        @if(($index + 1) % 3 == 0 && $index + 1 != $team->count())
                            </div></div><div class="carousel-item"><div class="row g-5 flex-wrap">
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Prev and Next Buttons -->
        @if($team->count() > 3)
        <button class="carousel-control-prev d-none" type="button" data-bs-target="#teamCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#teamCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
        @endif
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const carousel = document.querySelector('#teamCarousel');
        const prevBtn = carousel.querySelector('.carousel-control-prev');
        const nextBtn = carousel.querySelector('.carousel-control-next');
        const items = carousel.querySelectorAll('.carousel-item');

        function updateButtons() {
            const activeIndex = Array.from(items).findIndex(item => item.classList.contains('active'));

            if (activeIndex === 0) {
                prevBtn.classList.add('d-none');
            } else {
                prevBtn.classList.remove('d-none');
            }

            if (activeIndex === items.length - 1) {
                nextBtn.classList.add('d-none');
            } else {
                nextBtn.classList.remove('d-none');
            }
        }

        updateButtons();
        carousel.addEventListener('slid.bs.carousel', updateButtons);
    });
</script>
@endif
