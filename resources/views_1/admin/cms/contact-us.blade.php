@extends('admin.layouts.master')
@section('title')
    Contact CMS
@endsection
@push('styles')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="breadcome-list">
            <div class="d-flex">

                <div class="">
                    <h3>Contact Cms</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a> <span class="bread-slash">/</span></li>
                        <li><a href=""><span class="bread-blod">Contact</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card w-100">
                    <div class="card-body">
                        <form action="{{ route('update.contact-us.cms') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" value="{{ $contact_cms->id }}" name="id">
                            <div class="row">
                                <h4 class="text-left">Banner Section</h4>
                                <hr>
                                <div class="form-group col-md-6 mb-3">
                                    <label>Banner Image<span style="color: red;">*</span></label>
                                    <input type="file" name="banner_img" id="banner_img" class="form-control">
                                    @if ($errors->has('banner_img'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('banner_img') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">

                                    @if ($contact_cms->banner_img != '')
                                        <img src="{{ Storage::url($contact_cms->banner_img) }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @else
                                        <img id="preview-back-image"
                                            src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-12 mb-3">
                                    <label>Banner Heading<span style="color: red;">*</span></label>
                                    <input type="text" name="title" value="{{ $contact_cms->title }}"
                                        class="form-control" placeholder="Enter title">
                                    @if ($errors->has('title'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('title') }}</div>
                                    @endif
                                </div>

                                <h4 class="text-left">Main Section</h4>
                                <hr>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Main Background Image<span style="color: red;">*</span></label>
                                    <input type="file" name="background_img" id="background_img"
                                        class="form-control">
                                    @if ($errors->has('background_img'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('background_img') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    @if ($contact_cms->background_img != '')
                                        <img src="{{ Storage::url($contact_cms->background_img) }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @else
                                        <img id="preview-back-image"
                                            src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @endif
                                </div>

                                
                                <div class="form-group col-md-6 mb-3">
                                    <label>Main Title<span style="color: red;">*</span></label>
                                    <input type="text" name="main_title" value="{{ $contact_cms->main_title }}"
                                        class="form-control" placeholder="Enter main title">
                                    @if ($errors->has('main_title'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('main_title') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Short Title<span style="color: red;">*</span></label>
                                    <input type="text" name="short_title" value="{{ $contact_cms->short_title }}"
                                        class="form-control" placeholder="Enter short title">
                                    @if ($errors->has('short_title'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('short_title') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Button Name<span style="color: red;">*</span></label>
                                    <input type="text" name="button_name" value="{{ $contact_cms->button_name }}"
                                        class="form-control" placeholder="Enter button name">
                                    @if ($errors->has('button_name'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('button_name') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Map Link<span style="color: red;">*</span></label>
                                    <input type="text" name="map_link" value="{{ $contact_cms->map_link }}"
                                        class="form-control" placeholder="Enter map link">
                                    @if ($errors->has('map_link'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('map_link') }}</div>
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
