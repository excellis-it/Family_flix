@extends('admin.layouts.master')
@section('title')
    Coupon Edit
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
                    <h3>Edit Coupon</h3>
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
                        <form action="{{ route('update.coupons') }}" method="POST" id="project-create-form"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                               
                                <input type="hidden" name="coupon_id" value="{{ $coupon_edit->id }}">
                                <div class="form-group col-md-6 mb-3">
                                    <label>Coupon Code<span style="color: red;">*</span></label>
                                    <input type="text" name="code" value="{{ $coupon_edit->code }}" placeholder="Enter coupon code"
                                        class="form-control">
                                    @if ($errors->has('code'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('code') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    <label>Percentage<span style="color: red;">*</span></label>
                                    <input type="text" name="percentage" value="{{ $coupon_edit->percentage }}" class="form-control" placeholder="Enter percentage">
                                    @if ($errors->has('percentage'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('percentage') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Status<span style="color: red;">*</span></label>
                                    <select class="form-control" name="status" >
                                        <option value="Active" {{ $coupon_edit->status == 'Active' ? 'selected': '' }}>Active</option>
                                        <option value="Deactive" {{ $coupon_edit->status == 'Deactive' ? 'selected': '' }}>Deactive</option>
                                    </select>
                                    @if ($errors->has('percentage'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('percentage') }}</div>
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
