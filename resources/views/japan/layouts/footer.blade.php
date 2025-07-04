    <div class="container-fluid bg-dark text-secondary p-5">
    <div class="row g-4">
        <!-- Quick Links -->
        <div class="col-lg-2 col-md-6 footer-column">
            <h3 class="text-white mb-4">Quick Links</h3>
            <div class="d-flex flex-column justify-content-start">
                <a class="text-secondary mb-2" href="{{ route('jp.index') }}"><i class="bi bi-arrow-right text-primary me-2"></i>Home</a>
                <a class="text-secondary mb-2" href="{{ route('jp.about') }}"><i class="bi bi-arrow-right text-primary me-2"></i>About Us</a>
                <a class="text-secondary mb-2" href="{{ route('jp.services') }}"><i class="bi bi-arrow-right text-primary me-2"></i>Our Services</a>
                <a class="text-secondary mb-2" href="{{ route('jp.contact') }}"><i class="bi bi-arrow-right text-primary me-2"></i>Contact Us</a>
                <a class="text-secondary mb-2" href="{{route('jp.faqs')}}"><i class="bi bi-arrow-right text-primary me-2"></i>FAQ</a>
                <a class="text-secondary mb-2" href="{{ route('jp.career')}}"><i class="bi bi-arrow-right text-primary me-2"></i>Career</a>
            </div>
        </div>

        <!-- Popular Links -->
        <div class="col-lg-2 col-md-6 footer-column">
            <h3 class="text-white mb-4">Popular Links</h3>
            <div class="d-flex flex-column justify-content-start">
                @foreach(getQuickLinkJP() as $gq)
                    <a class="text-secondary mb-2" target="_blank" href="{{ $gq->jp_url }}"><i class="bi bi-arrow-right text-primary me-2"></i>{{ $gq->jp_title }}</a>
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

                {{-- Address clickable (Google Maps) --}}
                <p class="mb-2">
                    <i class="bi bi-geo-alt text-primary me-2"></i>
                    <a href="https://www.google.com/maps/search/?api=1&query={{ urlencode(getConfiguration('jp_site_address')) }}"
                        target="_blank" class="text-white text-decoration-none">
                        {{ getConfiguration('jp_site_address') }}
                    </a>
                </p>

                {{-- Email clickable --}}
                <p class="mb-2">
                    <i class="bi bi-envelope-open text-primary me-2"></i>
                    <a href="mailto:{{ getConfiguration('jp_email_address') }}" class="text-white text-decoration-none">
                        {{ getConfiguration('jp_email_address') }}
                    </a>
                </p>

                {{-- Phone clickable --}}
                <p class="mb-0">
                    <i class="bi bi-telephone text-primary me-2"></i>
                    <a href="tel:{{ getConfiguration('office_number') }}" class="text-white text-decoration-none">
                        {{ getConfiguration('jp_office_number') }}
                    </a>
                </p>
            </div>

        <!-- Follow Us -->
        <div class="col-lg-3 col-md-12 footer-column">
            <h3 class="text-white mb-4">Follow Us</h3>
            <div class="d-flex">
                <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" target="_blank" href="{{ getConfiguration('jp_twitter_link') }}"><i class="fab fa-twitter fw-normal"></i></a>
                <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" target="_blank" href="{{ getConfiguration('jp_facebook_link') }}"><i class="fab fa-facebook-f fw-normal"></i></a>
                <a class="btn btn-lg btn-primary btn-lg-square rounded-circle me-2" target="_blank" href="{{ getConfiguration('jp_linkedin_link') }}"><i class="fab fa-linkedin-in fw-normal"></i></a>
                <a class="btn btn-lg btn-primary btn-lg-square rounded-circle" target="_blank" href="{{ getConfiguration('jp_instagram_link') }}"><i class="fab fa-instagram fw-normal"></i></a>
            </div>
        </div>
    </div>
</div>

    <div class="container-fluid bg-dark text-secondary text-center border-top py-4 px-5" style="border-color: rgba(256, 256, 256, .1) !important;">
        <p class="m-0">&copy; {{getConfiguration('jp_copyright_notice')}} <a class="text-secondary border-bottom" href="{{route('jp.index')}}">{{getConfiguration('jp_site_title')}}</a>. All Rights Reserved. Designed by <a class="text-secondary border-bottom" onclick="sendMail()">Sagar Gautam</a></p>
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