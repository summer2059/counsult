@if($offer->isNotEmpty())
<div class="container-fluid pt-6 px-5">
    <div class="text-center mx-auto mb-5" style="max-width: 600px;">
        <h1 class="display-5 mb-0">What We Offer</h1>
        <hr class="w-25 mx-auto bg-primary">
    </div>
    <div class="row g-5">
        @foreach($offer as $off)
        <div class="col-lg-4 col-md-6 mb-3">
            <div class="service-item bg-secondary text-center px-5 pb-4 pt-4 h-100 d-flex flex-column justify-content-between"
                style="
                    position: relative;
                    overflow: hidden;
                    height: 350px;
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                    transition: none;
                ">
                <div>
                    <div class="d-flex align-items-center justify-content-center bg-primary text-white rounded-circle mx-auto mb-4"
                        style="width: 90px; height: 90px;">
                        <img src="{{ asset('uploads/images/' . $off->image) }}" alt="Profile"
                            style="width: 64px; height: 70px;">
                    </div>
                    <h3 class="mb-3">{{ $off->title }}</h3>
                    <p class="mb-4" style="margin-bottom: 1rem !important;">{!! $off->description !!}</p>
                </div>

                <div>
                    <a href="{{ route('contact') }}" class="btn btn-primary" style="transition: none;">Apply Now</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif
