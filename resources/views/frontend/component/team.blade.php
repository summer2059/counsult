@if($team->isNotEmpty())
<div class="container-fluid py-6 px-5">
    <div class="text-center mx-auto mb-5" style="max-width: 600px;">
        <h1 class="display-5 mb-0">Our Team Members</h1>
        <hr class="w-25 mx-auto bg-primary">
    </div>

    <!-- Carousel Wrapper -->
    <div id="teamCarousel" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @foreach($team->chunk(3) as $index => $chunk)
            <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                <div class="row g-5">
                    @foreach($chunk as $tea)
                    <div class="col-lg-4">
                        <div class="team-item position-relative overflow-hidden">
                            <img class="img-fluid w-100" src="{{asset('uploads/images/'. $tea->image)}}" alt="">
                            <div class="team-text w-100 position-absolute top-50 text-center bg-primary p-4">
                                <h3 class="text-white">{{$tea->name}}</h3>
                                <p class="text-white text-uppercase mb-0">{{$tea->position}}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>

        <!-- Prev and Next Buttons -->
        @if($team->count() > 3)
        <button class="carousel-control-prev" type="button" data-bs-target="#teamCarousel" data-bs-slide="prev">
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
@endif
