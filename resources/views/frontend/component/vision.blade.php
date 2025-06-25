<section class="vision py-6" style="overflow-x: hidden;">
    <div class="container">
        <div class="row g-xl-5 g-4 align-items-center">
            <!-- Vision Text Section -->
            <div class="col-lg-6 col-12" data-aos="fade-right">
                @if ($vb && $vb->jP_title)
                    <div class="section-header mb-4">
                        <h2 class="fs-6 text-capitalize section__caption text-uppercase">
                            Our Vision
                        </h2>
                        <h3 class="section__title fw-bold">
                            {{ $vb->jp_title }}
                        </h3>
                    </div>
                    {{-- <div class="description">
                        {!! $vb->description !!}
                    </div> --}}
                @endif

                <!-- Vision Steps List -->
                <div class="steps d-flex flex-column gap-4 mt-4">
                    @if ($vision->isNotEmpty())
                        @foreach ($vision as $v)
                            <div class="d-flex gap-3 align-items-center">
                                <div class="step-icon">
                                    <img src="{{ asset('frontend/svg/tick.svg') }}" alt="Tick Icon" height="32" width="32">
                                </div>
                                <h6 class="mb-0">{{ $v->jp_title }}</h6>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <!-- Vision Image Section -->
            @if ($vb && $vb->image2)
                <div class="col-lg-6 col-12" data-aos="fade-left">
                    <img src="{{ asset('uploads/images2/' . $vb->image2) }}" alt="Vision Image"
                        class="img-fluid rounded-3 main-img" width="536" height="600">
                </div>
            @endif
        </div>
    </div>
</section>
