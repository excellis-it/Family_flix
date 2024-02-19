@extends('admin.layouts.master')
@section('title')
    Movie CMS
@endsection
@push('styles')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="breadcome-list">
            <div class="d-flex">

                <div class="">
                    <h3>Movie Cms</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a> <span class="bread-slash">/</span></li>
                        <li><a href=""><span class="bread-blod">Movie</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card w-100">
                    <div class="card-body">
                        <form action="{{ route('movie-cms.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" value="{{ $movie_cms->id }}" name="id">
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

                                    @if ($movie_cms->banner_img != '')
                                        <img src="{{ Storage::url($movie_cms->banner_img) }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @else
                                        <img id="preview-back-image"
                                            src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Banner Heading<span style="color: red;">*</span></label>
                                    <input type="text" name="heading" value="{{ $movie_cms->heading }}"
                                        class="form-control" placeholder="Enter heading">
                                    @if ($errors->has('heading'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('heading') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Short Description<span style="color: red;">*</span></label>
                                    <textarea name="small_description" value="{{ $movie_cms->small_description }}" class="form-control" rows="6"
                                        cols="8">{{ $movie_cms->small_description }}</textarea>
                                    @if ($errors->has('small_description'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('small_description') }}</div>
                                    @endif
                                </div>

                                <h4 class="text-left">Banner Section</h4>
                                <hr>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Top 10 Show Section Background Image<span style="color: red;">*</span></label>
                                    <input type="file" name="top_10_show_background" id="top_10_show_background"
                                        class="form-control">
                                    @if ($errors->has('top_10_show_background'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('top_10_show_background') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    @if ($movie_cms->top_10_show_background != '')
                                        <img src="{{ Storage::url($movie_cms->top_10_show_background) }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @else
                                        <img id="preview-back-image"
                                            src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @endif
                                </div>


                                <div class="form-group col-md-6 mb-3">
                                    <label>Popular kids Section Background Image<span style="color: red;">*</span></label>
                                    <input type="file" name="popular_show_background" id="popular_show_background"
                                        class="form-control">
                                    @if ($errors->has('popular_show_background'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('popular_show_background') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">

                                    @if ($movie_cms->popular_show_background != '')
                                        <img src="{{ Storage::url($movie_cms->popular_show_background) }}"
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
