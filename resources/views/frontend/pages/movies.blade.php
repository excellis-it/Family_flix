
@extends('frontend.layouts.master')
@section('meta_title')
@endsection
@section('title')
    Movies
@endsection
@push('styles')
@endpush

@section('content')
      
      
      <section
        class="inner_banner_sec"
        style="
          background-image: url({{ Storage::url($movie_cms->banner_img) }});
          background-position: center;
          background-repeat: no-repeat;
          background-size: cover;
        "
      >
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="inner_banner_ontent">
                <h1>{{ $movie_cms->heading }}</h1>
                <div class="links-1">
                  <ul>
                    <li><a href="">Home</a></li>
                    <li><a href="">{{ $movie_cms->heading }}</a></li>
                  </ul>
                </div>
                <div class="inr-text">
                  <p>
                    {{ $movie_cms->small_description }}
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      @include('frontend.partials.entr_banner')
     
      
      <section class="shows-watch-sec">
        <div class="shows-watch-bg">
          <img src="{{ Storage::url($movie_cms->top10_show_back_img) }}" alt="" />
        </div>
        <div class="container">
          <div class="row justify-content-center align-items-center">
            <div class="col-lg-10">
              <div class="shows-slider-head">
                <h3>Top 10 Shows To Watch</h3>
              </div>
              <div class="shows-slider">
                <div class="shows-slider-wrap">
                  <div class="shows-slider-box">
                    <div class="shows-slider-img">
                      <img src="{{ asset('frontend_assets/images/shows-1.png')}}" alt="" />
                      <div class="show-num">
                        <h2>1</h2>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="shows-slider-wrap">
                  <div class="shows-slider-box">
                    <div class="shows-slider-img">
                      <img src="{{ asset('frontend_assets/images/shows-2.png')}}" alt="" />
                      <div class="show-num">
                        <h2>2</h2>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="shows-slider-wrap">
                  <div class="shows-slider-box">
                    <div class="shows-slider-img">
                      <img src="{{ asset('frontend_assets/images/shows-3.png')}}" alt="" />
                      <div class="show-num">
                        <h2>3</h2>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="shows-slider-wrap">
                  <div class="shows-slider-box">
                    <div class="shows-slider-img">
                      <img src="{{ asset('frontend_assets/images/shows-4.png')}}" alt="" />
                      <div class="show-num">
                        <h2>4</h2>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="shows-slider-wrap">
                  <div class="shows-slider-box">
                    <div class="shows-slider-img">
                      <img src="{{ asset('frontend_assets/images/shows-1.png')}}" alt="" />
                      <div class="show-num">
                        <h2>1</h2>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
      <section class="unbeatable-sec popular-movies">
        <div class="unbeatable-bg">
          <img src="{{ Storage::url($movie_cms->popular_movie_background) }}" alt="" />
        </div>
        <div class="entertainment-div">
          <div class="container">
            <div class="row justify-content-center">
              <div class="col-lg-6">
                <div class="entertainment-head">
                  <div class="heading-1 text-center mb-3">
                    <h3>Popular Movies</h3>
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
                <img src="{{ asset('frontend_assets/images/unbeatable-1.png')}}" alt="" />
              </div>
            </div>
          </div>
          <div class="unbeatable-slider-wrap">
            <div class="unbeatable-slider-div">
              <div class="unbeatable-slider-img">
                <img src="{{ asset('frontend_assets/images/unbeatable-2.png')}}" alt="" />
              </div>
            </div>
          </div>
          <div class="unbeatable-slider-wrap">
            <div class="unbeatable-slider-div">
              <div class="unbeatable-slider-img">
                <img src="{{ asset('frontend_assets/images/unbeatable-3.png')}}" alt="" />
              </div>
            </div>
          </div>
          <div class="unbeatable-slider-wrap">
            <div class="unbeatable-slider-div">
              <div class="unbeatable-slider-img">
                <img src="{{ asset('frontend_assets/images/unbeatable-4.png')}}" alt="" />
              </div>
            </div>
          </div>
          <div class="unbeatable-slider-wrap">
            <div class="unbeatable-slider-div">
              <div class="unbeatable-slider-img">
                <img src="{{ asset('frontend_assets/images/unbeatable-5.png')}}" alt="" />
              </div>
            </div>
          </div>
          <div class="unbeatable-slider-wrap">
            <div class="unbeatable-slider-div">
              <div class="unbeatable-slider-img">
                <img src="{{ asset('frontend_assets/images/unbeatable-6.png')}}" alt="" />
              </div>
            </div>
          </div>
          <div class="unbeatable-slider-wrap">
            <div class="unbeatable-slider-div">
              <div class="unbeatable-slider-img">
                <img src="{{ asset('frontend_assets/images/unbeatable-7.png')}}" alt="" />
              </div>
            </div>
          </div>
        </div>
      </section>
      @include('frontend.partials.subscription')

      @endsection
     