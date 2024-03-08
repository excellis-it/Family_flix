
@extends('frontend.layouts.master')
@section('meta_title')
@endsection
@section('title', 'Movies - Family Flix')
@push('styles')
@endpush

@section('content')
      
      
      <section
        class="inner_banner_sec"
        style="
          background-image: url({{ Storage::url($movie_cms->banner_img) }});
          background-position: center bottom;
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
                    <li><a href="{{ route('home') }}">Home</a></li>
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
          <img src="{{ Storage::url($movie_cms->top_10_show_background) }}" alt="" />
        </div>
        <div class="container">
          <div class="row justify-content-center align-items-center">
            <div class="col-lg-10">
              <div class="shows-slider-head">
                <h3>Top 10 Shows To Watch</h3>
              </div>
              <div class="shows-slider">
                @include('frontend.partials.top_10')
              </div>
            </div>
          </div>
        </div>
      </section>
     
      <section class="unbeatable-sec popular-movies">
        <div class="unbeatable-bg">
          <img src="{{ Storage::url($movie_cms->popular_show_background) }}" alt="" />
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
          @include('frontend.partials.popular')
        </div>
      </section>
      @include('frontend.partials.subscription')

      @endsection
     