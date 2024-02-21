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
                    @include('frontend.partials.top_grid')
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

                                                            <div class="eael-circle-btn-content">
                                                                <div class="eael-circle-content">
                                                                    <img decoding="async" style="width: 200px"
                                                                        src="{{ Storage::url($home_cms->section2_main_icon) }}"
                                                                        alt="Logo" />
                                                                </div>
                                                            </div>
                                                            @foreach($ott_icons as $index => $ott_icon)
                                                            <div class="eael-circle-inner">
                                                                <div class="eael-circle-item elementor-repeater-item-c5a3e9d">
                                                                    <div class="eael-circle-btn" id="eael-circle-item-{{ $ott_icon->id }}">
                                                                        <div class="eael-circle-icon-shapes classic">
                                                                            <div class="eael-shape-1"></div>
                                                                            <div class="eael-shape-2"></div>
                                                                        </div>
                                                                        <div class="eael-circle-btn-icon">
                                                                            <div class="eael-circle-icon-inner">
                                                                                <img
                                                                                    src="{{ Storage::url($ott_icon->icon) }}" />
                                                                            </div>
                                                                        </div>
                                                                    </div>                                                             
                                                                </div>

                                                                @endforeach
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
            @include('frontend.partials.entertainment');
           
        </div>
    </section>
    <section class="works-sec">
        <div class="works-sec-bg">
            <img src="{{ Storage::url($home_cms->section3_back_image) }}" alt="" />
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
                                <button type="button" class="play-btn" data-bs-toggle="modal" data-src="https://excellis.co.in/demo/five-star-chem-dry/dev/wp-content/uploads/2023/07/Carpet_upholstery_30_06-2.mp4" data-bs-target="#myModal"><span><i class="fa-solid fa-play"></i></span></button>
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
                        <img src="https://www.excellis.co.in/demo/the_family_flix/html/assets/images/unbeatable-2.png" alt="" />
                    </div>
                </div>
            </div>
            <div class="unbeatable-slider-wrap">
                <div class="unbeatable-slider-div">
                    <div class="unbeatable-slider-img">
                        <img src="https://www.excellis.co.in/demo/the_family_flix/html/assets/images/unbeatable-4.png" alt="" />
                    </div>
                </div>
            </div>
            <div class="unbeatable-slider-wrap">
                <div class="unbeatable-slider-div">
                    <div class="unbeatable-slider-img">
                        <img src="https://www.excellis.co.in/demo/the_family_flix/html/assets/images/unbeatable-5.png" alt="" />
                    </div>
                </div>
            </div>
            <div class="unbeatable-slider-wrap">
                <div class="unbeatable-slider-div">
                    <div class="unbeatable-slider-img">
                        <img src="https://www.excellis.co.in/demo/the_family_flix/html/assets/images/unbeatable-6.png" alt="" />
                    </div>
                </div>
            </div>
            <div class="unbeatable-slider-wrap">
                <div class="unbeatable-slider-div">
                    <div class="unbeatable-slider-img">
                        <img src="https://www.excellis.co.in/demo/the_family_flix/html/assets/images/unbeatable-7.png" alt="" />
                    </div>
                </div>
            </div>
            <div class="unbeatable-slider-wrap">
                <div class="unbeatable-slider-div">
                    <div class="unbeatable-slider-img">
                        <img src="https://www.excellis.co.in/demo/the_family_flix/html/assets/images/unbeatable-8.png" alt="" />
                    </div>
                </div>
            </div> 
        </div>
    </section>
    <section class="kids-sec">
        <div class="kid-bg">
            <img src="{{ Storage::url($home_cms->section5_back_image) }}" alt="" />
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
                                    <img src="{{ Storage::url($home_cms->section5_main_image) }}" alt="" />
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
            @include('frontend.partials.plans')
        </div>
    </section>


    {{-- modal open --}}
    <div class="modal modal-1 fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
              <div class="modal-header">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"><iframe width="560" height="315" src="{{ $home_cms->section3_video_link }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe></div>
          </div>
        </div>
      </div>
      {{-- modal close --}}

    <div class="scroll-top">
        <a id="scroll-top-btn"></a>
    </div>
@endsection
