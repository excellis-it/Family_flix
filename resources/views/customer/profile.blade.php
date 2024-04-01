@extends('customer.layouts.master')
@section('title')
    Profile
@endsection

@push('styles')
@endpush

@section('content')
    <div class="container-fluid">
        <div class="breadcome-list">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <h3>Profile</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="#">Home</a> <span class="bread-slash">/</span></li>
                        <li><span class="bread-blod">Profile</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--  Row 1 -->

        <div class="row">
            <div class="col-lg-12">
                <div class="profile-container">
                    <form action="{{ route('customer.profile.update') }}" method="POST" enctype="multipart/form-data">
                        <div class="row mb-4">
                            <div class="col-lg-12 col-md-12">
                                <div class="d-block d-md-flex align-items-center">
                                    <div class="left_img me-3 profile_img">
                                        <span>
                                            @if (Auth::user()->image)
                                                <img src="{{ Storage::url(Auth::user()->image) }}"
                                                    alt="" id="blah">
                                            @else
                                                <img src="{{ asset('admin_assets/images/user-1.jpg') }}" alt=""
                                                    id="blah" />
                                            @endif
                                        </span>
                                        <div class="profile_eidd">
                                            <input type="file" id="edit_profile" onchange="readURL(this);" name="image"/>
                                            <label for="edit_profile"><i class="ti ti-edit"></i></label>
                                        </div>
                                    </div>
                                    <div class="right_text profile-info">
                                        <p>Hello!</p>
                                        <h2>{{Auth::user()->name}}</h2>
                                        <p>{{Auth::user()->email}}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row  mb-0">
                            <div class="col-lg-12">
                                @csrf
                                <div class="row">
                                    <div class="form-group col-md-6 mb-3">
                                        <label>Full Name</label>
                                        <input type="text" class="form-control" value="{{ Auth::user()->name }}"
                                            name="name" placeholder="">
                                        @if ($errors->has('name'))
                                            <span class="text-danger">{{ $errors->first('name') }}</span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6 mb-3">
                                        <label>Phone number</label>
                                        <input type="text" class="form-control" value="{{ Auth::user()->phone }}"
                                            name="phone" placeholder="">
                                        @if ($errors->has('phone'))
                                            <span class="text-danger">{{ $errors->first('phone') }}</span>
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
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    $('#blah')
                        .attr('src', e.target.result);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
