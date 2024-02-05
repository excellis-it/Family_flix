@php 
$email_us = \App\Models\EmailUs::first();
use App\Helpers\Pricing;
use App\Helpers\General;
@endphp

<footer class="footer position-relative">
    <div class="footer-wrapper">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 offset-lg-0 col-md-8 offset-md-2 col-10 offset-1">
                    <div class="footer-row">
                        <div class="footer-detail">
                            <a href="#">
                                <img src="{{ asset('frontend_assets/assets/images/logo.png')}}" alt="footer-logo">
                            </a>
                            <p>&nbsp;</p>
                            <ul class="social">
                                @php
                                $socials = \App\Models\FooterCms::all();
                                @endphp

                                @foreach($socials  as $social)
                                <li>
                                    <a class="button button-blue" href="{{ $social->social_link }}" target="_blank" >
                                        <span>
                                            <i class="{{ $social->social_icon }}"></i>
                                        </span>
                                    </a>
                                </li>
                                @endforeach
                                {{-- <li>
                                    <a class="button button-blue" href="#">
                                        <span>
                                            <i class="fab fa-twitter"></i>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a class="button button-green" href="#">
                                        <span>
                                            <i class="fab fa-linkedin-in"></i>
                                        </span>
                                    </a>
                                </li>
                                <li>
                                    <a class="button button-red" href="#">
                                        <span>
                                            <i class="fab fa-youtube"></i>
                                        </span>
                                    </a>
                                </li> --}}
                            </ul>
                        </div>
                        <div class="footer-list">
                            <h6>COMPANY</h6>
                            <ul>
                                <li>
                                    <a href="{{ route('about') }}" class="link-underline">
                                        <span>About Us</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('career') }}" class="link-underline">
                                        <span>Careers</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('our.work') }}" class="link-underline">
                                        <span>Our Work</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('pricing') }}" class="link-underline">
                                        <span>Pricing</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('help-center') }}" class="link-underline">
                                        <span>Help Center</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('privacy') }}" class="link-underline">
                                        <span>Privacy Policy</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="javascript:void(0);" id="news-letter" class="link-underline">
                                        <span>Newsletter</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="footer-list">
                            <h6>RESOURCES</h6>
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
                                        <span>Blog</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('case-studies') }}" class="link-underline">
                                        <span>Case Studies</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('terms') }}" class="link-underline">
                                        <span>Term & Condition</span>
                                    </a>
                                </li>
                                
                            </ul>
                        </div>
                        <div class="footer-list">
                            <h6>EMAIL US</h6>
                            <ul>
                                <li>
                                    <a href="mailto:{{ $email_us->email}}" class="link-underline">
                                        <span>{{ $email_us->email }}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 offset-lg-0 col-md-8 offset-md-2 col-10 offset-1">
                    <div class="footer-copyright c-grey">
                        <h6>{{ General::GeneralCmsContent()->copyright_title }}</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="box-1 bg-yellow">
            <div class="box-2">
                <a href="#" class="button button-blue button-top">
                    <span>
                        <i class="fas fa-arrow-up"></i>
                    </span>
                </a>
            </div>
        </div>
    </div>
</footer>


<!-- footer - end -->

