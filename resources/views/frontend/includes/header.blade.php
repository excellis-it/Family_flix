@php
use App\Helpers\Pricing;
use App\Helpers\Subscribing;
@endphp 

    <!-- preloader - start -->
    <!--<div class="preloader">
        <div class='sk-folding-cube'>
            <div class='sk-cube sk-cube-1 bg-red'></div>
            <div class='sk-cube sk-cube-2 bg-green'></div>
            <div class='sk-cube sk-cube-4 bg-yellow'></div>
            <div class='sk-cube sk-cube-3 bg-purple'></div>
        </div>
    </div>-->
    <!-- preloader - end -->

    <!-- navigation - start -->
    <div class="navigation">
        <div class="navigation-wrapper">
            <div class="container-fluid">
                <div class="navigation-inner">
                    <div class="navigation-logo">
                        <a href="{{ route('home') }}">
                            <img src="{{ asset('frontend_assets/assets/images/logo.png')}}" alt="orions-logo">
                        </a>
                    </div>
                    <div class="navigation-menu">
                        <div class="mobile-header">
                            <div class="logo">
                                <a href="index.html">
                                    <!-- <img src="assets/images/logo-white.png" alt="image"> -->
                                </a>
                            </div>
                            <ul>
                                <li class="close-button">
                                    <i class="fas fa-times"></i>
                                </li>
                            </ul>
                        </div>
                        <ul class="parent">
                            <li>
                                <a href="{{ route('home') }}" class="link-underline link-underline-1">
                                    <span>Home</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('perks') }}" class="link-underline link-underline-1">
                                    <span>Perks</span>
                                </a>
                            </li>
                            {{-- <li class="has-child">
                                <a href="#" class="link-underline link-underline-1">
                                    <span>Features</span>
                                </a>
                                <div class="child">
                                    <ul>
                                        <li>
                                            <a href="{{ route('social.media.design') }}" class="link-underline">
                                                <span>Social Media Design</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('website.design') }}" class="link-underline">
                                                <span>Website Design</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('illustration.design') }}" class="link-underline">
                                                <span>illustration design</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('presentation.design') }}" class="link-underline">
                                                <span>Presentation Design</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li> --}}
                            <li>
                                <a href="{{ route('services') }}" class="link-underline link-underline-1">
                                    <span>Services</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{ route('our.work') }}" class="link-underline link-underline-1">
                                    <span>Our Work</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('pricing') }}" class="link-underline link-underline-1">
                                    <span>Pricing</span>
                                </a>
                            </li>
                            {{-- <li>
                                <a href="{{ route('blogs') }}" class="link-underline link-underline-1">
                                    <span>Blog</span>
                                </a>

                            </li> --}}
                            <li>
                                <a href="{{route('faq')}}" class="link-underline link-underline-1">
                                    <span>FAQ</span>
                                </a>

                            </li> 

                            

                            {{-- <li class="has-child">
                                <a href="" class="link-underline link-underline-1">
                                    <span>Resources</span>
                                </a>
                                <div class="child">
                                    <ul>
                                        <li>
                                            <a href="{{ route('free-illustration') }}" class="link-underline">
                                                <span>Free Illustrations</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('free-icons') }}" class="link-underline">
                                                <span>Free Icons</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('guides') }}" class="link-underline">
                                                <span>Guides</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('blogs') }}" class="link-underline">
                                                <span>Design blog</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('case-studies') }}" class="link-underline">
                                                <span>Case Studies</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li> --}}
                            <li>
                                
                                @if(Auth::check() && Auth::user()->hasRole('CUSTOMER'))
                                    @if(Pricing::SubscriptionCheck() == true)
                                    <a href="{{ route('user.dashboard') }}" class="link-underline link-underline-1">
                                        <span>Dashboard</span>
                                    </a>
                                    @else
                                    <a href="{{ route('logout') }}" class="link-underline link-underline-1">
                                        <span>Logout</span>
                                    </a>
                                    @endif
                                @elseif(Auth::check() && Auth::user()->hasRole('ADMIN'))
                                <a href="{{ route('admin.dashboard') }}" class="link-underline link-underline-1">
                                    <span>Dashboard</span>
                                </a>
                                @else
                                <a href="{{ route('login') }}" class="link-underline link-underline-1">
                                    <span>Sign In</span>
                                </a>
                                @endif
                                
                            </li>
                            
                        </ul>
                        
                        <div class="social">
                            <h5>Follow</h5>
                            <ul>
                                <li>
                                    <a href="#" class="c-dark button button-purple">
                                        <span>
                                            <i class="fab fa-facebook-f"></i>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="c-dark button button-blue">
                                        <span>
                                            <i class="fab fa-twitter"></i>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="c-dark button button-green">
                                        <span>
                                            <i class="fab fa-linkedin-in"></i>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" class="c-dark button button-red">
                                        <span>
                                            <i class="fab fa-youtube"></i>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <ul class="parent new-menu-cls">
                        <li>
                                <a href="{{ route('login') }}" class="button button-red button-navigation">
                                    <span>Get Started</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ Subscribing::BookACall()->link }}" target="_blank"  class="button button-blue button-navigation">
                                    <span>Book a Call</span>
                                </a>
                            </li>
                        </ul>
                    <div class="navigation-bar">
                        <div></div>
                        <div></div>
                        <div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
