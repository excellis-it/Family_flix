@extends('admin.layouts.master')
@section('title')
    Affiliate Commission
@endsection
@push('styles')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="breadcome-list">
            <div class="d-flex">

                <div class="">
                    <h3> Affiliate Commission</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a> <span class="bread-slash">/</span></li>
                        <li><a href=""><span class="bread-blod">Commission</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card w-100">
                    <div class="card-body">
                        <form action="{{ route('update.commission-percentage') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" value="{{ $commission->id }}" name="id">
                            <div class="row">
                                <div class="form-group col-md-12 mb-3">
                                    <label for="inputEnterYourName" class="col-form-label"> Percentage <span
                                            style="color: red;">*</span></label>
                                    <input type="text" name="percentage" id="" class="form-control"
                                        value="{{ $commission->percentage }}" placeholder="Enter percentage(%)">
                                    @if ($errors->has('percentage'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('percentage') }}</div>
                                    @endif
                                </div>
                            </div>

                            <br>

                            <div class="w-100 text-end">
                                <button type="submit" class="print_btn">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
