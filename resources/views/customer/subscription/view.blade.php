@extends('customer.layouts.master')
@section('title')
    Dashboard
@endsection
@push('styles')
@endpush
@section('head')
    Dashboard
@endsection
@section('content')
    <section class="inner_banner_sec"
        style="
background-image: url({{ asset('frontend_assets/images/movie-bg.png') }});
background-position: center;
background-repeat: no-repeat;
background-size: cover;
">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="inner_banner_ontent">
                        <h1>User Panel</h1>
                        <!-- <div class="links-1">
                <ul>
                  <li><a href="">Home</a></li>
                  <li><a href="">Movies</a></li>
                </ul>
              </div> -->
                        <!-- <div class="inr-text">
                <p>
                  Dive into a world of cinematic wonders with our extensive
                  collection of movies. The Family Flix Movie Section is your
                  gateway to a diverse range of films, spanning genres,
                  languages, and cultures. Whether you’re a fan of gripping
                  dramas, thrilling action, heartwarming comedies, or
                  captivating documentaries, we have something for every movie
                  enthusiast.
                </p>
              </div> -->
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--  Row 1 -->
    <section class="user-panel">
        <div class="container">
            <div class="user-panel-wrap">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="user-list">
                            <ul>
                                {{-- <li class="active-1"><a href="">Dashboard</a></li> --}}
                                <li class="{{ Request::is('customer/subscriptions*') ? 'active-1' : '' }}"><a
                                        href="{{ route('customer.subscription') }}">Subscriptions</a></li>
                                <li class="{{ Request::is('customer/profile*') ? 'active-1' : '' }}"><a
                                        href="{{ route('customer.profile') }}">Account details</a></li>
                                <li><a href="{{ route('customer.logout') }}">Log out</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <p><span class="fw-600">Plan Name:-</span> {{ $customer_subscription->plan_name ?? 'N/A' }}</p>
                        <p><span class="fw-600">Plan Price:-</span> ${{ $customer_subscription->plan_price ?? 'N/A' }}</p>
                        <p><span class="fw-600">Coupon Code:-</span> {{ $customer_subscription->coupan_code ?? 'N/A' }}</p>
                        <p><span class="fw-600">Total Amount:-</span> ${{ $customer_subscription->total ?? 'N/A' }}</p>
                        <p><span class="fw-600">Affiliater name:-</span>
                            {{ $customer_subscription->affiliate->name ?? 'N/A' }}</p>

                    </div>
                </div>
            </div>
        </div>
    </section>
        
    @endsection

    @push('scripts')
    @endpush
