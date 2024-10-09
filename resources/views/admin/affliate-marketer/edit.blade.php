@extends('admin.layouts.master')
@section('title')
    Affiliate Marketer Update
@endsection
@push('styles')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="breadcome-list">
            <div class="d-flex">
                <div class="arrow_left"><a href="{{ route('affliate-marketer.index') }}" class="text-white"><i
                            class="ti ti-arrow-left"></i></a></div>
                <div class="">
                    <h3>Update Affiliate Marketer</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a> <span class="bread-slash">/</span></li>
                        <li><span class="bread-blod"><a href="{{ route('affliate-marketer.index') }}">
                                    List</a></span><span class="bread-slash">/</span></li>
                        <li><span class="bread-blod">Update Affiliate Marketer</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card w-100">
                    <div class="card-body">
                        <form action="{{ route('affliate-marketer.update', $affiliate_marketer->id) }}" method="POST" id="project-create-form"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6 mb-3">
                                    <label for="inputEnterYourName" class="col-form-label"> Name <span
                                            style="color: red;">*</span></label>
                                    <input type="text" name="name" id="" class="form-control"
                                        value="{{ $affiliate_marketer['name'] ?? ''}}" placeholder="Enter Name">
                                    @if ($errors->has('name'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    <label for="inputEnterYourName" class="col-form-label"> Email <span
                                            style="color: red;">*</span></label>
                                    <input type="text" name="email" id="" class="form-control"
                                        value="{{ $affiliate_marketer['email'] ?? ''}}" placeholder="Enter  Email">
                                    @if ($errors->has('email'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('email') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label for="inputEnterYourName" class="col-form-label"> Phone <span
                                            style="color: red;">*</span></label>
                                    <input type="text" name="phone" id="" class="form-control"
                                        value="{{ $affiliate_marketer['phone'] ?? ''}}" placeholder="Enter Phone Number">
                                    @if ($errors->has('phone'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('phone') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label for="inputEnterYourName" class="col-form-label"> Status
                                        <span style="color: red;">*</span></label>
                                    <select name="status" id="" class="form-control">
                                        <option value="">Select a Status</option>
                                        <option value="1"
                                            @if ($affiliate_marketer['status'] == 1) selected="" @endif>Active
                                        </option>
                                        <option value="0"
                                            @if ($affiliate_marketer['status'] == 0) selected="" @endif>
                                            Inactive</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('status') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    <label for="inputEnterYourName" class="col-form-label"> Profile </label>
                                    <input type="file" name="profile_picture" id="" class="form-control">
                                    @if ($errors->has('profile_picture'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('profile_picture') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    <label for="inputEnterYourName" class="col-form-label"> Password</label>
                                    <input type="password" name="password" id="" class="form-control"
                                        value="{{ old('password') }}" placeholder="Enter pasword">
                                    @if ($errors->has('password'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    <label for="inputEnterYourName" class="col-form-label"> Confirm Password</label>
                                    <input type="password" name="confirm_password" id="" class="form-control" placeholder="Confirm Password"
                                        value="{{old('confirm_password') }}">
                                    @if ($errors->has('confirm_password'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('confirm_password') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label for="inputEnterYourName" class="col-form-label"> Commission Percentage</label>
                                    <input type="text" name="commission_percentage" id="" class="form-control" placeholder="Commission Percentage"
                                    value="{{ $affiliate_commission['percentage'] ?? '' }}">
                                    @if ($errors->has('commission_percentage'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('commission_percentage') }}</div>
                                    @endif
                                </div>


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
