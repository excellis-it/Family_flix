@extends('admin.layouts.master')
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
            <a href="{{ route('products.index') }}">
                <div class="card mb-30">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <span>Products</span>
                            </div>

                            <span class="fw-600">{{ $count['products'] }}</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3">
            <a href="{{ route('affliate-marketer.index') }}">
                <div class="card mb-30">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <span>Affiliators</span>
                            </div>
                            <span class="fw-600">{{ $count['affiliators'] }}</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3">
            <a href="{{ route('plan.index') }}">
                <div class="card mb-30">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <span>Plan</span>
                            </div>
                            <span class="fw-600">{{ $count['plans'] }}</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-lg-3">
            <a href="{{ route('commission-history.index') }}">
                <div class="card mb-30">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div class="d-flex align-items-center">
                                <span>Subscriptions</span>
                            </div>
                            <span class="fw-600">{{ $count['subscriptions'] }}</span>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>

  </div>
@endsection

@push('scripts')

@endpush
