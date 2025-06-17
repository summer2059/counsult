<div class="header-wrapper col m-0">
    <div class="row">

        <div class="header-logo-wrapper col-auto p-0">
            <div class="logo-wrapper"><a href="index.html"><a class="navbar-brand mr-0" href="/"><img src="#"
            alt="" class="img-fluid"></a> alt=""></a></div>
            <div class="toggle-sidebar">
                <svg class="stroke-icon sidebar-toggle status_toggle middle">
                    <use href="{{ asset('dashboard/assets/svg/icon-sprite.svg') }}#toggle-icon"></use>
                </svg>
            </div>
        </div>
        <div class="nav-right col-xxl-8 col-xl-6 col-md-7 col-8 pull-right right-header p-0 ms-auto">
            <ul class="nav-menus">
                <li class="cart-nav onhover-dropdown">


                </li>
                <li class="profile-nav onhover-dropdown px-0 py-0">
                    <div class="d-flex profile-media align-items-center"><img class="img-30"
                            src="{{ asset('dashboard/assets/images/dashboard/profile.png') }}" alt="">
                        <div class="flex-grow-1"><span>{{ Auth::user()->name }}</span>
                            <p class="mb-0 font-outfit">Admin<i class="fa fa-angle-down"></i></p>
                        </div>
                    </div>
                    <ul class="profile-dropdown onhover-show-div">
                        <li><a href="{{ route('update-account') }}"><i data-feather="user"></i><span>Account </span></a>
                        </li>
                        {{-- <li><a href="#"><i data-feather="key"></i><span>Change Password</span></a></li> --}}
                        <li>
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" style="border: none; background: none; cursor: pointer;">
                                    <i data-feather="log-out"></i>
                                    <span>Log out</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>


    </div>
</div>
