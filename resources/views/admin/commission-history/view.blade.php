@extends('admin.layouts.master')
@section('title')
Commission History
@endsection
@push('styles')
@endpush
@section('content')
<div class="container-fluid">
    <!-- Breadcrumb and Title Section -->
    {{-- <div class="row mb-4">
        <div class="col-lg-6">
            <h3 class="mb-3">Preview</h3>
            <ul class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Commission History</li>
            </ul>
        </div>
    </div> --}}

    <div class="breadcome-list">
        <div class="d-flex">
            <div class="arrow_left"><a href="{{ route('commission-history.index') }}" class="text-white"><i
                        class="ti ti-arrow-left"></i></a></div>
            <div class="">
                <h3>Commission History</h3>
                <ul class="breadcome-menu mb-0">
                    <li><a href="{{ route('admin.dashboard') }}">Home</a> <span class="bread-slash">/</span></li>
                    <li><span class="bread-blod"><a href="{{ route('commission-history.index') }}">
                                List</a></span><span class="bread-slash">/</span></li>
                    <li><span class="bread-blod">Commission History</span></li>
                </ul>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Customer Details Section -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-header bg-warning text-white rounded-top">
                    <h5 class="mb-0 font-weight-bold">Customer Details</h5>
                </div>
                <div class="card-body p-4">
                    <p class="mb-2"><strong>Customer Name:</strong> {{ $commission->customerDetails->full_name ?? 'N/A' }}</p>
                    <p class="mb-2"><strong>Customer Email:</strong> {{ $commission->customerDetails->email_address ?? 'N/A' }}</p>
                    <p class="mb-2"><strong>Country:</strong> {{ $commission->customerDetails->country ?? 'N/A' }}</p>
                    <p class="mb-2"><strong>State:</strong> {{ $commission->customerDetails->state ?? 'N/A' }}</p>
                    <p class="mb-2"><strong>City:</strong> {{ $commission->customerDetails->town ?? 'N/A' }}</p>
                    <p class="mb-2"><strong>Zip Code:</strong> {{ $commission->customerDetails->post_code ?? 'N/A' }}</p>
                    <p class="mb-0"><strong>Address:</strong> {{ $commission->customerDetails->house_no_street_name ?? 'N/A' }}</p>
                </div>
            </div>
        </div>
    
        <!-- User Subscription Section -->
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm border-0 rounded-lg">
                <div class="card-header bg-primary text-white rounded-top">
                    <h5 class="mb-0 font-weight-bold">Affiliate Details</h5>
                </div>
                <div class="card-body p-4">
                    @if($commission->affiliate != null)
                    <p class="mb-2"><strong>Affiliate Name:</strong> {{ $commission->affiliate->name ?? 'N/A' }}</p>
                    <p class="mb-2"><strong>Affiliate Email:</strong> {{ $commission->affiliate->email ?? 'N/A' }}</p>
                    <p class="mb-2"><strong>Affiliate Plan Name:</strong> {{ $commission->plan_name ?? 'N/A' }}</p>
                    <p class="mb-2"><strong>Total:</strong> {{ $commission->total ?? 'N/A' }}</p>
                    <p class="mb-0"><strong>Affiliate Commission:</strong> {{ $commission->affiliate_commission ?? 'N/A' }}</p>
                    @else
                    <p class="text-muted mb-5">No details available</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
    
    
</div>

@endsection

@push('scripts')
@endpush