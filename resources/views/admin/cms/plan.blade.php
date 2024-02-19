@extends('admin.layouts.master')
@section('title')
    Plan CMS
@endsection
@push('styles')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="breadcome-list">
            <div class="d-flex">

                <div class="">
                    <h3>Plan Cms</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a> <span class="bread-slash">/</span></li>
                        <li><a href=""><span class="bread-blod">Plan</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card w-100">
                    <div class="card-body">
                        <form action="{{ route('plan-cms.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" value="{{ $plan_cms->id }}" name="id">
                            <div class="row">
                                <h4 class="text-left">Banner Section</h4>
                                <hr>
                                <div class="form-group col-md-6 mb-3">
                                    <label>Top Background Image<span style="color: red;">*</span></label>
                                    <input type="file" name="banner_img" id="banner_img" class="form-control">
                                    @if ($errors->has('banner_img'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('banner_img') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    @if ($plan_cms->banner_img != '')
                                        <img src="{{ Storage::url($plan_cms->banner_img) }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @else
                                        <img id="preview-back-image"
                                            src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Banner Heading<span style="color: red;">*</span></label>
                                    <input type="text" name="title" value="{{ $plan_cms->title }}"
                                        class="form-control" placeholder="Enter short Title">
                                    @if ($errors->has('title'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('title') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Short Description<span style="color: red;">*</span></label>
                                    <textarea name="short_description" value="{{ $plan_cms->short_description }}"
                                        class="form-control"  rows="6" cols="8">{{ $plan_cms->short_description }}</textarea>
                                    @if ($errors->has('short_description'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('short_description') }}</div>
                                    @endif
                                </div>

                                <h4 class="text-left">Main Section</h4>
                                <hr>

                                <div class="form-group col-md-12 mb-3">
                                    <label>Main Title<span style="color: red;">*</span></label>
                                    <input type="text" name="main_title" value="{{ $plan_cms->main_title }}"
                                        class="form-control" >
                                    @if ($errors->has('main_title'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('main_title') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Background Image<span style="color: red;">*</span></label>
                                    <input type="file" name="background_img" id="background_img" class="form-control">
                                    @if ($errors->has('background_img'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('background_img') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    @if ($plan_cms->background_img != '')
                                        <img src="{{ Storage::url($plan_cms->background_img) }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @else
                                        <img id="preview-back-image"
                                            src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @endif
                                </div>

                                <h4 class="text-left">Bottom Section</h4>
                                <hr>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Bottom Background Image<span style="color: red;">*</span></label>
                                    <input type="file" name="middle_back_img" id="middle_back_img" class="form-control">
                                    @if ($errors->has('middle_back_img'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('middle_back_img') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    @if ($plan_cms->middle_back_img != '')
                                        <img src="{{ Storage::url($plan_cms->middle_back_img) }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @else
                                        <img id="preview-back-image"
                                            src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-12 mb-3">
                                    <label>Bottom Content<span style="color: red;">*</span></label>
                                    <textarea name="middle_content" value="{{ $plan_cms->middle_content }}"
                                        class="form-control" >{{ $plan_cms->middle_content }}</textarea>
                                    @if ($errors->has('middle_content'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('middle_content') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Anime1<span style="color: red;">*</span></label>
                                    <input type="file" name="anime1_img" id="anime1_img" class="form-control">
                                    @if ($errors->has('anime1_img'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('anime1_img') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    @if ($plan_cms->anime1_img != '')
                                        <img src="{{ Storage::url($plan_cms->anime1_img) }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @else
                                        <img id="preview-back-image"
                                            src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @endif
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    <label>Anime2<span style="color: red;">*</span></label>
                                    <input type="file" name="anime2_img" id="anime2_img" class="form-control">
                                    @if ($errors->has('anime2_img'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('anime2_img') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    @if ($plan_cms->anime2_img != '')
                                        <img src="{{ Storage::url($plan_cms->anime2_img) }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @else
                                        <img id="preview-back-image"
                                            src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>1st Title<span style="color: red;">*</span></label>
                                    <input type="text" name="title1" value="{{ $plan_cms->title1 }}"
                                        class="form-control" >
                                    @if ($errors->has('title1'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('title1') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    <label>1st Description<span style="color: red;">*</span></label>
                                    <textarea name="description1" value="{{ $plan_cms->description1 }}"
                                        class="form-control" placeholder="Enter Main Title" rows="4" cols="6">{{ $plan_cms->description1 }}</textarea>
                                    @if ($errors->has('description1'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('description1') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>2nd Title<span style="color: red;">*</span></label>
                                    <input type="text" name="title2" value="{{ $plan_cms->title2 }}"
                                        class="form-control" >
                                    @if ($errors->has('title2'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('title2') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    <label>2nd Description<span style="color: red;">*</span></label>
                                    <textarea name="description2" value="{{ $plan_cms->description2 }}"
                                        class="form-control"  rows="4" cols="6">{{ $plan_cms->description2 }}</textarea>
                                    @if ($errors->has('description2'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('description2') }}</div>
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
