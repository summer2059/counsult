<div class="sidebar-wrapper" data-layout="stroke-svg">
    <div>
        <div class="logo-wrapper "><a href="#"><img class="img-fluid logo_img" src="" alt=""></a>
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
        <div class="logo-icon-wrapper"><a href="#"><img class="img-fluid logo_icon" src=""
                    alt=""></a></div>
        <nav class="sidebar-main">
            <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
            <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                    <li class="back-btn"><a href="#"><img class="img-fluid logo_icon" src=""
                                alt=""></a>
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
                    <li class="sidebar-list"
                        style="{{ request()->routeIs('index') ? 'background-color: #708090;' : '' }}"><i
                            class="fa fa-thumb-tack"> </i><a class="sidebar-link sidebar-title link-nav"
                            href="{{ route('index') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#stroke-board"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#fill-board"></use>
                            </svg><span>Dashboard </span></a>
                    </li>
                    <li class="sidebar-list"
                        style="{{ request()->routeIs('banner.index', 'banner.create', 'banner.edit') ? 'background-color: #708090;' : '' }}">
                        <i class="fa fa-thumb-tack"> </i><a class="sidebar-link sidebar-title link-nav"
                            href="{{ route('banner.index') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#stroke-board"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#fill-board"></use>
                            </svg><span>Banner </span></a>
                    </li>
                    <li
                        class="sidebar-list {{ request()->routeIs('blog-category.index', 'blog-category.create', 'blog-category.edit', 'blog.index', 'blog.create', 'blog.edit') ? 'open' : '' }}">
                        <a class="sidebar-link sidebar-title" data-toggle="dropdown">
                            <svg class="stroke-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#stroke-gallery"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#fill-gallery"></use>
                            </svg>
                            <span>Blog</span>
                        </a>
                        <ul
                            class="sidebar-submenu {{ request()->routeIs('blog-category.index', 'blog-category.create', 'blog-category.edit', 'blog.index', 'blog.create', 'blog.edit') ? 'd-block' : '' }}">
                            <li><a style="{{ request()->routeIs('blog-category.index', 'blog-category.create', 'blog-category.edit') ? 'background-color: #708090;' : '' }}"
                                    href="{{ route('blog-category.index') }}">Blog Category </a></li>
                            <li><a style="{{ request()->routeIs('blog.index', 'blog.create', 'blog.edit') ? 'background-color: #708090;' : '' }}"
                                    href="{{ route('blog.index') }}">Blog</a></li>
                        </ul>
                    </li>
                    <li
                        class="sidebar-list {{ request()->routeIs('career.index', 'career.create', 'career.edit', 'career.show', 'career-form.index') ? 'open' : '' }}">
                        <a class="sidebar-link sidebar-title" data-toggle="dropdown">
                            <svg class="stroke-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#stroke-gallery"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#fill-gallery"></use>
                            </svg>
                            <span>Career</span>
                        </a>
                        <ul
                            class="sidebar-submenu {{ request()->routeIs('career.index', 'career.create', 'career.edit', 'career-form.index', 'career.show') ? 'd-block' : '' }}">
                            <li><a style="{{ request()->routeIs('career.index', 'career.create', 'career.edit', 'career.show') ? 'background-color: #708090;' : '' }}"
                                    href="{{ route('career.index') }}">Career </a></li>
                            <li><a style="{{ request()->routeIs('career-form.index') ? 'background-color: #708090;' : '' }}"
                                    href="{{ route('career-form.index') }}">Career Form</a></li>

                        </ul>
                    </li>
                    <li
                        class="sidebar-list {{ request()->routeIs('consult-banner.index', 'consult-banner.create', 'consult-banner.edit', 'consult-detail.index', 'consult-detail.create', 'consult-detail.edit') ? 'open' : '' }}">
                        <a class="sidebar-link sidebar-title" data-toggle="dropdown">
                            <svg class="stroke-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#stroke-gallery"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#fill-gallery"></use>
                            </svg>
                            <span>Consult</span>
                        </a>
                        <ul
                            class="sidebar-submenu {{ request()->routeIs('consult-banner.index', 'consult-banner.create', 'consult-banner.edit', 'consult-detail.index', 'consult-detail.create', 'consult-detail.edit') ? 'd-block' : '' }}">
                            <li><a style="{{ request()->routeIs('consult-banner.index', 'consult-banner.create', 'consult-banner.edit') ? 'background-color: #708090;' : '' }}"
                                    href="{{ route('consult-banner.index') }}">Counsult Banner </a></li>
                            <li><a style="{{ request()->routeIs('consult-detail.index', 'consult-detail.create', 'consult-detail.edit') ? 'background-color: #708090;' : '' }}"
                                    href="{{ route('consult-detail.index') }}">Counsult Detail</a></li>

                        </ul>
                    </li>
                    <li class="sidebar-list"
                        style="{{ request()->routeIs('contact.index') ? 'background-color: #708090;' : '' }}"><i
                            class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav"
                            href="{{ route('contact.index') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#stroke-gallery"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#fill-gallery"></use>
                            </svg><span>Contact</span></a>
                    </li>
                    <li
                        class="sidebar-list {{ request()->routeIs('enquiry-banner.index', 'enquiry-message.index') ? 'open' : '' }}">
                        <a class="sidebar-link sidebar-title" data-toggle="dropdown">
                            <svg class="stroke-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#stroke-gallery"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#fill-gallery"></use>
                            </svg>
                            <span>Enquiry</span>
                        </a>
                        <ul
                            class="sidebar-submenu {{ request()->routeIs('enquiry-banner.index', 'enquiry-message.index') ? 'd-block' : '' }}">
                            <li><a style="{{ request()->routeIs('enquiry-banner.index') ? 'background-color: #708090;' : '' }}"
                                    href="{{ route('enquiry-banner.index') }}">Enquiry Banner </a></li>
                            <li><a style="{{ request()->routeIs('enquiry-message.index') ? 'background-color: #708090;' : '' }}"
                                    href="{{ route('enquiry-message.index') }}">Enquiry Message</a></li>

                        </ul>
                    </li>
                    <li class="sidebar-list"
                        style="{{ request()->routeIs('faqs.index', 'faqs.create', 'faqs.edit') ? 'background-color: #708090;' : '' }}">
                        <i class="fa fa-thumb-tack"> </i><a class="sidebar-link sidebar-title link-nav"
                            href="{{ route('faqs.index') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#stroke-board"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#fill-board"></use>
                            </svg><span>FAQ'S </span></a>
                    </li>
                    <li
                        class="sidebar-list {{ request()->routeIs('mission-banner.index', 'mission.index', 'mission.create', 'mission.edit') ? 'open' : '' }}">
                        <a class="sidebar-link sidebar-title" data-toggle="dropdown">
                            <svg class="stroke-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#stroke-gallery"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#fill-gallery"></use>
                            </svg>
                            <span>Mission</span>
                        </a>
                        <ul
                            class="sidebar-submenu {{ request()->routeIs('mission-banner.index', 'mission.index', 'mission.create', 'mission.edit') ? 'd-block' : '' }}">
                            <li><a style="{{ request()->routeIs('mission-banner.index') ? 'background-color: #708090;' : '' }}"
                                    href="{{ route('mission-banner.index') }}">Mission Banner </a></li>
                            <li><a style="{{ request()->routeIs('mission.index', 'mission.create', 'mission.edit') ? 'background-color: #708090;' : '' }}"
                                    href="{{ route('mission.index') }}">Mission</a></li>

                        </ul>
                    </li>
                    <li class="sidebar-list"
                        style="{{ request()->routeIs('offer.index', 'offer.create', 'offer.edit') ? 'background-color: #708090;' : '' }}">
                        <i class="fa fa-thumb-tack"> </i><a class="sidebar-link sidebar-title link-nav"
                            href="{{ route('offer.index') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#stroke-board"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#fill-board"></use>
                            </svg><span>Offer </span></a>
                    </li>
                    <li class="sidebar-list"
                        style="{{ request()->routeIs('page.index', 'page.create', 'page.edit') ? 'background-color: #708090;' : '' }}">
                        <i class="fa fa-thumb-tack"> </i><a class="sidebar-link sidebar-title link-nav"
                            href="{{ route('page.index') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#stroke-board"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#fill-board"></use>
                            </svg><span>Pages </span></a>
                    </li>
                    <li class="sidebar-list"
                        style="{{ request()->routeIs('quick-links.index', 'quick-links.create', 'quick-links.edit') ? 'background-color: #708090;' : '' }}">
                        <i class="fa fa-thumb-tack"> </i><a class="sidebar-link sidebar-title link-nav"
                            href="{{ route('quick-links.index') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#stroke-board"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#fill-board"></use>
                            </svg><span>Quick Links </span></a>
                    </li>
                    <li
                        class="sidebar-list {{ request()->routeIs('service-category.index', 'service-category.create', 'service-category.edit', 'services.index', 'services.create', 'services.edit') ? 'open' : '' }}">
                        <a class="sidebar-link sidebar-title" data-toggle="dropdown">
                            <svg class="stroke-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#stroke-gallery"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#fill-gallery"></use>
                            </svg>
                            <span>Services</span>
                        </a>
                        <ul
                            class="sidebar-submenu {{ request()->routeIs('service-category.index', 'service-category.create', 'service-category.edit', 'services.index', 'services.create', 'services.edit') ? 'd-block' : '' }}">
                            <li><a style="{{ request()->routeIs('service-category.index', 'service-category.create', 'service-category.edit') ? 'background-color: #708090;' : '' }}"
                                    href="{{ route('service-category.index') }}">Services Category </a></li>
                            <li><a style="{{ request()->routeIs('services.index', 'services.create', 'services.edit') ? 'background-color: #708090;' : '' }}"
                                    href="{{ route('services.index') }}">Services</a></li>
                        </ul>
                    </li>
                    <li class="sidebar-list"
                        style="{{ request()->routeIs('settings') ? 'background-color: #708090;' : '' }}"><i
                            class="fa fa-thumb-tack"></i><a class="sidebar-link sidebar-title link-nav"
                            href="{{ route('settings') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#stroke-gallery"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#fill-gallery"></use>
                            </svg><span>Site Settings</span></a>
                    </li>

                    <li class="sidebar-list"
                        style="{{ request()->routeIs('team.index', 'team.create', 'team.edit') ? 'background-color: #708090;' : '' }}">
                        <i class="fa fa-thumb-tack"> </i><a class="sidebar-link sidebar-title link-nav"
                            href="{{ route('team.index') }}">
                            <svg class="stroke-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#stroke-board"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#fill-board"></use>
                            </svg><span>Team </span></a>
                    </li>
                    <li
                        class="sidebar-list {{ request()->routeIs('testimonial-banner.index', 'testimoinal.index', 'testimoinal.create', 'testimoinal.edit') ? 'open' : '' }}">
                        <a class="sidebar-link sidebar-title" data-toggle="dropdown">
                            <svg class="stroke-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#stroke-gallery"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#fill-gallery"></use>
                            </svg>
                            <span>Testimonial</span>
                        </a>
                        <ul
                            class="sidebar-submenu {{ request()->routeIs('testimonial-banner.index', 'testimoinal.index', 'testimoinal.create', 'testimoinal.edit') ? 'd-block' : '' }}">
                            <li><a style="{{ request()->routeIs('testimonial-banner.index') ? 'background-color: #708090;' : '' }}"
                                    href="{{ route('testimonial-banner.index') }}">Testimonial Banner </a></li>
                            <li><a style="{{ request()->routeIs('testimoinal.index', 'testimoinal.create', 'testimoinal.edit') ? 'background-color: #708090;' : '' }}"
                                    href="{{ route('testimoinal.index') }}">Testimonial</a></li>

                        </ul>
                    </li>
                    <li
                        class="sidebar-list {{ request()->routeIs('vision-banner.index', 'vision.index', 'vision.create', 'vision.edit') ? 'open' : '' }}">
                        <a class="sidebar-link sidebar-title" data-toggle="dropdown">
                            <svg class="stroke-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#stroke-gallery"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#fill-gallery"></use>
                            </svg>
                            <span>Vision</span>
                        </a>
                        <ul
                            class="sidebar-submenu {{ request()->routeIs('vision-banner.index', 'vision.index', 'vision.create', 'vision.edit') ? 'd-block' : '' }}">
                            <li><a style="{{ request()->routeIs('vision-banner.index') ? 'background-color: #708090;' : '' }}"
                                    href="{{ route('vision-banner.index') }}">Vision Banner </a></li>
                            <li><a style="{{ request()->routeIs('vision.index', 'vision.create', 'vision.edit') ? 'background-color: #708090;' : '' }}"
                                    href="{{ route('vision.index') }}">Vision</a></li>

                        </ul>
                    </li>
                    <li
                        class="sidebar-list {{ request()->routeIs('why-us-banner.index', 'whyus-detail.index', 'whyus-detail.create', 'whyus-detail.edit') ? 'open' : '' }}">
                        <a class="sidebar-link sidebar-title" data-toggle="dropdown">
                            <svg class="stroke-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#stroke-gallery"></use>
                            </svg>
                            <svg class="fill-icon">
                                <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#fill-gallery"></use>
                            </svg>
                            <span>Why Us</span>
                        </a>
                        <ul
                            class="sidebar-submenu {{ request()->routeIs('why-us-banner.index', 'whyus-detail.index', 'whyus-detail.create', 'whyus-detail.edit') ? 'd-block' : '' }}">
                            <li><a style="{{ request()->routeIs('why-us-banner.index') ? 'background-color: #708090;' : '' }}"
                                    href="{{ route('why-us-banner.index') }}">Why Us Banner </a></li>
                            <li><a style="{{ request()->routeIs('whyus-detail.index', 'whyus-detail.create', 'whyus-detail.edit') ? 'background-color: #708090;' : '' }}"
                                    href="{{ route('whyus-detail.index') }}">Why Us Detail</a></li>

                        </ul>
                    </li>

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
