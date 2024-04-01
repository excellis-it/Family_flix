@extends('customer.layouts.master')
@section('title')
    User Subscription
@endsection
@push('styles')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="breadcome-list">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <h3>Preview</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a> <span class="bread-slash">/</span></li>
                        <li><span class="bread-blod">User Subscription</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--  Row 1 -->

        <div class="row">
            <div class="col-lg-6">
                <div class="preview-sec">
                    <div class="preview-wrap">
                        {{-- Customer Details  view --}}
                        <div class="preview-container">
                            <div class="preview-container-header">
                                <h3><u>Subscription Details</u></h3>
                            </div>
                            <div class="preview-container-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p><span class="fw-600">Plan Name:-</span> {{ $customer_subscription->plan_name ?? 'N/A'}}</p>
                                        <p><span class="fw-600">Plan Price:-</span> ${{ $customer_subscription->plan_price ?? 'N/A'}}</p>
                                        <p><span class="fw-600">Coupon Code:-</span> {{ $customer_subscription->coupan_code ?? 'N/A'}}</p>
                                        <p><span class="fw-600">Total Amount:-</span> ${{ $customer_subscription->total ?? 'N/A'}}</p>
                                        <p><span class="fw-600">Affiliater name:-</span> {{ $customer_subscription->affiliate->name ?? 'N/A'}}</p>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
        @endsection

        @push('scripts')
        @endpush
