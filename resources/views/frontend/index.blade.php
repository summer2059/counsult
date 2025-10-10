 @extends('frontend.layouts.app')
 @section('content')
 <!-- Carousel Start -->
    @include('frontend.component.banner')
    <!-- Carousel End -->


    <!-- About Start -->
    @include('frontend.component.index_about')
    <!-- About End -->
    <!-- Services Start -->
    @include('frontend.component.index_service')
    <!-- Services End -->
    <!-- Intake Start -->
    @include('frontend.component.intake')
    <!-- Intake End -->
    <!-- vision Start -->
    @include('frontend.component.vision')
    <!-- City Start -->
    @include('frontend.component.city')
    <!-- City End -->
<!-- Mission Start -->
@include('frontend.component.mission')

@include('frontend.component.message')
    


    <!-- Features Start -->
    @include('frontend.component.feature')
    <!-- Features Start -->


    <!-- Quote Start -->
    @include('frontend.component.quote')
    <!-- Quote End -->


    <!-- Team Start -->
    @include('frontend.component.team')
    <!-- Team End -->


    <!-- Testimonial Start -->
    @include('frontend.component.testimonial')
    <!-- Testimonial End -->


    <!-- Blog Start -->
    
    <!-- Blog End -->
@endsection