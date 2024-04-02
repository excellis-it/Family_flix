@extends('admin.layouts.master')
@section('title')
    {{ env('APP_NAME') }} | Profile
@endsection
@push('styles')
@endpush

@section('content')
    <div class="container-fluid">
        <!--page-content-wrapper-->
        <div class="breadcome-list">
            <div class="d-flex">

                <div class="">
                    @if (Auth::check() && Auth::user()->hasRole('ADMIN'))
                    <h3>Admin Profile</h3>
                    @elseif(Auth::check() && Auth::user()->hasRole('MANAGER'))
                    <h3>Manager Profile</h3>
                    @else
                    <h3>Profile</h3>
                    @endif 
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a> <span class="bread-slash">/</span></li>
                        <li><span class="bread-blod"><a href="">Profile</a></span></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="user-profile-page">
            <div class="card radius-15">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 col-lg-7 border-right">
                            <div class="d-md-flex align-items-center">
                                <div class="mb-md-0 mb-3">
                                    @if (!Auth::user()->image)
                                        <a href="{{ asset('admin_assets/img/profiles/avatar-21.jpg') }}" target="_blank">
                                            <img src="{{ asset('admin_assets/img/profiles/avatar-21.jpg') }}"
                                                class="rounded-circle shadow" width="130px" height="130px"
                                                alt="" /></a>
                                    @else
                                        <a href="{{ Storage::url(Auth::user()->image) }}" target="_blank">
                                            <img src="{{ Storage::url(Auth::user()->image) }}" class="rounded-circle shadow"
                                                width="130px" height="130px" alt=""></a>
                                    @endif
                                </div>
                                <div class="ms-md-4 flex-grow-1">
                                    <div class="d-flex align-items-center mb-1">
                                        <h4 class="mb-0">{{ Auth::user()->name }}</h4>
                                    </div>
                                    <p class="mb-0 text-muted">Admin</p>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!--end row-->

                    <div class="tab-content mt-3">
                        <div class="tab-pane fade show active" id="Edit-Profile">
                            <div class="card shadow-none border mb-0 radius-15">
                                <div class="card-body">
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-12 col-lg-5 border-right">
                                                <form class="row g-3" action="{{ route('admin.profile.update') }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="col-12">
                                                        <label class="form-label">Profile Picture</label>
                                                        <input type="file" name="profile_picture" class="form-control">
                                                        @if ($errors->has('profile_picture'))
                                                            <div class="error" style="color:red;">
                                                                {{ $errors->first('profile_picture') }}</div>
                                                        @endif
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="form-label">Name</label>
                                                        <input type="text" value="{{ Auth::user()->name }}"
                                                            name="name" class="form-control">
                                                        @if ($errors->has('name'))
                                                            <div class="error" style="color:red;">
                                                                {{ $errors->first('name') }}</div>
                                                        @endif
                                                    </div>
                                                    <div class="col-12">
                                                        <label class="form-label">Email</label>
                                                        <input type="text" value="{{ Auth::user()->email }}"
                                                            name="email" class="form-control">
                                                        @if ($errors->has('email'))
                                                            <div class="error" style="color:red;">
                                                                {{ $errors->first('email') }}</div>
                                                        @endif
                                                    </div>

                                                    <div class="w-100 text-end">
                                                        <button type="submit" class="print_btn">Save</button>
                                                    </div>

                                                </form>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
@endpush
