@extends('admin.layouts.master')
@section('title')
    Ott Icons
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
                    <h3>Ott Icons</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a> <span class="bread-slash">/</span></li>
                        <li><span class="bread-blod"> List</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="w-100 text-end mb-3">
                    <a class="print_btn" href="{{ route('ott-service.create') }}" >+ Add
                        OTT Icon</a>
                </div>
                <div class="card w-100">
                    <div class="card-body">

                        <div class="row justify-content-between align-items-center mb-2">
                            <div class="col-md-6">
                                <div><h4>List of OTT Icon</h4></div>
                            </div>
                            <div class="col-md-6">
                                <div class="row g-1 justify-content-end">
                                    <div class="col-md-8 pr-0">
                                        <div class="search-field prod-search">
                                            <input type="text" name="search" id="search" placeholder="search..." required
                                                class="form-control">
                                            <a href="javascript:void(0)" class="prod-search-icon"><i class="ti ti-search"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive rounded-2 mb-4">
                            <table class="table table-hover customize-table mb-0 align-middle bg_tbody"
                                id="myTable">
                                <thead class="text-white fs-4 bg_blue">
                                    <tr>
                                        <th>Icon</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBodyContents">
                                    @include('admin.ott_services.filter')
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
