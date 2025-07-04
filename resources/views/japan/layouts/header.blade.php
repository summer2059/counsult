<div class="container-fluid bg-secondary ps-5 pe-0 d-none d-lg-block">
    <div class="row gx-0">
        <div class="col-md-6 text-center text-lg-start mb-2 mb-lg-0">
            <div class="d-inline-flex align-items-center">
                <a class="text-body py-2 pe-3 border-end" href="{{ route('jp.faqs') }}"><small>FAQs</small></a>
                @foreach (getPageJP() as $page)
                    <a class="text-body py-2 px-3 border-end"
                        href="{{ route('jp.page', $page->jp_slug) }}"><small>{{ $page->jp_title }}</small></a>
                @endforeach
                {{-- <a class="text-body py-2 px-3 border-end" href=""><small>Support</small></a>
                <a class="text-body py-2 px-3 border-end" href=""><small>Privacy</small></a>
                <a class="text-body py-2 px-3 border-end" href=""><small>Policy</small></a> --}}
                <a class="text-body py-2 ps-3" href="{{ route('jp.career') }}"><small>キャリア</small></a>
            </div>
        </div>
        <div class="col-md-6 text-center text-lg-end">
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
    <a href="{{ route('jp.index') }}" class="navbar-brand p-0">
        {{-- <h1 class="m-0 text-uppercase text-primary">
            <i class="far fa-smile text-primary me-2"></i>consult
        </h1> --}}
        <img src="{{ asset(getConfiguration('jp_site_logo')) }}" alt=""
                                style="width: 71px; height: auto; object-fit: cover" />
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarCollapse">
        <div class="navbar-nav ms-auto py-0 me-n3">
            <a href="{{ route('jp.index') }}"
                class="nav-item nav-link {{ request()->routeIs('jp.index') ? 'active' : '' }}">ホームページ</a>
            <a href="{{ route('jp.about') }}"
                class="nav-item nav-link {{ request()->routeIs('jp.about') ? 'active' : '' }}">私たちについて</a>
            <a href="{{ route('jp.services') }}"
                class="nav-item nav-link {{ request()->routeIs('jp.services') ? 'active' : '' }}">サービス</a>
            <a href="{{ route('jp.contact') }}"
                class="nav-item nav-link {{ request()->routeIs('jp.contact') ? 'active' : '' }}">お問い合わせ</a>
            <a href="{{ route('jp.blog') }}"
                class="nav-item nav-link {{ request()->routeIs('jp.blog') ? 'active' : '' }}">ブログ</a>

            <!-- Language Dropdown -->
            {{-- <div class="nav-item dropdown">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">言語</a>
                <div class="dropdown-menu m-0">
                    <a href="{{ url('/') }}" class="dropdown-item">English</a>
                    <a href="{{ url('/np') }}" class="dropdown-item">Nepali</a>
                    <a href="{{ url('/jp') }}" class="dropdown-item">Japanese</a>
                </div>
            </div> --}}
            <div class="d-flex gap-1 align-items-center">
                <a href="/">
                    <div class="p-1">
                        <!-- <div id="uk-flag" style="cursor: pointer"></div> -->
                        <h6 class="mb-0 fw-600 text-primary-main">ENG</h6>
                    </div>
                </a>
                <div id="nav-line"><svg width="1" height="24" viewBox="0 0 1 24" fill="none"
                        xmlns="http://www.w3.org/2000/svg">
                        <line x1="0.5" y1="2.18558e-08" x2="0.499999" y2="24" stroke="#003893"></line>
                    </svg>
                </div>
                <div class="p-1">
                    <!-- <div id="nepal-flag"></div> -->
                    <h6 class="mb-0 fw-600 text-primary-main">JP</h6>
                </div>
            </div>
        </div>
    </div>

</nav>
