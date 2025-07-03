@if($offer->isNotEmpty())
    <div class="container-fluid pt-6 px-5">
        <div class="text-center mx-auto mb-5" style="max-width: 600px;">
            <h1 class="display-5 mb-0">What We Offer</h1>
            <hr class="w-25 mx-auto bg-primary">
        </div>
        <div class="row g-5">
        @foreach($offer as $off)
            <div class="col-lg-4 col-md-6">
                <div class="service-item bg-secondary text-center px-5">
                    <div class="d-flex align-items-center justify-content-center bg-primary text-white rounded-circle mx-auto mb-4" style="width: 90px; height: 90px;">
                        <img src="{{ asset('uploads/images2/' . $off->image2) }}" alt="Profile"
                                    style="width: 30px; height: 30px;">
                    </div>
                    <h3 class="mb-3">{{$off->jp_title}}</h3>
                    <p class="mb-0">{!!$off->jp_description!!}</p>
                </div>
            </div>
        @endforeach
        </div>
    </div>
@endif
