@extends('admin.layouts.master')
@section('title')
    Stripe Credential Update
@endsection
@push('styles')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="breadcome-list">
            <div class="d-flex">
                <div class="arrow_left"><a href="{{ route('credentials.index') }}" class="text-white"><i
                            class="ti ti-arrow-left"></i></a></div>
                <div class="">
                    <h3>Update Stripe {{Ucfirst($credential->credential_name)}} Credential</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a> <span class="bread-slash">/</span></li>
                        <li><span class="bread-blod"><a href="{{ route('credentials.index') }}">
                            Stripe Credential</a></span><span class="bread-slash">/</span></li>
                        <li><span class="bread-blod">Update Stripe {{Ucfirst($credential->credential_name)}} Credential</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card w-100">
                    <div class="card-body">
                        <form action="{{ route('credentials.update', $credential->id) }}" method="POST" id="project-create-form"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-4 mb-3">
                                    <label for="inputEnterYourName" class="col-form-label"> Stripe Key<span
                                            style="color: red;">*</span></label>
                                    <input type="text" name="stripe_key" id="" class="form-control"
                                        value="{{ $credential['stripe_key'] }}" placeholder="Enter Stripe Key">
                                    @if ($errors->has('stripe_key'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('stripe_key') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label for="inputEnterYourName" class="col-form-label">Stripe Secret <span style="color: red;">*</span></label>
                                    <div class="input-group">
                                        <input type="password" name="stripe_secret" id="stripe_secret" class="form-control"
                                               value="{{ $credential['stripe_secret'] }}" placeholder="Enter Stripe Secret" autocomplete="off">
                                        <span class="input-group-text" id="toggleClientSecret"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
                                    </div>
                                    @if ($errors->has('stripe_secret'))
                                        <div class="error" style="color:red;">{{ $errors->first('stripe_secret') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-4 mb-3">
                                    <label for="inputEnterYourName" class="col-form-label"> Status
                                        <span style="color: red;">*</span></label>
                                    <select name="status" id="" class="form-control">
                                        <option value="">Select a Status</option>
                                        <option value="1"
                                            @if ($credential['status'] == 1) selected="" @endif>Active
                                        </option>
                                        <option value="0"
                                            @if ($credential['status'] == 0) selected="" @endif>
                                            Inactive</option>
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
<script>
    $(document).ready(function () {
        $('#toggleClientSecret').click(function () {
            var input = $('#stripe_secret');
            var icon = $(this).find('i');

            if (input.attr('type') === 'text') {
                input.attr('type', 'password');
                icon.removeClass('fa-eye').addClass('fa-eye-slash');
            } else {
                input.attr('type', 'text');
                icon.removeClass('fa-eye-slash').addClass('fa-eye');
            }
        });
    });
</script>
@endpush
