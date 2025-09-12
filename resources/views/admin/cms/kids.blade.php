@extends('admin.layouts.master')
@section('title')
    Kid CMS
@endsection
@push('styles')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="breadcome-list">
            <div class="d-flex">

                <div class="">
                    <h3>Kid Cms</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a> <span class="bread-slash">/</span></li>
                        <li><a href=""><span class="bread-blod">Kid</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card w-100">
                    <div class="card-body">
                        <form action="{{ route('kid-cms.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" value="{{ $kid_cms->id }}" name="id">
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

                                    @if ($kid_cms->banner_img != '')
                                        <img src="{{ Storage::url($kid_cms->banner_img) }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @else
                                        <img id="preview-back-image"
                                            src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Banner Heading<span style="color: red;">*</span></label>
                                    <input type="text" name="heading" value="{{ $kid_cms->heading }}"
                                        class="form-control" placeholder="Enter heading">
                                    @if ($errors->has('heading'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('heading') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Short Description<span style="color: red;">*</span></label>
                                    <textarea name="small_description" value="{{ $kid_cms->small_description }}" class="form-control" rows="6"
                                        cols="8">{{ $kid_cms->small_description }}</textarea>
                                    @if ($errors->has('small_description'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('small_description') }}</div>
                                    @endif
                                </div>

                                <h4 class="text-left">Top 10 Show</h4>
                                <hr>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Background Image<span style="color: red;">*</span></label>
                                    <input type="file" name="top_10_show_background" id="top_10_show_background"
                                        class="form-control">
                                    @if ($errors->has('top_10_show_background'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('top_10_show_background') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    @if ($kid_cms->top_10_show_background != '')
                                        <img src="{{ Storage::url($kid_cms->top_10_show_background) }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @else
                                        <img id="preview-back-image"
                                            src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @endif
                                </div>

                                <h4 class="text-left">Popular kids</h4>
                                <hr>


                                <div class="form-group col-md-6 mb-3">
                                    <label>Background Image<span style="color: red;">*</span></label>
                                    <input type="file" name="popular_show_background" id="popular_show_background"
                                        class="form-control">
                                    @if ($errors->has('popular_show_background'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('popular_show_background') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">

                                    @if ($kid_cms->popular_show_background != '')
                                        <img src="{{ Storage::url($kid_cms->popular_show_background) }}"
                                            alt="preview image" style="max-height: 180px;">
                                    @else
                                        <img id="preview-back-image"
                                            src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @endif
                                </div>

                            </div>
                            <div class="row">
                                <h4 class="text-left">SEO Section</h4>
                                <hr>

                                {{-- Meta Title --}}
                                <div class="form-group col-md-12 mb-3">
                                    <label>Meta Title</label>
                                    <input type="text" name="meta_title" class="form-control"
                                        placeholder="Enter Meta Title"
                                        value="{{ old('meta_title', $kid_cms->meta_title ?? '') }}">
                                    @if ($errors->has('meta_title'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('meta_title') }}
                                        </div>
                                    @endif
                                </div>

                                {{-- Meta Keyword --}}
                                <div class="form-group col-md-12 mb-3">
                                    <label>Meta Keyword</label>
                                    <input type="text" name="meta_keyword" class="form-control"
                                        placeholder="Enter Meta Keyword"
                                        value="{{ old('meta_keyword', $kid_cms->meta_keyword ?? '') }}">
                                    @if ($errors->has('meta_keyword'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('meta_keyword') }}
                                        </div>
                                    @endif
                                </div>

                                {{-- Meta Description --}}
                                <div class="form-group col-md-12 mb-3">
                                    <label>Meta Description</label>
                                    <textarea name="meta_description" class="form-control" rows="3" placeholder="Enter Meta Description">{{ old('meta_description', $kid_cms->meta_description ?? '') }}</textarea>
                                    @if ($errors->has('meta_description'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('meta_description') }}
                                        </div>
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
