@extends('frontend.affiliate-marketer.layouts.master')
@section('title')
    Menu List
@endsection
@push('styles')
    <style>
        .error {
            color: red !important;
        }
    </style>
@endpush
@section('content')
    <section id="loading">
        <div id="loading-content"></div>
    </section>
    <div class="container-fluid">
        <div class="breadcome-list">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <h3>Menu Management</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{ route('affiliate-marketer.dashboard') }}">Home</a> <span class="bread-slash">/</span></li>
                        <li><span class="bread-blod">Menu List</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="w-100 text-end mb-3">

                </div>
                <div class="card w-100">
                    <div class="card-body">
                        <div class="table-responsive rounded-2 mb-4">
                            <table class="table table-hover customize-table mb-0 align-middle bg_tbody cusrsor-pointer"
                                id="myTable">
                                <thead class="text-white fs-4 bg_blue">
                                    <tr>

                                        <th><span class="fs-4 fw-semibold mb-0"> Menu name</span></th>
                                        <th><span class="fs-4 fw-semibold mb-0"> Slug</span></th>
                                        <th><span class="fs-4 fw-semibold mb-0"> Status</span></th>
                                        <th><span class="fs-4 fw-semibold mb-0"> Action</span></th>
                                    </tr>
                                </thead>
                                <tbody id="tableBodyContents">


                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@push('scripts')
@endpush
