<section class="mission py-6">
    <div class="container-fluid px-5 py-6">
        <div class="row g-xl-5 g-4 align-items-center">
            @if ($mb && $mb->title && $mb->image)
                <!-- Mission Image Section -->
                <div class="col-lg-6 col-12 mission-image" data-aos="fade-right">
                    <img src="{{ asset('uploads/images/' . $mb->image) }}" 
                         alt="Mission Image"
                         class="img-fluid rounded-3 main-img">
                </div>

                <!-- Mission Text Section -->
                <div class="col-lg-6 col-12 mission-text" data-aos="fade-left">
                    <div class="section-header mb-4">
                        <h2 class="fs-6 text-capitalize section__caption text-uppercase">
                            Our Mission
                        </h2>
                        <h3 class="section__title fw-bold">
                            {{ $mb->title }}
                        </h3>
                    </div>
            @endif

            @if ($mission->isNotEmpty())
                <div class="steps d-flex flex-column gap-4 mt-4">
                    @foreach ($mission as $m)
                        <div class="d-flex gap-3 align-items-center">
                            <div class="step-icon">
                                <img src="{{ asset('frontend/svg/tick.svg') }}" alt="Tick Icon" height="32" width="32">
                            </div>
                            <h6 class="mb-0">{{ $m->title }}</h6>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</section>
