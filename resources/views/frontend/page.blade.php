@extends('frontend.layouts.app')
@section('content')
    <section class="documentation">
        <div class="main-policy-page py-5">
            <div class="container">
                <div class=" wrapper mb-5">
                    <h3 class="fw-bold mb-3" style="color:#000;">{{$page->title}}</h3>
                    <h6 class="fs14 fw-600" style="color:#000;">Last updated on {{$page->updated_at->format('d M Y')}}</h6>
                    <p>{!!$page->description!!}</p>
                </div>
            </div>
        </div>
    </section>
@endsection
