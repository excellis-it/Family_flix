
@extends('frontend.layouts.master')
@section('meta_title')
@endsection
@section('title', 'Faq - Family Flix')
@push('styles')
@endpush

@section('content') 
     
    
     <section
        class="inner_banner_sec"
        style="
          background-image: url({{ Storage::url($faq->banner_image)}});
          background-position: center;
          background-repeat: no-repeat;
          background-size: cover;
        "
      >
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="inner_banner_ontent">
                <h1>{{ $faq->banner_heading }}</h1>
                <div class="links-1">
                  <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="">{{ $faq->banner_heading }}</a></li>
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
              <div class="pricing-text-1-para text-left">
                @foreach($faq_qstn_ansrs as $faq_qstn_ansr)
                <h2>{{ $faq_qstn_ansr->question }}</h2>
                <p>{{ $faq_qstn_ansr->answer }}</p>
                @endforeach
               
              </div>
            </div>
          </div>
        </div>
      </section>
      
      

      @endsection
      
     
