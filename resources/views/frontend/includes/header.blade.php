<div class="main_menu_hdr">
    <div class="container">
        <div class="main_menu">
            <div class="navigation navbar">
                <div class="hdr-top">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-sm-3 p-0">
                            <div class="left_top">
                                <div class="logo">
                                    <a href="{{ route('home') }}" class="">
                                        <img src="{{ asset('frontend_assets/images/logo-white.png') }}"
                                            alt="" />
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-6 col-xl-6 col-sm-2 p-0 order-xl-2 order-3">
                            <div class="hdr-btm">
                                <div class="right_top order-xl-2 order-lg-3">
                                    <div class="right_btm">
                                        <div id="cssmenu">
                                            <ul>
                                                <li class="{{ request()->routeIs('home') ? 'active' : '' }}">
                                                    <a href="{{ route('home') }}"> Home </a>
                                                </li>
                                                <li class="{{ request()->routeIs('shows') ? 'active' : '' }}">
                                                    <a href="{{ route('shows') }}">Shows</a>
                                                        <!-- <ul>
                                <li class="sub-act"><a href="#">About Us </a></li>
                                <li><a href="#">About Us</a></li>
                            </ul> -->
                                                </li>
                                                <li class="{{ request()->routeIs('movies') ? 'active' : '' }}">
                                                    <a href="{{ route('movies') }}">Movies</a>
                                                </li>
                                                <li class="{{ request()->routeIs('kids') ? 'active' : '' }}">
                                                    <a href="{{ route('kids') }}">Kids</a>
                                                </li>
                                                <li class="{{ request()->routeIs('pricing') ? 'active' : '' }}">
                                                    <a href="{{ route('pricing') }}">Pricing</a>
                                                </li>
                                                <li class="{{ request()->routeIs('about') ? 'active' : '' }}">
                                                    <a href="{{ route('about') }}">About Us</a>
                                                </li>
                                                <li class="{{ request()->routeIs('contact-us') ? 'active' : '' }}">
                                                    <a href="{{ route('contact-us') }}"> Contact</a>
                                                </li>
                                                @if (Auth::check() && Auth::user()->hasRole('CUSTOMER'))
                                                <li class="{{ request()->routeIs('customer') ? 'active' : '' }}">
                                                    <a href="{{ route('customer.subscription') }}"> Customer Dashboard</a>
                                                @else
                                                <li class="{{ request()->routeIs('customer') ? 'active' : '' }}">
                                                    <a href="{{ route('customer.login') }}"> Customer Login</a>
                                                </li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-3 col-xl-3 col-sm-5 order-xl-3 order-2">
                            <div class="sign-up-btn main-signup">
                                @if (Auth::check() && Auth::user()->hasRole('AFFLIATE MARKETER'))
                                    <a href="{{ route('affiliate-marketer.dashboard') }}">Dashboard</a>
                                @else
                                    <a href="{{ route('affiliate-marketer.login') }}">Affiliate Login</a>
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
