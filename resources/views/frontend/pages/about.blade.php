
@extends('frontend.layouts.master')
@section('meta_title')
@endsection
@section('title')
    About
@endsection
@push('styles')
@endpush

@section('content') 
     
    
     <section
        class="inner_banner_sec"
        style="
          background-image: url({{ Storage::url($about_cms->banner_img)}});
          background-position: center bottom;
          background-repeat: no-repeat;
          background-size: cover;
        "
      >
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="inner_banner_ontent">
                <h1>{{ $about_cms->title }}</h1>
                <div class="links-1">
                  <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="">{{ $about_cms->title }}</a></li>
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
      <section class="access-sec abt-access">
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
      <section class="about-sec">
        <div class="about-sec-wrap">
          <div class="container">
            <div class="row justify-content-end">
              <div class="col-lg-6">
                <div class="about-sec-text">
                  <div class="heading-1">
                    
                    <h3>{{ $about_cms->section1_title }}</h3>
                    <p>
                      {{ $about_cms->section1_description }}
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="abt-img">
          <img src="{{ Storage::url($about_cms->section1_img)}}" alt="" />
        </div>
      </section>
      <section class="commitment-sec">
        <div class="commitment-sec-wrap">
          <div class="container-fluid">
            <div class="row justify-content-between align-items-center">
              <div class="col-lg-5">
                <div class="about-sec-text commitment-text">
                  <div class="heading-white">
                    <h3>{{ $about_cms->section2_title1 }}</h3>
                    <p>
                      {{ $about_cms->section2_description1 }}
                    </p>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="commitment-img">
                  <img src="{{ Storage::url($about_cms->section2_img2)}}" alt="" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="entertainment-sec abt-entertaiment">
        <div class="entertainment-bg">
          <img src="{{ Storage::url($about_cms->section3_back_img)}}" alt="" />
        </div>
        <div class="sets-apart-sec">
          <div class="container">
            <div class="sets-apart-head text-center mb-4">
              <div class="heading-1">
                <h3>{{ $about_cms->section3_title }}</h3>
              </div>
            </div>
            <div class="row justify-content-center">
              <div class="col-lg-9">
                <div class="row g-0">
                  <div class="col-lg-4">
                    <div class="sets-apart-box">
                      <div class="shows-slider-box">
                        <div class="shows-slider-img">
                          <img src="{{ Storage::url($about_cms->section3_image1)}}" alt="" />
                          <div class="sets-apart-text">
                            <h3>{{ $about_cms->section3_title1 }}</h3>
                            <p>{{ $about_cms->section3_description1 }}</p>
                          </div>
                          <div class="show-num">
                            <h2>1</h2>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="sets-apart-box">
                      <div class="shows-slider-box">
                        <div class="shows-slider-img">
                          <img src="{{ Storage::url($about_cms->section3_image1)}}" alt="" />
                          <div class="sets-apart-text">
                            <h3>{{ $about_cms->section3_title2 }}</h3>
                            <p>{{ $about_cms->section3_description2 }}</p>
                          </div>
                          <div class="show-num">
                            <h2>2</h2>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-lg-4">
                    <div class="sets-apart-box">
                      <div class="shows-slider-box">
                        <div class="shows-slider-img">
                          <img src="{{ Storage::url($about_cms->section3_image3)}}" alt="" />
                          <div class="sets-apart-text">
                            <h3>{{ $about_cms->section3_title3 }}</h3>
                            <p>{{ $about_cms->section3_description3 }}</p>
                          </div>
                          <div class="show-num">
                            <h2>3</h2>
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
        <div class="entertainment-div">
          @include('frontend.partials.entertainment');
         
      </div>
      </section>

      @endsection
      
     
