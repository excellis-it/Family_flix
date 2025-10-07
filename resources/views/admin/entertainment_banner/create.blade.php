@extends('admin.layouts.master')
@section('title')
    Entertainment Banner Create
@endsection
@push('styles')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="breadcome-list">
            <div class="d-flex">
                <div class="arrow_left"><a href="{{ route('entertainment-banner.index') }}" class="text-white"><i
                            class="ti ti-arrow-left"></i></a></div>
                <div class="">
                    <h3>Add New Entertainment Banner</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a> <span class="bread-slash">/</span></li>
                        <li><span class="bread-blod"><a href="{{ route('entertainment-banner.index') }}">Entertainment
                                    Banner</a></span><span class="bread-slash">/</span></li>
                        <li><span class="bread-blod">Create Entertainment Banner</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card w-100">
                    <div class="card-body">
                        <form action="{{ route('entertainment-banner.store') }}" method="POST" id="project-create-form"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-12 mb-3">
                                    <label>Banner For</label>
                                    <select name="banner_type" class="form-control">
                                        <option value="">Select Type</option>
                                        <option value="Shows">Shows</option>
                                        <option value="Movies">Movies</option>
                                        <option value="Kids">Kids</option>
                                    </select>
                                    @if ($errors->has('banner_type'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('banner_type') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    <label>Banner Image<span style="color: red;">*</span></label>
                                    <input type="file" name="banner_image" id="banner-img" class="form-control">
                                    @if ($errors->has('banner_image'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('banner_image') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <img id="preview-banner-image" src="{{ asset('admin_assets/images/NoImageFound.jpg') }}"
                                        alt="preview image" style="max-height: 180px;">
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Logo <span style="color: red;">*</span></label>
                                    <input type="file" name="banner_logo" id="banner-logo" class="form-control">
                                    @if ($errors->has('banner_logo'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('banner_logo') }}</div>
                                    @endif
                                </div>


                                <div class="form-group col-md-6 mb-3">
                                    <img id="preview-banner-logo" src="{{ asset('admin_assets/images/NoImageFound.jpg') }}"
                                        alt="preview image" style="max-height: 180px;">
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    <label>Banner Image Alt Tag</label>
                                    <input type="text" name="img_alt_tag" id="img_alt_tag" class="form-control">
                                    @if ($errors->has('img_alt_tag'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('img_alt_tag') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Small text<span style="color: red;">*</span></label>
                                    <input type="text" name="small_text" placeholder="Enter small text"
                                        class="form-control">
                                    @if ($errors->has('small_text'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('small_text') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    <label>Long Description<span style="color: red;">*</span></label>
                                    <textarea name="long_description" class="form-control" rows="4" cols="6"></textarea>
                                    @if ($errors->has('long_description'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('long_description') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>IMDb Rating<span style="color: red;">*</span></label>
                                    <input type="text" name="rating" placeholder="Enter rating" class="form-control">
                                    @if ($errors->has('rating'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('rating') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Button Name<span style="color: red;">*</span></label>
                                    <input type="text" name="button_name" placeholder="Enter button name"
                                        class="form-control">
                                    @if ($errors->has('button_name'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('button_name') }}</div>
                                    @endif
                                </div>


                                <div class="w-100 text-end">
                                    <button type="submit" class="print_btn">Create</button>
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
