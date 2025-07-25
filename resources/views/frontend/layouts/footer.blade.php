    <div class="container-fluid bg-dark text-secondary p-5">
    <div class="row g-4">
        <!-- Quick Links -->
        <div class="col-lg-2 col-md-6 footer-column">
            <h3 class="text-white mb-4">Quick Links</h3>
            <div class="d-flex flex-column justify-content-start">
                <a class="text-secondary mb-2" href="{{ route('home-page') }}"><i class="bi bi-arrow-right text-primary me-2"></i>Home</a>
                <a class="text-secondary mb-2" href="{{ route('about') }}"><i class="bi bi-arrow-right text-primary me-2"></i>About Us</a>
                <a class="text-secondary mb-2" href="{{ route('services') }}"><i class="bi bi-arrow-right text-primary me-2"></i>Our Services</a>
                <a class="text-secondary mb-2" href="{{ route('contact') }}"><i class="bi bi-arrow-right text-primary me-2"></i>Contact Us</a>
                <a class="text-secondary mb-2" href="{{route('faqs')}}"><i class="bi bi-arrow-right text-primary me-2"></i>FAQ</a>
                <a class="text-secondary mb-2" href="{{ route('career')}}"><i class="bi bi-arrow-right text-primary me-2"></i>Career</a>
            </div>
        </div>

        <!-- Popular Links -->
        <div class="col-lg-2 col-md-6 footer-column">
            <h3 class="text-white mb-4">Popular Links</h3>
            <div class="d-flex flex-column justify-content-start">
                @foreach(getQuickLink() as $gq)
                    <a class="text-secondary mb-2" target="_blank" href="{{ $gq->url }}"><i class="bi bi-arrow-right text-primary me-2"></i>{{ $gq->title }}</a>
                @endforeach
            </div>
        </div>

        <!-- Terms of Service -->
        <div class="col-lg-2 col-md-6 footer-column">
            <h3 class="text-white mb-4">Terms of Service</h3>
            <div class="d-flex flex-column justify-content-start">
                @foreach (getPage() as $page)
                    <a class="text-secondary mb-2" href="{{ route('page', $page->slug) }}"><i class="bi bi-arrow-right text-primary me-2"></i>{{ $page->title }}</a>
                @endforeach
            </div>
        </div>

        <!-- Get In Touch -->
        <div class="col-lg-3 col-md-6 footer-column">
            <h3 class="text-white mb-4">Get In Touch</h3>
            <p class="mb-2"><i class="bi bi-geo-alt text-primary me-2"></i>{{ getConfiguration('site_address') }}</p>
            <p class="mb-2"><i class="bi bi-envelope-open text-primary me-2"></i>{{ getConfiguration('email_address') }}</p>
            <p class="mb-0"><i class="bi bi-telephone text-primary me-2"></i>{{ getConfiguration('office_number') }}</p>
        </div>

        <!-- Follow Us -->
        <div class="col-lg-3 col-md-12 footer-column">
            <h3 class="text-white mb-4">Follow Us</h3>
            <div class="d-flex">
                <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" target="_blank" href="{{ getConfiguration('twitter_link') }}"><i class="fab fa-twitter fw-normal"></i></a>
                <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" target="_blank" href="{{ getConfiguration('facebook_link') }}"><i class="fab fa-facebook-f fw-normal"></i></a>
                <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" target="_blank" href="{{ getConfiguration('linkedin_link') }}"><i class="fab fa-linkedin-in fw-normal"></i></a>
                <a class="btn btn-lg btn-primary btn-lg-square rounded-circle" target="_blank" href="{{ getConfiguration('instagram_link') }}"><i class="fab fa-instagram fw-normal"></i></a>
            </div>
        </div>
    </div>
</div>

    <div class="container-fluid bg-dark text-secondary text-center border-top py-4 px-5" style="border-color: rgba(256, 256, 256, .1) !important;">
        <p class="m-0">&copy; {{getConfiguration('copyright_notice')}} <a class="text-secondary border-bottom" href="{{route('home-page')}}">{{getConfiguration('site_title')}}</a>. All Rights Reserved. Designed by <a class="text-secondary border-bottom" onclick="sendMail()">Sagar Gautam</a></p>
    </div>
    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square rounded-circle back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{asset('frontend/lib/easing/easing.min.js')}}"></script>
    <script src="{{asset('frontend/lib/waypoints/waypoints.min.js')}}"></script>
    <script src="{{asset('frontend/lib/owlcarousel/owl.carousel.min.js')}}"></script>

    <!-- Template Javascript -->
    <script src="{{asset('frontend/js/main.js')}}"></script>
    <script>
    function sendMail() {
        window.location.href = "mailto:sagargautam0626@gmail.com?subject=Hello&body=I Wanna work with you. Can you please help me?";
    }
    </script>