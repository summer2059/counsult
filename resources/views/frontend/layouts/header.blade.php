<div class="container-fluid bg-secondary ps-5 pe-0">
    <div class="row gx-0">
        <div class="col-md-6 text-center text-lg-start mb-2 mb-lg-0">
            <div class="d-inline-flex align-items-center">
                <a class="text-body py-2 pe-3 border-end" href="{{ route('faqs') }}"><small>FAQs</small></a>
                @foreach (getPage() as $page)
                    <a class="text-body py-2 px-3 border-end"
                        href="{{ route('page', $page->slug) }}"><small>{{ $page->title }}</small></a>
                @endforeach
                {{-- <a class="text-body py-2 px-3 border-end" href=""><small>Support</small></a>
                <a class="text-body py-2 px-3 border-end" href=""><small>Privacy</small></a>
                <a class="text-body py-2 px-3 border-end" href=""><small>Policy</small></a> --}}
                <a class="text-body py-2 ps-3" href="{{ route('career') }}"><small>Career</small></a>
            </div>
        </div>
        <div class="col-md-6 d-lg-block d-none text-center text-lg-end">
            <div class="position-relative d-inline-flex align-items-center bg-primary text-white top-shape px-5">
                <div class="me-3 pe-3 border-end py-2">
                    <p class="m-0"><i class="fa fa-envelope-open me-2"></i>info@example.com</p>
                </div>
                <div class="py-2">
                    <p class="m-0"><i class="fa fa-phone-alt me-2"></i>+012 345 6789</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Topbar End -->


<!-- Navbar Start -->
<nav class="navbar navbar-expand-lg bg-white navbar-light shadow-sm px-5 py-3 py-lg-0">
    <a href="{{ route('home-page') }}" class="navbar-brand p-0">
        {{-- <h1 class="m-0 text-uppercase text-primary">
            <i class="far fa-smile text-primary me-2"></i>consult
        </h1> --}}
        <img src="{{ asset(getConfiguration('site_logo')) }}" alt=""
                                style="width: 71px; height: auto; object-fit: cover" />

    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0 me-n3">
            <a href="{{ route('home-page') }}"
                class="nav-item nav-link {{ request()->routeIs('home-page') ? 'active' : '' }}">Home</a>
            <a href="{{ route('about') }}"
                class="nav-item nav-link {{ request()->routeIs('about') ? 'active' : '' }}">About</a>
            <a href="{{ route('services') }}"
                class="nav-item nav-link {{ request()->routeIs('services') ? 'active' : '' }}">Service</a>
            <a href="{{ route('contact') }}"
                class="nav-item nav-link {{ request()->routeIs('contact') ? 'active' : '' }}">Contact</a>
            <a href="{{ route('jp.blog') }}"
                class="nav-item nav-link {{ request()->routeIs('jp.blog') ? 'active' : '' }}">Blog</a>

            <!-- Language Dropdown -->
            {{-- <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">Language</a>
                <div class="dropdown-menu m-0">
                    <a href="{{ url('/') }}" class="dropdown-item">English</a>
                    <a href="{{ url('/jp') }}" class="dropdown-item">Japanese</a>
                </div>
            </div> --}}
            <div class="d-flex gap-1 align-items-center">
                <div class="p-1">
                    <!-- <div id="united-kingdom"></div> -->
                    <h6 class="mb-0 fw-600 text-primary-main">ENG</h6>
                </div>
                <div id="nav-line"><svg width="1" height="24" viewBox="0 0 1 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <line x1="0.5" y1="2.18558e-08" x2="0.499999" y2="24" stroke="#003893"></line>
                    </svg>
                </div>
                <a href="/jp ">
                    <div class="p-1">
                        <!-- <div id="nepal-flag" style="cursor: pointer;"></div> -->
                        <h6 class="mb-0 fw-600 text-primary-main">JP</h6>
                    </div>
                </a>
            </div>
        </div>
    </div>

</nav>
