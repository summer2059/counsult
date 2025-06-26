<div class="container-fluid py-6 px-5">
    @if ($fb && $fb->title)
        <div class="text-center mx-auto mb-5" style="max-width: 600px;">
            <h1 class="display-5 nb-0">{{ $fb->title }}</h1>
            {{-- Why Choose Us!! --}}
            <hr class="w-25 mx-auto bg-primary">
        </div>
    @endif

    @php
        $half = ceil($whyDetail->count() / 2);
        $leftItems = $whyDetail->slice(0, $half);
        $rightItems = $whyDetail->slice($half);
    @endphp

    <div class="row g-5">
        {{-- LEFT COLUMN --}}
        <div class="col-lg-4">
            <div class="row g-5">
                @foreach ($leftItems as $item)
                    <div class="col-12">
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center mb-3"
                             style="width: 60px; height: 60px;">
                            <img src="{{ asset('uploads/images/' . $item->image) }}" alt="{{ $item->title }}"
                                 style="width: 30px; height: 30px;">
                        </div>
                        <h3>{{ $item->title }}</h3>
                        <p class="mb-0">{!! $item->description !!}</p>
                    </div>
                @endforeach
            </div>
        </div>

        {{-- CENTER COLUMN --}}
        @if ($fb && $fb->description && $fb->image)
            <div class="col-lg-4">
                <div class="d-block bg-primary h-100 text-center">
                    <img class="img-fluid" src="{{ asset('uploads/images/' . $fb->image) }}" alt="">
                    <div class="p-4">
                        <p class="text-white mb-4">{!! $fb->description !!}</p>
                    </div>
                </div>
            </div>
        @endif

        {{-- RIGHT COLUMN --}}
        <div class="col-lg-4">
            <div class="row g-5">
                @foreach ($rightItems as $item)
                    <div class="col-12">
                        <div class="bg-primary rounded-circle d-flex align-items-center justify-content-center mb-3"
                             style="width: 60px; height: 60px;">
                            <img src="{{ asset('uploads/images/' . $item->image) }}" alt="{{ $item->title }}"
                                 style="width: 30px; height: 30px;">
                        </div>
                        <h3>{{ $item->title }}</h3>
                        <p class="mb-0">{!! $item->description !!}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
