@extends('customer.layouts.master')
@section('title')
Change Password
@endsection

@push('styles')
@endpush

@section('content')
    <div class="container-fluid">
        <div class="breadcome-list">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <h3>Change Password</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{route('customer.dashboard')}}">Home</a> <span class="bread-slash">/</span></li>
                        <li><span class="bread-blod">Change Password</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--  Row 1 -->

        <div class="row">
            <div class="col-lg-12">
                <div class="profile-container">
                    <form action="{{ route('customer.password.update') }}" method="POST" enctype="multipart/form-data">
                        <div class="row  mb-0">
                            <div class="col-lg-12">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-4 mb-3">
                                        <label>Old Password</label>
                                        <input type="password" class="form-control" value="{{old('old_password')}}" name="old_password" placeholder="">
                                        @if ($errors->has('old_password'))
                                            <span class="text-danger">{{ $errors->first('old_password') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-4 mb-3">
                                        <label>New Password</label>
                                        <input type="password" class="form-control" value="{{old('new_password')}}" name="new_password" placeholder="">
                                        @if ($errors->has('new_password'))
                                            <span class="text-danger">{{ $errors->first('new_password') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-4 mb-3">
                                        <label>Confirm Password</label>
                                        <input type="password" class="form-control" value="{{old('confirm_password')}}" name="confirm_password" placeholder="">
                                        @if ($errors->has('confirm_password'))
                                            <span class="text-danger">{{ $errors->first('confirm_password') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="w-100 text-end">
                                    <button class="print_btn" type="submit">Update</button>
                                </div>

                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
@endpush
