@extends('admin.layouts.master')
@section('title')
    Coupon Create
@endsection
@push('styles')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="breadcome-list">
            <div class="d-flex">
                <div class="arrow_left"><a href="{{ route('coupons.index') }}" class="text-white"><i
                            class="ti ti-arrow-left"></i></a></div>
                <div class="">
                    <h3>Add New Coupon</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a> <span class="bread-slash">/</span></li>
                        <li><span class="bread-blod"><a href="{{ route('coupons.index') }}">Coupon</a></span><span class="bread-slash">/</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card w-100">
                    <div class="card-body">
                        <form action="{{ route('coupons.store') }}" method="POST" id="project-create-form"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="form-group col-md-6 mb-3">
                                    <label>Plan<span style="color: red;">*</span></label>
                                    <select name="plan_id" class="form-control">
                                        <option value="">Select type</option>
                                        @foreach($plans as $plan)
                                        <option value="{{ $plan->id }}">{{ $plan->plan_name }}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('plan_id'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('plan_id') }}</div>
                                    @endif
                                </div>
                               

                                <div class="form-group col-md-6 mb-3">
                                    <label>Coupon Code<span style="color: red;">*</span></label>
                                    <input type="text" name="code" value="{{ old('code') }}" placeholder="Enter coupon code"
                                        class="form-control">
                                    @if ($errors->has('code'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('code') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Coupon Type<span style="color: red;">*</span></label>
                                    <select name="coupon_type" class="form-control"  >
                                        <option value="">Select type</option>
                                        <option value="percentage">Percentage</option>
                                        <option value="amount">Amount</option>
                                    </select>
                                    @if ($errors->has('coupon_type'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('coupon_type') }}</div>
                                    @endif
                                </div>
                                
                                <div class="form-group col-md-6 mb-3" id="value-input" >
                                    <label>Value<span style="color: red;">*</span></label>
                                    <input type="text" name="value" value="{{ old('value') }}" class="form-control" placeholder="Enter value">
                                    @if ($errors->has('value'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('value') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Status<span style="color: red;">*</span></label>
                                    <select class="form-control" name="status" >
                                        <option value="">Select Status</option>
                                        <option value="Active">Active</option>
                                        <option value="Deactive">Deactive</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('status') }}</div>
                                    @endif
                                </div>

                                <div class="w-100 text-end">
                                    <button type="submit" class="print_btn">Create</button>
                                </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#banner-img').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview-banner-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });


        $('#banner-logo').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview-banner-logo').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    </script>



    
@endpush
