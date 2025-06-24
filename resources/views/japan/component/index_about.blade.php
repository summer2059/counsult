<div class="container-fluid bg-secondary p-0">
    <div class="row g-0">
        @if ($cb && $cb->title && $cb->description)
            <div class="col-lg-6 py-6 px-5">
                <h1 class="display-5 mb-4">Welcome To <span class="text-primary">CONSULT</span></h1>
                <h4 class="text-primary mb-4">{{ $cb->title }}</h4>
                <p class="mb-4">{!! $cb->description !!}</p>
            </div>
        @endif
        @if ($consult->isNotEmpty())
            <div class="col-lg-6">
                <div class="h-100 d-flex flex-column justify-content-center bg-primary p-5">
                    @foreach ($consult as $cons)
                        <div class="d-flex text-white mb-5">
                            <div class="d-flex flex-shrink-0 align-items-center justify-content-center bg-white text-primary rounded-circle mx-auto mb-4"
                                style="width: 60px; height: 60px;">
                                <img src="{{ asset('uploads/images/' . $cons->image) }}" alt="Profile"
                                    style="width: 30px; height: 30px;">
                            </div>

                            <div class="ps-4">
                                <h3>{{ $cons->title }}</h3>
                                <p class="mb-0">{!! $cons->description !!}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</div>
