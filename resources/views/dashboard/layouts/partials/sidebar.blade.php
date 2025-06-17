<div class="sidebar-wrapper" data-layout="stroke-svg">
    <div>
        <div class="logo-wrapper "><a href="#"><img class="img-fluid logo_img"
                    src="" alt=""></a>
            <div class="back-btn"><i class="fa fa-angle-left"></i></div>
            <div class="toggle-sidebar">
                <svg class="stroke-icon sidebar-toggle status_toggle middle">
                    <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#toggle-icon"></use>
                </svg>
                <svg class="fill-icon sidebar-toggle status_toggle middle">
                    <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#fill-toggle-icon"></use>
                </svg>
            </div>
        </div>
        <div class="logo-icon-wrapper"><a href="#"><img class="img-fluid logo_icon"
                    src="" alt=""></a></div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn"><a href="#"><img class="img-fluid logo_icon"
                                src="" alt=""></a>
                        <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                aria-hidden="true"></i></div>
                    </li>
                    <li class="pin-title sidebar-main-title">
                        <div>
                            <h6>Pinned</h6>
                        </div>
                    </li>
                    <li class="sidebar-main-title">
                        <div>
                            <h6 class="lan-1">General</h6>
                        </div>
                    </li>
                    <li class="sidebar-list" style="{{ request()->routeIs('index') ? 'background-color: #708090;' : '' }}"><i class="fa fa-thumb-tack"> </i><a
                            class="sidebar-link sidebar-title link-nav" href="{{ route('index') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#stroke-board"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#fill-board"></use>
                            </svg><span>Dashboard </span></a>
                    </li>
                    {{-- <li class="sidebar-list" style="{{ request()->routeIs('about-us.index') ? 'background-color: #708090;' : '' }}"><i class="fa fa-thumb-tack"></i><a
                            class="sidebar-link sidebar-title link-nav" href="{{ route('about-us.index') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#stroke-gallery"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#fill-gallery"></use>
                            </svg><span>About Us</span></a>
                    </li> --}}
                    <li class="sidebar-list" style="{{ request()->routeIs('banner.index', 'banner.create', 'banner.edit') ? 'background-color: #708090;' : '' }}"><i class="fa fa-thumb-tack"> </i><a
                            class="sidebar-link sidebar-title link-nav" href="{{ route('banner.index') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#stroke-board"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#fill-board"></use>
                            </svg><span>Banner </span></a>
                    </li>

                    <li class="sidebar-list {{ request()->routeIs('consult-banner.index', 'consult-banner.create', 'consult-banner.edit', 'consult-detail.index', 'consult-detail.create', 'consult-detail.edit') ? 'open' : '' }}">
                        <a class="sidebar-link sidebar-title" data-toggle="dropdown">
                            <svg class="stroke-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#stroke-gallery"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#fill-gallery"></use>
                            </svg>
                            <span>Consult</span>
                        </a>
                        <ul class="sidebar-submenu {{ request()->routeIs('consult-banner.index', 'consult-banner.create', 'consult-banner.edit', 'consult-detail.index', 'consult-detail.create', 'consult-detail.edit') ? 'd-block' : '' }}">
                            <li><a style="{{ request()->routeIs('consult-banner.index', 'consult-banner.create', 'consult-banner.edit') ? 'background-color: #708090;' : '' }}" href="{{ route('consult-banner.index') }}">Counsult Banner </a></li>
                            <li><a style="{{ request()->routeIs('consult-detail.index', 'consult-detail.create', 'consult-detail.edit') ? 'background-color: #708090;' : '' }}" href="{{ route('consult-detail.index') }}">Counsult Banner</a></li>

                        </ul>
                    </li>
                    <li class="sidebar-list" style="{{ request()->routeIs('offer.index', 'offer.create', 'offer.edit') ? 'background-color: #708090;' : '' }}"><i class="fa fa-thumb-tack"> </i><a
                            class="sidebar-link sidebar-title link-nav" href="{{ route('offer.index') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#stroke-board"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#fill-board"></use>
                            </svg><span>Offer </span></a>
                    </li>
                     <li class="sidebar-list {{ request()->routeIs('why-us-banner.index', 'consult-detail.index', 'consult-detail.create', 'consult-detail.edit') ? 'open' : '' }}">
                        <a class="sidebar-link sidebar-title" data-toggle="dropdown">
                            <svg class="stroke-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#stroke-gallery"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#fill-gallery"></use>
                            </svg>
                            <span>Why Us</span>
                        </a>
                        <ul class="sidebar-submenu {{ request()->routeIs('why-us-banner.index', 'consult-detail.index', 'consult-detail.create', 'consult-detail.edit') ? 'd-block' : '' }}">
                            <li><a style="{{ request()->routeIs('why-us-banner.index') ? 'background-color: #708090;' : '' }}" href="{{ route('why-us-banner.index') }}">Why Us Banner </a></li>
                            {{-- <li><a style="{{ request()->routeIs('businessdetail.index') ? 'background-color: #708090;' : '' }}" href="{{ route('businessdetail.index') }}">Business Detail</a></li> --}}

                        </ul>
                    </li>
                    {{--<li class="sidebar-list" style="{{ request()->routeIs('contact.index') ? 'background-color: #708090;' : '' }}"><i class="fa fa-thumb-tack"></i><a
                            class="sidebar-link sidebar-title link-nav" href="{{ route('contact.index') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#stroke-gallery"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#fill-gallery"></use>
                            </svg><span>Contact</span></a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title">
                            <svg class="stroke-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#stroke-gallery"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#fill-gallery"></use>
                            </svg>
                            <span>Easy Step</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a style="{{ request()->routeIs('step.index') ? 'background-color: #708090;' : '' }}" href="{{ route('step.index') }}">Step </a></li>
                            <li><a style="{{ request()->routeIs('method.index') ? 'background-color: #708090;' : '' }}" href="{{ route('method.index') }}">Method</a></li>

                        </ul>
                    </li> --}}
                    {{-- <li class="sidebar-list" style="{{ request()->routeIs('feedback.index') ? 'background-color: #708090;' : '' }}"><i class="fa fa-thumb-tack"> </i><a
                            class="sidebar-link sidebar-title link-nav" href="{{ route('feedback.index') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#stroke-board"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#fill-board"></use>
                            </svg><span>Feedback </span></a>
                    </li> --}}
                    {{-- <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title">
                            <svg class="stroke-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#stroke-gallery"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#fill-gallery"></use>
                            </svg>
                            <span>Feedback</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a style="{{ request()->routeIs('feedback.index') ? 'background-color: #708090;' : '' }}" href="{{ route('feedback.index') }}">Feedback </a></li>
                            <li><a style="{{ request()->routeIs('testimoinal.index') ? 'background-color: #708090;' : '' }}" href="{{ route('testimoinal.index') }}">Testimoinal</a></li>

                        </ul>
                    </li>
                    
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title">
                            <svg class="stroke-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#stroke-gallery"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#fill-gallery"></use>
                            </svg>
                            <span>Financial</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a style="{{ request()->routeIs('finance.index') ? 'background-color: #708090;' : '' }}" href="{{ route('finance.index') }}">Finance </a></li>
                            <li><a style="{{ request()->routeIs('financialdetail.index') ? 'background-color: #708090;' : '' }}" href="{{ route('financialdetail.index') }}">Finance Details</a></li>

                        </ul>
                    </li>
                    <li class="sidebar-list" style="{{ request()->routeIs('question.index') ? 'background-color: #708090;' : '' }}"><i class="fa fa-thumb-tack"> </i><a
                            class="sidebar-link sidebar-title link-nav" href="{{ route('question.index') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#stroke-board"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#fill-board"></use>
                            </svg><span>Question </span></a>
                    </li>
                    <li class="sidebar-list">
                        <a class="sidebar-link sidebar-title">
                            <svg class="stroke-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#stroke-gallery"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#fill-gallery"></use>
                            </svg>
                            <span>Why Us</span>
                        </a>
                        <ul class="sidebar-submenu">
                            <li><a style="{{ request()->routeIs('whyus.index') ? 'background-color: #708090;' : '' }}" href="{{ route('whyus.index') }}">Why US </a></li>
                            <li><a style="{{ request()->routeIs('whyusdetail.index') ? 'background-color: #708090;' : '' }}" href="{{ route('whyusdetail.index') }}">Why Us Details</a></li>

                        </ul>
                    </li>

                    <li class="sidebar-list" style="{{ request()->routeIs('settings') ? 'background-color: #708090;' : '' }}"><i class="fa fa-thumb-tack"> </i><a
                            class="sidebar-link sidebar-title link-nav" href="{{ route('settings') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#stroke-board"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#fill-board"></use>
                            </svg><span>Site Settings </span></a>
                    </li> --}}
                    {{-- <li class="sidebar-list" style="{{ request()->routeIs('testimoinal.index') ? 'background-color: #708090;' : '' }}"><i class="fa fa-thumb-tack"> </i><a
                            class="sidebar-link sidebar-title link-nav" href="{{ route('testimoinal.index') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#stroke-board"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#fill-board"></use>
                            </svg><span>Testimonial </span></a>
                    </li> --}}
                    
                </ul>
            </div>
            <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
        </nav>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownToggles = document.querySelectorAll('[data-toggle="dropdown"]');

        dropdownToggles.forEach(function(dropdownToggle) {
            const submenu = dropdownToggle.nextElementSibling;
            if (submenu.classList.contains('d-block')) {
                submenu.style.display = 'block';
            }
            dropdownToggle.addEventListener('click', function(event) {
                submenu.classList.toggle('d-block');
                dropdownToggle.closest('.sidebar-list').classList.toggle('open');
            });
        });
    });
</script>