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
                    <div class="col-lg-8">
                        <div class="user-list">
                            <div class="subscibtion-head">
                                <h3>Subscribtion details</h3>
                            </div>
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="subscibtion-list remove-back">
                                        <ul>
                                            <li><span class="fw-600">Plan Name:-</span>
                                                {{ $customer_subscription->plan_name ?? 'N/A' }}</li>
                                            <li><span class="fw-600">Plan Price:-</span>
                                                ${{ $customer_subscription->plan_price ?? 'N/A' }}</li>
                                            <li><span class="fw-600">Coupon Code:-</span>
                                                {{ $customer_subscription->coupan_code ?? 'N/A' }}</li>
                                            <li><span class="fw-600">Total Amount:-</span>
                                                ${{ $customer_subscription->total ?? 'N/A' }}</li>
                                            <li><span class="fw-600">Affiliater name:-</span>
                                                {{ $customer_subscription->affiliate->name ?? 'N/A' }}
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="subscibtion-list remove-back">
                                        <ul>
                                            <li><span class="fw-600">Start date:-</span>{{ date('d M,Y', strtotime($customer_subscription->plan_start_date)) ?? 'N/A' }}</li>
                                            <li><span class="fw-600">Expiry date:-</span>{{ date('d M,Y', strtotime($customer_subscription->plan_expiry_date)) ?? 'N/A' }}</li>
                                            <li>
                                                
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
@endpush
