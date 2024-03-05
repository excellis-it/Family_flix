@extends('admin.layouts.master')
@section('title')
    {{ env('APP_NAME') }} | Password
@endsection
@push('styles')
@endpush

@section('content')
    <div class="container-fluid">
        <!--page-content-wrapper-->
        <div class="breadcome-list">
            <div class="d-flex">

                <div class="">
                    <h3>Admin Password</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a> <span class="bread-slash">/</span></li>
                        <li><span class="bread-blod"><a href="">Password</a></span></li>
                    </ul>
                </div>
            </div>
        </div>
            <!--end breadcrumb-->
            <div class="card">
                <div class="card-body">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-12 col-lg-5 border-right">
                                <form class="row g-3" action="{{ route('admin.password.update') }}" method="post"
                                    enctype="multipart/form-data">
                                    @csrf

                                    <div class="col-12">
                                        <label class="form-label">Old Password</label>
                                        <input type="password" name="old_password" class="form-control">
                                        @if ($errors->has('old_password'))
                                            <div class="error" style="color:red;">{{ $errors->first('old_password') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">New Password</label>
                                        <input type="password" name="new_password" class="form-control">
                                        @if ($errors->has('new_password'))
                                            <div class="error" style="color:red;">{{ $errors->first('new_password') }}
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-12">
                                        <label class="form-label">Confirm Password</label>
                                        <input type="password" name="confirm_password" class="form-control">
                                        @if ($errors->has('confirm_password'))
                                            <div class="error" style="color:red;">{{ $errors->first('confirm_password') }}
                                            </div>
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
        </div>
    </div>
    <!--end page-content-wrapper-->
    </div>
@endsection

@push('scripts')
@endpush
