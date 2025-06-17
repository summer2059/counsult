@extends('dashboard.layouts.app')

@section('content')
    <div class="col-xl-12 col-md-12 proorder-md-1">
        <div class="row">
            <div class="col-xl-4 col-sm-6">
            <a  href="">
                <div class="card">
                    <div class="card-body student">
                        <div class="d-flex gap-2 align-items-end">
                            <div class="flex-grow-1">
                                {{-- <h2>{{ $contactCount }}</h2> --}}
                                <p class="mb-0 text-truncate"> Contact</p>
                            </div>
                            <div class="flex-shrink-0">
                            <img src="{{ asset('dashboard/assets/images/dashboard-4/icon/report.png') }}" alt="">
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-sm-6">
            <a  href="">
                <div class="card">
                    <div class="card-body student">
                        <div class="d-flex gap-2 align-items-end">
                            <div class="flex-grow-1">
                                {{-- <h2>{{ $testimonialCount }}</h2> --}}
                                <p class="mb-0 text-truncate"> Testimonial</p>
                            </div>
                            <div class="flex-shrink-0">
                            <img src="{{ asset('dashboard/assets/images/dashboard-4/icon/report.png') }}" alt="">
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6">
            <a  href="">
                <div class="card">
                    <div class="card-body student">
                        <div class="d-flex gap-2 align-items-end">
                            <div class="flex-grow-1">
                                {{-- <h2>{{ $whyusCount }}</h2> --}}
                                <p class="mb-0 text-truncate"> Why Us Details</p>
                            </div>
                            <div class="flex-shrink-0">
                            <img src="{{ asset('dashboard/assets/images/dashboard-4/icon/report.png') }}" alt="">
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
@endsection
