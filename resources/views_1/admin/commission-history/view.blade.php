@extends('admin.layouts.master')
@section('title')
    Commission History
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
                        <li><span class="bread-blod">Commission History</span></li>
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
                                <h3><u>Customer Details</u></h3>
                            </div>
                            <div class="preview-container-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p><span class="fw-600">Customer Name:-</span> {{ $commission->customerDetails->full_name ?? 'N/A'}}</p>
                                        <p><span class="fw-600">Customer Email:-</span> {{ $commission->customerDetails->email_address ?? 'N/A'}}</p>
                                        <p><span class="fw-600">Country:-</span> {{ $commission->customerDetails->country ?? 'N/A'}}</p>
                                        <p><span class="fw-600">State:-</span> {{ $commission->customerDetails->state ?? 'N/A'}}</p>
                                        <p><span class="fw-600">City:-</span> {{ $commission->customerDetails->town ?? 'N/A'}}</p>
                                        <p><span class="fw-600">Zip Code:-</span> {{ $commission->customerDetails->post_code ?? 'N/A'}}</p>
                                        <p><span class="fw-600">Address:-</span> {{ $commission->customerDetails->house_no_street_name ?? 'N/A'}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="preview-sec">
                    <div class="preview-wrap">
                        {{-- Customer Details  view --}}
                        <div class="preview-container">
                            <div class="preview-container-header">
                                <h3><u>User Subscription</u></h3>
                            </div>
                            <div class="preview-container-body">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <p><span class="fw-600">Affiliate Name:-</span> {{ $commission->affiliate->name ?? 'N/A'}}</p>
                                        <p><span class="fw-600">Affiliate Email:-</span> {{ $commission->affiliate->email ?? 'N/A'}}</p>
                                        <p><span class="fw-600">Affiliate Plan Name:-</span> {{ $commission->plan_name ?? 'N/A'}}</p>
                                        <p><span class="fw-600">Total:-</span> {{ $commission->total ?? 'N/A'}}</p>
                                        <p><span class="fw-600">Affiliate Commission:-</span> {{ $commission->affiliate_commission ?? 'N/A'}}</p>
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
