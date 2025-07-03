@extends('japan.layouts.app')
@section('content')
    <!-- Page Header Start -->
    <div class="container-fluid bg-dark p-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="display-4 text-white">Services</h1>
                <a href="{{route('jp.index')}}">Home</a>
                <i class="far fa-square text-primary px-2"></i>
                <a href="">Services</a>
            </div>
        </div>
    </div>
    <!-- Page Header End -->


    <!-- Services Start -->
    <div class="container-fluid py-6 px-5">
        <div class="text-center mx-auto mb-5" style="max-width: 600px;">
            <h1 class="display-5 mb-0">Service</h1>
            <hr class="w-25 mx-auto bg-primary">
        </div>
        <div class="row g-5">
    @if ($service->isNotEmpty())
        @foreach ($service as $sev)
            <div class="col-lg-4 col-md-6">
                <a href="{{ route('jp.service.detail', $sev->jp_slug) }}" class="text-decoration-none">
                    <div class="service-item bg-secondary text-center px-5 text-dark">
                        <div class="d-flex align-items-center justify-content-center bg-primary text-white rounded-circle mx-auto mb-4"
                            style="width: 90px; height: 90px; overflow: hidden;">
                            <img src="{{ asset('uploads/images2/' . $sev->image2) }}" alt="{{ $sev->jp_title }}"
                                style="width: 100%; height: 100%; object-fit: cover;">
                        </div>

                        <h3 class="mb-3">{{ $sev->jp_title }}</h3>
                        <p class="mb-0 text-dark">{!! Str::limit(strip_tags($sev->jp_description), 100) !!}</p>
                    </div>
                </a>
            </div>
        @endforeach
    @endif
</div>

    </div>
    <!-- Services End -->


    <!-- Quote Start -->
    @include('japan.component.quote')
    <!-- Quote End -->
@endsection
