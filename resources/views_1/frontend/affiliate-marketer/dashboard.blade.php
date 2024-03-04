@extends('frontend.affiliate-marketer.layouts.master')
@section('title')
    Dashboard
@endsection
@push('styles')
@endpush
@section('head')
    Dashboard
@endsection
@section('content')
<div class="container-fluid">
    <div class="breadcome-list">
      <div class="row">
          <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            <h3>Welcome back!</h3>
            <ul class="breadcome-menu mb-0">
              <li><a href="javascript:void(0);">Home</a> <span class="bread-slash">/</span></li>
              <li><span class="bread-blod">Dashboard</span></li>
            </ul>
          </div>
      </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <div class="card mb-30">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <span>Total Commission</span>
                        </div>

                        <span class="fw-600">{{$count['total_commissions'] }}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card mb-30">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <span>This Month Commssion Amount</span>
                        </div>
                        <span class="fw-600">{{$count['commision_amount_this_month'] ? '$'.$count['commision_amount_this_month'] : '$0'}}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card mb-30">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <span>This Week Commission Amount</span>
                        </div>
                        <span class="fw-600">{{$count['commision_amount_this_week'] ? '$'.$count['commision_amount_this_week'] : '$0'}}</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card mb-30">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <span>Total Commission Amount</span>
                        </div>
                        <span class="fw-600">{{$count['total_commision_amount'] ? '$'.$count['total_commision_amount'] : '$0'}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

  </div>
@endsection

@push('scripts')

@endpush
