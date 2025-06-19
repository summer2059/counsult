@extends('dashboard.layouts.app')

@section('content')
    <div class="col-xl-12 col-md-12 proorder-md-1">
        <div class="row">
            <div class="col-xl-4 col-sm-6">
            <a  href="{{route('contact.index')}}">
                <div class="card">
                    <div class="card-body student">
                        <div class="d-flex gap-2 align-items-end">
                            <div class="flex-grow-1">
                                <h2>{{ $contactCount }}</h2>
                                <p class="mb-0 text-truncate"> Contact</p>
                            </div>
                            <div class="flex-shrink-0">
                            <img src="{{ asset('dashboard/assets/images/dashboard-4/icon/media.png') }}" alt="">
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-xl-4 col-sm-6">
            <a  href="{{route('enquiry-message.index')}}">
                <div class="card">
                    <div class="card-body student">
                        <div class="d-flex gap-2 align-items-end">
                            <div class="flex-grow-1">
                                <h2>{{ $enquiryMessageCount }}</h2>
                                <p class="mb-0 text-truncate"> Enquiry Message</p>
                            </div>
                            <div class="flex-shrink-0">
                            <img src="{{ asset('dashboard/assets/images/dashboard-4/icon/media.png') }}" alt="">
                            </div>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-sm-6">
            <a  href="{{route('testimoinal.index')}}">
                <div class="card">
                    <div class="card-body student">
                        <div class="d-flex gap-2 align-items-end">
                            <div class="flex-grow-1">
                                <h2>{{ $testimonialCount }}</h2>
                                <p class="mb-0 text-truncate"> Testimonial</p>
                            </div>
                            <div class="flex-shrink-0">
                            <img src="{{ asset('dashboard/assets/images/dashboard-4/icon/report.png') }}" alt="">
                            </div>
                        </div>
                        
                    </div>
                </div>
            </a>
            </div>
            
        </div>
    </div>
@endsection
