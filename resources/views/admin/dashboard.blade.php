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
            <div class="card mb-30">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <span>Products</span>
                        </div>

                        <span class="fw-600">2</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card mb-30">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <span>Subscription</span>
                        </div>
                        <span class="fw-600">5</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card mb-30">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <span>Plan</span>
                        </div>
                        <span class="fw-600">3</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card mb-30">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <span>User</span>
                        </div>
                        <span class="fw-600">10</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

  </div>
@endsection

@push('scripts')

@endpush
