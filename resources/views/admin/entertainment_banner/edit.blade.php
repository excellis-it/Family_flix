@extends('admin.layouts.master')
@section('title')
    Entertainment Banner Edit
@endsection
@push('styles')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="breadcome-list">
            <div class="d-flex">
                <div class="arrow_left"><a href="{{ route('entertainment-banner.index') }}" class="text-white"><i class="ti ti-arrow-left"></i></a></div>
                <div class="">
                    <h3> Edit Entertainment Banner</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a> <span class="bread-slash">/</span></li>
                        <li><span class="bread-blod"><a href="{{ route('entertainment-banner.index') }}">Entertainment Banner</a></span><span
                                class="bread-slash">/</span></li>
                        <li><span class="bread-blod">Edit Entertainment Banner</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card w-100">
                    <div class="card-body">
                        <form action="{{ route('update.entertainment-banner') }}" method="POST" id="project-create-form" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" name="id" value="{{ $banner_detail->id }}">
                            <div class="row">
                                <div class="form-group col-md-12 mb-3">
                                    <label>Banner For</label>
                                        <select name="banner_type"  class="form-control">
                                            <option value="Shows" {{ $banner_detail->banner_type == 'Shows' ? 'selected' : '' }}>Shows</option>
                                            <option value="Movies" {{ $banner_detail->banner_type == 'Movies' ? 'selected' : '' }}>Movies</option>
                                            <option value="Kids" {{ $banner_detail->banner_type == 'Kids' ? 'selected' : '' }}>Kids</option>
                                        </select>
                                        @if ($errors->has('banner_type'))
                                            <div class="error" style="color:red;">
                                                {{ $errors->first('banner_type') }}</div>
                                        @endif
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    <label>Banner Image<span
                                        style="color: red;">*</span></label>
                                    <input type="file" name="banner_image" id="banner-img"
                                    class="form-control" 
                                    >
                                    @if ($errors->has('banner_image'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('banner_image') }}</div>
                                    @endif
                                </div>
                                

                                @if ($banner_detail->banner_image != '')
                                <img src="{{ Storage::url($banner_detail->banner_image) }}"
                                    alt="preview image" style="height: 150px;width: 500px;">
                                @else
                                    <img id="preview-back-image"
                                        src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image"
                                        style="max-height: 180px;">
                                @endif

                                <div class="form-group col-md-6 mb-3">
                                    <label>Logo <span
                                        style="color: red;">*</span></label>
                                    <input type="file" name="banner_logo" id="banner-logo"
                                    class="form-control" 
                                    >
                                    @if ($errors->has('banner_logo'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('banner_logo') }}</div>
                                    @endif
                                </div>
                                

                                @if ($banner_detail->banner_logo != '')
                                <img src="{{ Storage::url($banner_detail->banner_logo) }}"
                                    alt="preview image" style="height: 150px;width: 200px;">
                                @else
                                    <img id="preview-back-image"
                                        src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image"
                                        style="max-height: 150px;">
                                @endif

                                <div class="form-group col-md-6 mb-3">
                                    <label>Small text<span style="color: red;">*</span></label>
                                    <input type="text" name="small_text" value="{{ $banner_detail->small_text }}" placeholder="Enter small text"
                                        class="form-control" >
                                    @if ($errors->has('small_text'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('small_text') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    <label>Long Description<span style="color: red;">*</span></label>
                                    <textarea name="long_description" 
                                        class="form-control"  rows="4" cols="6" >{{ $banner_detail->long_description }}</textarea>
                                    @if ($errors->has('long_description'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('long_description') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>IMDb Rating<span style="color: red;">*</span></label>
                                    <input type="text" name="rating" placeholder="Enter rating"
                                        class="form-control" value="{{ $banner_detail->rating }}">
                                    @if ($errors->has('rating'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('rating') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Button Name<span style="color: red;">*</span></label>
                                    <input type="text" name="button_name" placeholder="Enter button name"
                                        class="form-control" value="{{ $banner_detail->button_name }}">
                                    @if ($errors->has('button_name'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('button_name') }}</div>
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
