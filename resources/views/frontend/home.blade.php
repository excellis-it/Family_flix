@extends('frontend.layouts.master')
@section('meta_title')
@endsection
@section('title')
    Home
@endsection
@push('styles')
@endpush

@section('content')
    <section class="banner__slider banner_sec">
        <div class="slider stick-dots">
            <div class="slide">
                <div class="slide__img">
                    <img src="{{ Storage::url($home_cms->top_back_image) }}" alt="" data-lazy="" class="full-image" />
                </div>
                <div class="slide__content slide__content__left">
                    <div class="slide__content--headings text-left">
                        <div class="bnr-text-p">
                            <p>{{ $home_cms->top_short_title }}</p>
                        </div>
                        <h2 class="title">
                            <!-- <span>Welcome to</span> -->
                            {{ $home_cms->top_main_title }}
                        </h2>
                        <div class="sign-up-btn mt-4">
                            <a href="">{{ $home_cms->top_button_text }}</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="vdo-img">
            <img src="{{ Storage::url($home_cms->section1_main_image) }}" alt="" />
        </div>
    </section>
    <section class="access-sec">
        <div class="access-bg-img">
            <img src="{{ Storage::url($home_cms->section1_back_image) }}" alt="" />
        </div>
        <div class="container">
            <div class="access-div">
                <div class="access-div-wrap">
                    <div class="row justify-content-center">
                        <div class="col-xl-3 col-md-6">
                            <div class="access-div-img-wrap">
                                <div class="access-div-img">
                                    <img src="{{ asset('frontend_assets/images/access.png') }}" alt="" />
                                </div>
                                <div class="access-div-text">
                                    <h4>Unlimited Access</h4>
                                    <p>
                                        Dive into a vast library of movies, TV series, and
                                        exclusive content.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="access-div-img-wrap">
                                <div class="access-div-img">
                                    <img src="{{ asset('frontend_assets/images/savings.png') }}" alt="" />
                                </div>
                                <div class="access-div-text">
                                    <h4>Savings Simplified</h4>
                                    <p>
                                        Affordable plans that eliminate the need for multiple
                                        subscriptions.
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-6">
                            <div class="access-div-img-wrap">
                                <div class="access-div-img">
                                    <img src="{{ asset('frontend_assets/images/watch.png') }}" alt="" />
                                </div>
                                <div class="access-div-text">
                                    <h4>Watch Anywhere, Anytime</h4>
                                    <p>
                                        Enjoy your favorites on your terms - mobile, desktop, or
                                        TV.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="one-place">
        <div class="one-place-img text-end">
            <img src="{{ Storage::url($home_cms->section2_main_image) }}" alt="" />
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-6">
                        <div class="one-place-div">
                            <div class="one-place-text">
                                <div class="heading-white">
                                    <h2>
                                        {{ $home_cms->section2_title }}
                                    </h2>
                                    <p>
                                        {{ $home_cms->section2_description }}
                                    </p>
                                    <div class="">
                                        <a href="" class="view-btn">{{ $home_cms->section2_short_title }}<span><i
                                                    class="fa-solid fa-arrow-right"></i></span></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="one-place-circle">
                            <div data-elementor-type="wp-page" data-elementor-id="10" class="elementor elementor-10">
                                <div class="elementor-element elementor-element-3d96d24 e-con-full elementor-hidden-mobile e-flex e-con e-parent"
                                    data-id="3d96d24" data-element_type="container" data-settings='{"content_width":"full"}'
                                    data-core-v316-plus="true">
                                    <div class="elementor-element elementor-element-94008c1 e-con-full elementor-hidden-mobile e-flex e-con e-child"
                                        data-id="94008c1" data-element_type="container"
                                        data-settings='{"content_width":"full","background_background":"classic"}'>
                                        <div class="elementor-element elementor-element-9907f7f elementor-widget elementor-widget-eael-interactive-circle"
                                            data-id="9907f7f" data-element_type="widget"
                                            data-widget_type="eael-interactive-circle.default">
                                            <div class="elementor-widget-container">
                                                <div id="eael-interactive-circle-9907f7f" class="eael-interactive-circle"
                                                    data-tabid="9907f7f">
                                                    <div class="eael-circle-wrapper eael-interactive-circle-preset-1 eael-interactive-circle-event-hover eael-circle-responsive-view eael-interactive-circle-animation-3"
                                                        data-animation="eael-interactive-circle-animation-3"
                                                        data-autoplay="0" data-autoplay-interval="2000">
                                                        <div class="eael-circle-info" data-items="8">
                                                            <div class="eael-circle-inner">
                                                                <div
                                                                    class="eael-circle-item elementor-repeater-item-c5a3e9d">
                                                                    <div class="eael-circle-btn" id="eael-circle-item-1">
                                                                        <div class="eael-circle-icon-shapes classic">
                                                                            <div class="eael-shape-1"></div>
                                                                            <div class="eael-shape-2"></div>
                                                                        </div>
                                                                        <div class="eael-circle-btn-icon classic">
                                                                            <div class="eael-circle-icon-inner">
                                                                                <img
                                                                                    src="{{ asset('frontend_assets/images/circle-1.png') }}" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="eael-circle-btn-content eael-circle-item-1">
                                                                        <div class="eael-circle-content">
                                                                            <img decoding="async" style="width: 200px"
                                                                                src="{{ asset('frontend_assets/images/circle-center.png') }}"
                                                                                alt="Logo" />
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div
                                                                    class="eael-circle-item elementor-repeater-item-4538903">
                                                                    <div class="eael-circle-btn" id="eael-circle-item-2">
                                                                        <div class="eael-circle-icon-shapes">
                                                                            <div class="eael-shape-1"></div>
                                                                            <div class="eael-shape-2"></div>
                                                                        </div>
                                                                        <div class="eael-circle-btn-icon">
                                                                            <div class="eael-circle-icon-inner">
                                                                                <img
                                                                                    src="{{ asset('frontend_assets/images/circle-2.png') }}" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="eael-circle-btn-content eael-circle-item-2">
                                                                        <div class="eael-circle-content">
                                                                            <img decoding="async" style="width: 200px"
                                                                                src="{{ asset('frontend_assets/images/circle-center.png') }}"
                                                                                alt="Logo" />
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div
                                                                    class="eael-circle-item elementor-repeater-item-717273e">
                                                                    <div class="eael-circle-btn" id="eael-circle-item-3">
                                                                        <div class="eael-circle-icon-shapes">
                                                                            <div class="eael-shape-1"></div>
                                                                            <div class="eael-shape-2"></div>
                                                                        </div>
                                                                        <div class="eael-circle-btn-icon">
                                                                            <div class="eael-circle-icon-inner">
                                                                                <img
                                                                                    src="{{ asset('frontend_assets/images/circle-3.png') }}" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="eael-circle-btn-content eael-circle-item-3">
                                                                        <div class="eael-circle-content">
                                                                            <img decoding="async" style="width: 200px"
                                                                                src="{{ asset('frontend_assets/images/circle-center.png') }}"
                                                                                alt="Logo" />
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div
                                                                    class="eael-circle-item elementor-repeater-item-d3c427c">
                                                                    <div class="eael-circle-btn" id="eael-circle-item-4">
                                                                        <div class="eael-circle-icon-shapes">
                                                                            <div class="eael-shape-1"></div>
                                                                            <div class="eael-shape-2"></div>
                                                                        </div>
                                                                        <div class="eael-circle-btn-icon">
                                                                            <div class="eael-circle-icon-inner">
                                                                                <img
                                                                                    src="{{ asset('frontend_assets/images/circle-4.png') }}" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="eael-circle-btn-content eael-circle-item-4">
                                                                        <div class="eael-circle-content">
                                                                            <img decoding="async" style="width: 200px"
                                                                                src="{{ asset('frontend_assets/images/circle-center.png') }}"
                                                                                alt="Logo" />
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div
                                                                    class="eael-circle-item elementor-repeater-item-219c450">
                                                                    <div class="eael-circle-btn" id="eael-circle-item-5">
                                                                        <div class="eael-circle-icon-shapes">
                                                                            <div class="eael-shape-1"></div>
                                                                            <div class="eael-shape-2"></div>
                                                                        </div>
                                                                        <div class="eael-circle-btn-icon">
                                                                            <div class="eael-circle-icon-inner">
                                                                                <img
                                                                                    src="{{ asset('frontend_assets/images/circle-5.png') }}" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="eael-circle-btn-content eael-circle-item-5">
                                                                        <div class="eael-circle-content">
                                                                            <img decoding="async" style="width: 200px"
                                                                                src="{{ asset('frontend_assets/images/circle-center.png') }}"
                                                                                alt="Logo" />
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div
                                                                    class="eael-circle-item elementor-repeater-item-a8a43b0">
                                                                    <div class="eael-circle-btn" id="eael-circle-item-6">
                                                                        <div class="eael-circle-icon-shapes">
                                                                            <div class="eael-shape-1"></div>
                                                                            <div class="eael-shape-2"></div>
                                                                        </div>
                                                                        <div class="eael-circle-btn-icon">
                                                                            <div class="eael-circle-icon-inner">
                                                                                <img
                                                                                    src="{{ asset('frontend_assets/images/circle-6.png') }}" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="eael-circle-btn-content eael-circle-item-6">
                                                                        <div class="eael-circle-content">
                                                                            <img decoding="async" style="width: 200px"
                                                                                src="{{ asset('frontend_assets/images/circle-center.png') }}"
                                                                                alt="Logo" />
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div
                                                                    class="eael-circle-item elementor-repeater-item-986bd8f">
                                                                    <div class="eael-circle-btn active"
                                                                        id="eael-circle-item-7">
                                                                        <div class="eael-circle-icon-shapes">
                                                                            <div class="eael-shape-1"></div>
                                                                            <div class="eael-shape-2"></div>
                                                                        </div>
                                                                        <div class="eael-circle-btn-icon">
                                                                            <div class="eael-circle-icon-inner">
                                                                                <img
                                                                                    src="{{ asset('frontend_assets/images/circle-7.png') }}" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="eael-circle-btn-content eael-circle-item-7 active">
                                                                        <div class="eael-circle-content">
                                                                            <img decoding="async" style="width: 200px"
                                                                                src="{{ asset('frontend_assets/images/circle-center.png') }}"
                                                                                alt="Logo" />
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div
                                                                    class="eael-circle-item elementor-repeater-item-840bcb6">
                                                                    <div class="eael-circle-btn" id="eael-circle-item-8">
                                                                        <div class="eael-circle-icon-shapes">
                                                                            <div class="eael-shape-1"></div>
                                                                            <div class="eael-shape-2"></div>
                                                                        </div>
                                                                        <div class="eael-circle-btn-icon">
                                                                            <div class="eael-circle-icon-inner">
                                                                                <img
                                                                                    src="{{ asset('frontend_assets/images/circle-8.png') }}" />
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        class="eael-circle-btn-content eael-circle-item-8">
                                                                        <div class="eael-circle-content">
                                                                            <img decoding="async" style="width: 200px"
                                                                                src="{{ asset('frontend_assets/images/circle-center.png') }}"
                                                                                alt="Logo" />
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="entertainment-sec">
        <div class="entertainment-bg">
            <img src="{{ Storage::url($home_cms->section2_back_image) }}" alt="" />
        </div>
        <div class="entertainment-div">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="entertainment-head">
                            <div class="heading-1 text-center">
                                <h2>Entertainment Everywhere<span class="dot">.</span></h2>
                                <p>
                                    Enjoy The Family Flix app on your TV, mobile, and tablet.
                                    Our platform supports all your devices. Anywhere, Any
                                    Device: The Family Flix Advantage
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="entertainment-img-div">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-lg-3 col-md-6">
                            <div class="entertainment-img-wrap">
                                <div class="entertainment-img">
                                    <img src="{{ asset('frontend_assets/images/en-1.png') }}" alt="" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="entertainment-img-wrap">
                                <div class="entertainment-img">
                                    <img src="{{ asset('frontend_assets/images/en-2.png') }}" alt="" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="entertainment-img-wrap">
                                <div class="entertainment-img">
                                    <img src="{{ asset('frontend_assets/images/en-3.png') }}" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="entertainment-img-div entertainment-img-div-text">
                    <div class="row justify-content-center align-items-center">
                        <div class="col-lg-3 col-md-6">
                            <div class="entertainment-img-wrap">
                                <div class="entertainment-img-text">
                                    <h4>On Your TV</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="entertainment-img-wrap">
                                <div class="entertainment-img-text">
                                    <h4>Mobiles & Tablets</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="entertainment-img-wrap">
                                <div class="entertainment-img-text">
                                    <h4>On Firestick & Firecube</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="works-sec">
        <div class="works-sec-bg">
            <img src="{{ asset('frontend_assets/images/work-bg.png') }}" alt="" />
        </div>
        <div class="works-div-wrap">
            <div class="container">
                <div class="row justify-content-center align-items-end">
                    <div class="col-lg-9">
                        <div class="works-div-img">
                            <div class="entertainment-head">
                                <div class="heading-1 heading-white mb-5">
                                    <h2>{{ $home_cms->section3_title }}<span class="dot">.</span></h2>
                                </div>
                            </div>
                            <img src="{{ Storage::url($home_cms->section3_main_image) }}" alt="" />
                            <div class="play-btn">
                                <a href="{{ $home_cms->section3_video_link }}"><i class="fa-solid fa-play"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="unbeatable-sec">
        <div class="unbeatable-bg">
            <img src="{{ Storage::url($home_cms->section4_back_image) }}" alt="" />
        </div>
        <div class="entertainment-div">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="entertainment-head">
                            <div class="heading-1 text-center">
                                <h2>{{ $home_cms->section4_title }}<span class="dot">.</span></h2>
                                <p>
                                    {{ $home_cms->section4_description }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="unbeatable-slider">
            <div class="unbeatable-slider-wrap">
                <div class="unbeatable-slider-div">
                    <div class="unbeatable-slider-img">
                        <img src="{{ asset('frontend_assets/images/unbeatable-1.png') }}" alt="" />
                    </div>
                </div>
            </div>
            <div class="unbeatable-slider-wrap">
                <div class="unbeatable-slider-div">
                    <div class="unbeatable-slider-img">
                        <img src="{{ asset('frontend_assets/images/unbeatable-2.png') }}" alt="" />
                    </div>
                </div>
            </div>
            <div class="unbeatable-slider-wrap">
                <div class="unbeatable-slider-div">
                    <div class="unbeatable-slider-img">
                        <img src="{{ asset('frontend_assets/images/unbeatable-3.png') }}" alt="" />
                    </div>
                </div>
            </div>
            <div class="unbeatable-slider-wrap">
                <div class="unbeatable-slider-div">
                    <div class="unbeatable-slider-img">
                        <img src="{{ asset('frontend_assets/images/unbeatable-4.png') }}" alt="" />
                    </div>
                </div>
            </div>
            <div class="unbeatable-slider-wrap">
                <div class="unbeatable-slider-div">
                    <div class="unbeatable-slider-img">
                        <img src="{{ asset('frontend_assets/images/unbeatable-5.png') }}" alt="" />
                    </div>
                </div>
            </div>
            <div class="unbeatable-slider-wrap">
                <div class="unbeatable-slider-div">
                    <div class="unbeatable-slider-img">
                        <img src="{{ asset('frontend_assets/images/unbeatable-6.png') }}" alt="" />
                    </div>
                </div>
            </div>
            <div class="unbeatable-slider-wrap">
                <div class="unbeatable-slider-div">
                    <div class="unbeatable-slider-img">
                        <img src="{{ asset('frontend_assets/images/unbeatable-7.png') }}" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="kids-sec">
        <div class="kid-bg">
            <img src="{{ asset('frontend_assets/images/kids-bg.png') }}" alt="" />
        </div>
        <div class="kids-div">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="row justify-content-center">
                            <div class="col-lg-6">
                                <div class="entertainment-head">
                                    <div class="heading-1">
                                        <h2>{{ $home_cms->section5_main_title }}<span class="dot">.</span></h2>
                                        <p>
                                            {{ $home_cms->section5_main_description }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="kid-tv-img">
                                    <img src="{{ asset('frontend_assets/images/kids-tv.png') }}" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pricing-sec">
        <div class="pricing-bg">
            <img src="{{ Storage::url($home_cms->plan_section_back_image) }}" alt="" />
        </div>
        <div class="container">
            <div class="pricing-sec-wrap">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="entertainment-head">
                            <div class="heading-1 heading-white text-center">
                                <h2>{{ $home_cms->plan_section_title }}<span class="dot">.</span></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pricing-div">
                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="row justify-content-center">
                           
                            @foreach($plans as $plan)
                            <div class="col-lg-3 col-md-6">
                                <div class="pricing-div-box">
                                    <h4>{{ $plan->plan_name }}</h4>
                                    <p>
                                        {{ $plan->plan_details }}
                                    </p>
                                    <div class="pricing-rate d-flex justify-content-center mb-4">
                                        <h4>${{ $plan->plan_actual_price }}</h4>
                                        <h3>${{ $plan->plan_offer_price }}</h3>
                                    </div>
                                    <div class="sub-btn">
                                        <a href="">{{ $plan->button_text }}</a>
                                    </div>
                                    <div class="pricing-list">
                                        <ul>
                                            @foreach($plan->Specification as $specification)
                                            <li>
                                                <span><i class="fa-solid fa-check"></i></span>{{ $specification->specification_name }}
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            {{-- <div class="col-lg-3 col-md-6">
                                <div class="pricing-div-box">
                                    <h4>Professional</h4>
                                    <p>
                                        Our Professional pack is perfect for families to enjoy
                                        the best entertainment there is
                                    </p>
                                    <div class="pricing-rate d-flex justify-content-center mb-md-4">
                                        <h4>$23.00</h4>
                                        <h3>$18.99</h3>
                                    </div>
                                    <div class="sub-btn">
                                        <a href="">Subscribe</a>
                                    </div>
                                    <div class="pricing-list">
                                        <ul>
                                            <li>
                                                <span><i class="fa-solid fa-check"></i></span>1 - 2
                                                Device Limit
                                            </li>
                                            <li>
                                                <span><i class="fa-solid fa-check"></i></span>Premium Server
                                            </li>
                                            <li>
                                                <span><i class="fa-solid fa-check"></i></span>Full
                                                HD Available
                                            </li>
                                            <li>
                                                <span><i class="fa-solid fa-check"></i></span>Desktop, Mobile & TV App
                                            </li>
                                            <li>
                                                <span><i class="fa-solid fa-check"></i></span>Unlimited Movies & TV Show
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="pricing-div-box">
                                    <h4>Executive</h4>
                                    <p>
                                        Avail our executive plan for best value deals for
                                        maximum number of devices
                                    </p>
                                    <div class="pricing-rate d-flex justify-content-center mb-md-4">
                                        <h4>$23.00</h4>
                                        <h3>$18.99</h3>
                                    </div>
                                    <div class="sub-btn">
                                        <a href="">Subscribe</a>
                                    </div>
                                    <div class="pricing-list">
                                        <ul>
                                            <li>
                                                <span><i class="fa-solid fa-check"></i></span>1 - 2
                                                Device Limit
                                            </li>
                                            <li>
                                                <span><i class="fa-solid fa-check"></i></span>Premium Server
                                            </li>
                                            <li>
                                                <span><i class="fa-solid fa-check"></i></span>Full
                                                HD Available
                                            </li>
                                            <li>
                                                <span><i class="fa-solid fa-check"></i></span>Desktop, Mobile & TV App
                                            </li>
                                            <li>
                                                <span><i class="fa-solid fa-check"></i></span>Unlimited Movies & TV Show
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="subscribe-sec">
        <div class="container">
            <div class="subscribe-sec-wrap">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="subscribe-head">
                            <h2>Subscribe For Updates.</h2>
                        </div>
                        <div class="subscribe-line"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="scroll-top">
        <a id="scroll-top-btn"></a>
    </div>
@endsection
