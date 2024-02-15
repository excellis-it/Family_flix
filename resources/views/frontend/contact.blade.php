@extends('frontend.layouts.master')
@section('meta_title')
@endsection
@section('title')
    Contact
@endsection
@push('styles')
@endpush

@section('content')
    <section class="inner_banner_sec"
        style="
  background-image: url({{ asset('frontend_assets/images/contact-bg.png') }});
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner_banner_ontent">
                        <h1>Contact</h1>
                        <div class="links-1">
                            <ul>
                                <li><a href="">Home</a></li>
                                <li><a href="">Contact</a></li>
                            </ul>
                        </div>
                        <div class="inr-text">
                            <p></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="contact-sec">
        <div class="contact-bg">
            <img src="{{ asset('frontend_assets/images/con-sec.png') }}" alt="" />
        </div>
        <div class="container">
            <div class="contact-sec-wrap">
                <div class="row justify-content-center">
                    <div class="col-lg-4">
                        <div class="heading-white">
                            <h3>Connect With Us</h3>
                            <p>
                                To learn more about how Streamit can help you, contact us.
                            </p>
                            <div class="sign-up-btn mt-4">
                                <a href="" tabindex="0">Contact Us</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="cont-right">
                            <div class="heading-white mb-4">
                                <h3>Get In Touch</h3>
                            </div>
                            <div class="find-us">
                                <div class="add d-flex">
                                    <div class="add-icon">
                                        <span><i class="fa-solid fa-phone"></i></span>
                                    </div>
                                    <div class="add-text">
                                        <h4>Call Us</h4>
                                        <a href="">+18453297101</a>
                                    </div>
                                </div>
                                <div class="add d-flex">
                                    <div class="add-icon">
                                        <span><i class="fa-solid fa-envelope"></i></span>
                                    </div>
                                    <div class="add-text">
                                        <h4>Email Us</h4>
                                        <a href="">support@thefamilyflix.com</a>
                                    </div>
                                </div>
                                <div class="add d-flex">
                                    <div class="add-icon">
                                        <span><i class="fa-solid fa-location-dot"></i></span>
                                    </div>
                                    <div class="add-text">
                                        <h4>Location</h4>
                                        <p>Orlando Florida</p>
                                    </div>
                                </div>
                                <div class="add d-flex">
                                    <div class="add-icon">
                                        <span><i class="fa-regular fa-clock"></i></span>
                                    </div>
                                    <div class="add-text">
                                        <h4>Office Hours (Closed Saturday)</h4>
                                        <p>9am-11pm</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="follow-sec">
                            <div class="add">
                                <div class="add-text">
                                    <p>Follow Us</p>
                                </div>
                                <div class="folow-icon d-flex">
                                    <span><i class="fa-brands fa-facebook"></i></span>
                                    <span><i class="fa-brands fa-instagram"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="map-sec">
        <iframe loading="lazy"
            src="https://maps.google.com/maps?q=Orlando%2C%20Florida&amp;t=m&amp;z=15&amp;output=embed&amp;iwloc=near"
            title="Orlando, Florida" aria-label="Orlando, Florida" width="100%" height="450px"></iframe>
    </section>
@endsection
