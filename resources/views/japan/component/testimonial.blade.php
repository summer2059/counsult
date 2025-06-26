<div class="container-fluid bg-secondary p-0">
    <div class="row g-0">
        @if ($tb && $tb->image2)
            <div class="col-lg-6" style="min-height: 500px;">
                <div class="position-relative h-100">
                    <img class="position-absolute w-100 h-100" src="{{ asset('uploads/images2/' . $tb->image2) }}"
                        style="object-fit: cover;">
                </div>
            </div>
        @endif

        <div class="col-lg-6 py-6 px-5">
            @if ($tb && $tb->jp_title)
                <h1 class="display-5 mb-4">{{ $tb->jp_title }}</h1>
            @endif

            <div class="owl-carousel testimonial-carousel">
                @if ($testimonial->isNotEmpty())
                    @foreach ($testimonial as $test)
                        <div class="testimonial-item">
                            <p class="fs-4 fw-normal mb-4"><i
                                    class="fa fa-quote-left text-primary me-3"></i>{!! $test->jp_description !!}</p>
                            <div class="d-flex align-items-center">
                                <img class="img-fluid rounded-circle"
                                    src="{{ asset('uploads/images2/' . $test->image2) }}" alt="">
                                <div class="ps-4">
                                    <h3>{{ $test->jp_name }}</h3>
                                    <span class="text-uppercase">{{ $test->jp_position }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
