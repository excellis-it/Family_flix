
@extends('frontend.layouts.master')
@section('meta_title')
@endsection
@section('title', 'Pricing - Family Flix')
@push('styles')
@endpush

@section('content')
     
     <section
        class="inner_banner_sec"
        style="
          background-image: url({{ Storage::url($plan_cms->banner_img) }});
          background-position: center bottom;
          background-repeat: no-repeat;
          background-size: cover;
        "
      >
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="inner_banner_ontent">
                <h1>{{ $plan_cms->title }}</h1>
                <div class="links-1">
                  <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="">{{ $plan_cms->title }}</a></li>
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
      <section class="pricing-text-1">
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="pricing-text-1-para text-center">
                <p>
                  {{ $plan_cms->short_description }}
                </p>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="pricing-sec pricing-page">
        <div class="pricing-bg">
          <img src="{{ Storage::url($plan_cms->background_img) }}" alt="" />
        </div>
        <div class="container">
          <div class="pricing-sec-wrap">
            <div class="row justify-content-center">
              <div class="col-lg-8">
                <div class="entertainment-head">
                  <div class="heading-1 heading-white text-center">
                    <h2>{{ $plan_cms->main_title }}<span class="dot">.</span></h2>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @include('frontend.partials.plans')
        </div>
      </section>
      <section class="offer-sec">
        <div class="offer-sec-bg">
          <img src="{{ Storage::url($plan_cms->middle_back_img) }}" alt="">
        </div>
        <div class="container">
          <div class="offer-sec-wrap">
            <div class="row justify-content-center">
              <div class="col-lg-5">
                <div class="offer-div">
                  <h2>{{ $plan_cms->title1 }}</h2>
                  <p>
                    {{ $plan_cms->description1 }}
                  </p>
                </div>
              </div>
              <div class="col-lg-5">
                <div class="offer-div">
                  <h2>{{ $plan_cms->title2 }}</h2>
                  <p>
                    {{ $plan_cms->description2 }}
                  </p>
                </div>
              </div>
              <div class="col-md-10">
                <div class="offer-p">
                  <p>{{ $plan_cms->middle_content }}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="offer-img">
          <img src="{{ Storage::url($plan_cms->anime1_img) }}" alt="">
        </div>
        <div class="offer-img-2">
          <img src="{{ Storage::url($plan_cms->anime2_img) }}" alt="">
        </div>
      </section>
      @if(count($products) > 0)
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
          @include('frontend.partials.unbeatable-slider')
 
        </div>
    </section>
    @endif
     
     
    @endsection
