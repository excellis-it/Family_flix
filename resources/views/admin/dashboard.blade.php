@extends('admin.layouts.master')
@section('title')
    Dashboard - {{ env('APP_NAME') }} admin
@endsection
@push('styles')
    <style>
        .dataTables_filter {
            margin-bottom: 10px !important;
        }

        #canvas {
            height: 20rem;
        }

        .chartjs-custom {
            position: relative;
            overflow: hidden;
            margin-right: auto;
            margin-left: auto
        }

        .hs-chartjs-tooltip-wrap {
            position: absolute;
            z-index: 3;
            transition: opacity .2s ease-in-out, left .2s ease, top .2s ease
        }

        .hs-chartjs-tooltip {
            position: relative;
            font-size: .75rem;
            background-color: #132144;
            border-radius: .3125rem;
            padding: .54688rem .875rem;
            transition: opacity .2s ease-in-out, left .2s ease, top .2s ease, top 0s
        }

        .hs-chartjs-tooltip::before {
            position: absolute;
            left: calc(50% - .5rem);
            bottom: -.4375rem;
            width: 1rem;
            height: .5rem;
            content: "";
            background-image: url("data:image/svg+xml,%3Csvg width='1rem' height='0.5rem' xmlns='http://www.w3.org/2000/svg' x='0px' y='0px' viewBox='0 0 50 22.49'%3E%3Cpath fill='%23132144' d='M0,0h50L31.87,19.65c-3.45,3.73-9.33,3.79-12.85,0.13L0,0z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: center center;
            background-size: 1rem .5rem
        }

        .hs-chartjs-tooltip-left {
            left: -130%
        }

        .hs-chartjs-tooltip-left::before {
            top: 50%;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
            right: -.6875rem;
            left: auto;
            -webkit-transform: translateY(-50%) rotate(270deg);
            transform: translateY(-50%) rotate(270deg)
        }

        .hs-chartjs-tooltip-right {
            left: 30%
        }

        .hs-chartjs-tooltip-right::before {
            top: 50%;
            -webkit-transform: translateY(-50%);
            transform: translateY(-50%);
            left: -.6875rem;
            right: auto;
            -webkit-transform: translateY(-50%) rotate(90deg);
            transform: translateY(-50%) rotate(90deg)
        }

        .hs-chartjs-tooltip-header {
            color: rgba(255, 255, 255, .7);
            font-weight: 600;
            white-space: nowrap
        }

        .hs-chartjs-tooltip-body {
            color: #fff
        }

        .chartjs-doughnut-custom {
            position: relative
        }

        .chartjs-doughnut-custom-stat {
            position: absolute;
            top: 8rem;
            left: 50%;
            -webkit-transform: translateX(-50%);
            transform: translateX(-50%)
        }

        .chartjs-matrix-custom {
            position: relative
        }

        .hs-chartjs-matrix-legend {
            display: inline-block;
            position: relative;
            height: 2.5rem;
            list-style: none;
            padding-left: 0
        }

        .hs-chartjs-matrix-legend-item {
            width: .625rem;
            height: .625rem;
            display: inline-block
        }

        .hs-chartjs-matrix-legend-min {
            position: absolute;
            left: 0;
            bottom: 0
        }

        .hs-chartjs-matrix-legend-max {
            position: absolute;
            right: 0;
            bottom: 0
        }
    </style>
@endpush

@section('content')
   
    <section id="loading">
        <div id="loading-content"></div>
    </section>
    <div class="page-wrapper">

        <div class="content container-fluid">

            <div class="page-header">
                <div class="row">
                    <div class="col-sm-12">
                        <h3 class="page-title">Welcome Admin Panel!</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card mb-30">
                <div class="card-body" style="position: relative;">
                    <div class="row align-items-center mb-4">
                        <div class="col-lg-6">
                            <h5 class="card-title mb-0">Product Analytics</h5>
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

                                        <span class="fw-600">10</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="card mb-30">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <span>Plans</span>
                                        </div>
                                        <span class="fw-600">10</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="card mb-30">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <span>Subscriptions</span>
                                        </div>
                                        <span class="fw-600">10</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="card mb-30">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <span>Customers</span>
                                        </div>
                                        <span class="fw-600">10</span>
                                    </div>
                                </div>
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
