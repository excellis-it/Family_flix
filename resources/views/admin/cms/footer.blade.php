@extends('admin.layouts.master')
@section('title')
    Footer CMS
@endsection
@push('styles')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="breadcome-list">
            <div class="d-flex">

                <div class="">
                    <h3>Footer Cms</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a> <span class="bread-slash">/</span></li>
                        <li><a href=""><span class="bread-blod">Show</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card w-100">
                    <div class="card-body">
                        <form action="{{ route('update.footer.cms') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" value="{{ $footer_cms->id }}" name="id">
                            <div class="row">

                                <div class="form-group col-md-6 mb-3">
                                    <label>Logo<span style="color: red;">*</span></label>
                                    <input type="file" name="footer_logo" id="footer_logo" class="form-control">
                                    @if ($errors->has('footer_logo'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('footer_logo') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">

                                    @if ($footer_cms->footer_logo != '')
                                        <img src="{{ Storage::url($footer_cms->footer_logo) }}" alt="preview image"
                                            style="height:250px; width:210px; background-color:black;" >
                                    @else
                                        <img id="preview-back-image"
                                            src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Image<span style="color: red;">*</span></label>
                                    <input type="file" name="footer_image" id="footer_image"
                                        class="form-control">
                                    @if ($errors->has('footer_image'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('footer_image') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">

                                    @if ($footer_cms->footer_image != '')
                                        <img src="{{ Storage::url($footer_cms->footer_image) }}"
                                            alt="preview image" style="height: 120px; width:525px; background-color:black;">
                                    @else
                                        <img id="preview-back-image"
                                            src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Logo Image Alt Tag</label>
                                    <input type="text" name="footer_logo_img_alt_tag" id="footer_logo_img_alt_tag" class="form-control" value="{{ $footer_cms->footer_logo_img_alt_tag ?? '' }}">
                                    @if ($errors->has('footer_logo_img_alt_tag'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('footer_logo_img_alt_tag') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Image Alt Tag<span style="color: red;">*</span></label>
                                    <input type="text" name="footer_image_img_alt_tag" id="footer_image_img_alt_tag"
                                        class="form-control" value="{{ $footer_cms->footer_image_img_alt_tag ?? '' }}">
                                    @if ($errors->has('footer_image_img_alt_tag'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('footer_image_img_alt_tag') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Background Image<span style="color: red;">*</span></label>
                                    <input type="file" name="footer_background" id="footer_background"
                                        class="form-control">
                                    @if ($errors->has('footer_background'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('footer_background') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">

                                    @if ($footer_cms->footer_background != '')
                                        <img src="{{ Storage::url($footer_cms->footer_background) }}"
                                            alt="preview image" style="max-height: 180px;">
                                    @else
                                        <img id="preview-back-image"
                                            src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image"
                                            style="max-height: 180px;">
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
