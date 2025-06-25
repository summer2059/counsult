 @extends('japan.layouts.app')
 @section('content')
 <!-- Carousel Start -->
    @include('japan.component.banner')
    <!-- Carousel End -->


    <!-- About Start -->
    @include('japan.component.index_about')
    <!-- About End -->
    
     <!-- vision Start -->
    @include('japan.component.vision')

<!-- Mission Start -->
@include('japan.component.mission')

    <!-- Services Start -->
    @include('japan.component.index_service')
    <!-- Services End -->


    <!-- Features Start -->
    @include('japan.component.feature')
    <!-- Features Start -->


    <!-- Quote Start -->
    @include('japan.component.quote')
    <!-- Quote End -->


    <!-- Team Start -->
    @include('japan.component.team')
    <!-- Team End -->


    <!-- Testimonial Start -->
    @include('japan.component.testimonial')
    <!-- Testimonial End -->


    <!-- Blog Start -->
    
    <!-- Blog End -->
@endsection