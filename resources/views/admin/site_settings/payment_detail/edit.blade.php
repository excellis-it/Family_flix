@extends('admin.layouts.master')
@section('title')
    Payment Mail Edit
@endsection
@push('styles')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="breadcome-list">
            <div class="d-flex">
                <div class="arrow_left"><a href="{{ route('products.index') }}" class="text-white"><i
                            class="ti ti-arrow-left"></i></a></div>
                <div class="">
                    <h3>Edit Mail</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a> <span class="bread-slash">/</span></li>
                        <li><span class="bread-blod">Edit Mail</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card w-100">
                    <div class="card-body">
                        <form action="{{ route('payment-detail-mail.update') }}" method="POST" id="project-create-form" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="id" value="{{ $payment_detail_mail->id }}">
                                <div class="form-group col-md-6 mb-3">
                                    <label for="inputEnterYourName" class="col-form-label">Mail<span
                                        style="color: red;">*</span></label>
                                    <input type="text" name="email" id=""
                                        class="form-control" value="{{ $payment_detail_mail->email ?? '' }}"
                                        placeholder="Enter Mail">
                                    @if ($errors->has('email'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('email') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label for="inputEnterYourName" class="col-form-label"> Status
                                        <span style="color: red;">*</span></label>
                                    <select name="status" id="" class="form-control">
                                        <option value="1" {{ $payment_detail_mail->status == 1 ? 'selected':'' }}>Active</option>
                                        <option value="0" {{ $payment_detail_mail->status == 0 ? 'selected':'' }}>Inactive</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('status') }}</div>
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
