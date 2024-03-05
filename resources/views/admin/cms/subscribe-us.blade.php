@extends('admin.layouts.master')
@section('title')
    Subscription CMS
@endsection
@push('styles')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="breadcome-list">
            <div class="d-flex">

                <div class="">
                    <h3>Subscription Cms</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a> <span class="bread-slash">/</span></li>
                        <li><a href=""><span class="bread-blod">Subscription</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card w-100">
                    <div class="card-body">
                        <form action="{{ route('update.subscription-us') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" value="{{ $subscription_cms->id }}" name="id">
                            <div class="row">
                                <h4 class="text-left">Subscription Content</h4>
                                <hr>
                                <div class="form-group col-md-6 mb-3">
                                    <label> Background Image<span style="color: red;">*</span></label>
                                    <input type="file" name="section1_background_img" id="section1_background_img" class="form-control" onchange="previewImage()">
                                    @if ($errors->has('section1_background_img'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section1_background_img') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    @if($subscription_cms->section1_background_img != '')
                                        <img id="preview-image" src="{{ Storage::url($subscription_cms->section1_background_img) }}" alt="preview image" style="max-height: 150px;">
                                    @else
                                        <img id="preview-image" src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image" style="max-height: 150px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label> Title<span style="color: red;">*</span></label>
                                    <input type="text" name="section1_title" value="{{ $subscription_cms->section1_title }}"
                                        class="form-control" placeholder="Enter title">
                                    @if ($errors->has('section1_title'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section1_title') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label> Description<span style="color: red;">*</span></label>
                                    <textarea name="section1_description" class="form-control">{{ $subscription_cms->section1_description }}</textarea>
                                    @if ($errors->has('section1_description'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section1_description') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label> Button Name<span style="color: red;">*</span></label>
                                    <input type="text" name="section1_button_name" value="{{ $subscription_cms->section1_button_name }}"
                                        class="form-control" placeholder="Enter button name">
                                    @if ($errors->has('section1_button_name'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section1_button_name') }}</div>
                                    @endif
                                </div>

                                <h4 class="text-left">Form Section</h4>
                                <hr>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Main Title<span style="color: red;">*</span></label>
                                    <input type="text" name="subscribe_title" value="{{ $subscription_cms->subscribe_title }}"
                                        class="form-control" placeholder="Enter main title">
                                    @if ($errors->has('subscribe_title'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('subscribe_title') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Placeholder<span style="color: red;">*</span></label>
                                    <input type="text" name="subscription_placeholder"  value="{{ $subscription_cms->subscription_placeholder }}"
                                        class="form-control" >
                                    @if ($errors->has('subscription_placeholder'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('subscription_placeholder') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label> Button Name<span style="color: red;">*</span></label>
                                    <input type="text" name="button_name" value="{{ $subscription_cms->button_name }}"
                                        class="form-control" placeholder="Enter button name">
                                    @if ($errors->has('button_name'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('button_name') }}</div>
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


<script>
    function previewImage() {
        var preview = document.getElementById('preview-image');
        var fileInput = document.getElementById('section1_background_img');
        var file = fileInput.files[0];
        var reader = new FileReader();

        reader.onloadend = function () {
            preview.src = reader.result;
        }

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.src = '';
        }
    }
</script>
@endpush
