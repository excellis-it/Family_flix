@extends('admin.layouts.master')
@section('title')
    About CMS
@endsection
@push('styles')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="breadcome-list">
            <div class="d-flex">

                <div class="">
                    <h3>About Cms</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a> <span class="bread-slash">/</span></li>
                        <li><a href=""><span class="bread-blod">About</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card w-100">
                    <div class="card-body">
                        <form action="{{ route('update.about-cms') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" value="{{ $about_cms->id }}" name="id">
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

                                    @if ($about_cms->banner_img != '')
                                        <img src="{{ Storage::url($about_cms->banner_img) }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @else
                                        <img id="preview-back-image"
                                            src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-12 mb-3">
                                    <label>Banner Heading<span style="color: red;">*</span></label>
                                    <input type="text" name="title" value="{{ $about_cms->title }}"
                                        class="form-control" placeholder="Enter title">
                                    @if ($errors->has('title'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('title') }}</div>
                                    @endif
                                </div>

                                <h4 class="text-left">Main Section</h4>
                                <hr>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Main Title<span style="color: red;">*</span></label>
                                    <input type="text" name="section1_title" value="{{ $about_cms->section1_title }}"
                                        class="form-control" placeholder="Enter main title">
                                    @if ($errors->has('section1_title'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section1_title') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Description<span style="color: red;">*</span></label>
                                    <textarea name="section1_description"
                                        class="form-control" >{{ $about_cms->section1_description }}</textarea>
                                    @if ($errors->has('section1_description'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section1_description') }}</div>
                                    @endif
                                </div>


                                <div class="form-group col-md-6 mb-3">
                                    <label>Section1 Image<span style="color: red;">*</span></label>
                                    <input type="file" name="section1_img" id="section1_img" class="form-control">
                                    @if ($errors->has('section1_img'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section1_img') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">

                                    @if ($about_cms->section1_img != '')
                                        <img src="{{ Storage::url($about_cms->section1_img) }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @else
                                        <img id="preview-back-image"
                                            src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Section1 Image Alt Tag</label>
                                    <input type="text" name="section1_img_alt_tag" id="section1_img_alt_tag" class="form-control" value="{{ $about_cms->section1_img_alt_tag ?? '' }}">
                                    @if ($errors->has('section1_img_alt_tag'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section1_img_alt_tag') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Section2 Title1<span style="color: red;">*</span></label>
                                    <input type="text" name="section2_title1" value="{{ $about_cms->section2_title1 }}"
                                        class="form-control" placeholder="Enter section2 title1">
                                    @if ($errors->has('section2_title1'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section2_title1') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Section2 Description1<span style="color: red;">*</span></label>
                                    <input type="text" name="section2_description1" value="{{ $about_cms->section2_description1 }}"
                                        class="form-control" placeholder="Enter map link">
                                    @if ($errors->has('section2_description1'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section2_description1') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Section2 Image2<span style="color: red;">*</span></label>
                                    <input type="file" name="section2_img2" id="section2_img2" class="form-control">
                                    @if ($errors->has('section2_img2'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section2_img2') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">

                                    @if ($about_cms->section2_img2 != '')
                                        <img src="{{ Storage::url($about_cms->section2_img2) }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @else
                                        <img id="preview-back-image"
                                            src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Section2 Image2 Alt Tag</label>
                                    <input type="text" name="section2_img_alt_tag" id="section2_img_alt_tag" class="form-control" value="{{ $about_cms->section2_img_alt_tag ?? '' }}">
                                    @if ($errors->has('section2_img_alt_tag'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section2_img_alt_tag') }}</div>
                                    @endif
                                </div>

                                <h4 class="text-left">Bottom Section</h4>
                                <hr>

                                <div class="form-group col-md-12 mb-3">
                                    <label> Main Title<span style="color: red;">*</span></label>
                                    <input type="text" name="section3_title" value="{{ $about_cms->section3_title }}"
                                        class="form-control" placeholder="Enter section3 title">
                                    @if ($errors->has('section3_title'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section3_title') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Background Image<span style="color: red;">*</span></label>
                                    <input type="file" name="section3_back_img" id="section3_back_img" class="form-control">
                                    @if ($errors->has('section3_back_img'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section3_back_img') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">

                                    @if ($about_cms->section3_back_img != '')
                                        <img src="{{ Storage::url($about_cms->section3_back_img) }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @else
                                        <img id="preview-back-image"
                                            src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Background Image Alt Tag</label>
                                    <input type="text" name="section3_back_img_alt_tag" id="section3_back_img_alt_tag" class="form-control" value="{{ $about_cms->section3_back_img_alt_tag ?? '' }}">
                                    @if ($errors->has('section3_back_img_alt_tag'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section3_back_img_alt_tag') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Title1<span style="color: red;">*</span></label>
                                    <input type="text" name="section3_title1" value="{{ $about_cms->section3_title1 }}"
                                        class="form-control" placeholder="Enter section3 title1">
                                    @if ($errors->has('section3_title1'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section3_title1') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Description1<span style="color: red;">*</span></label>
                                    <textarea name="section3_description1" value="{{ $about_cms->section3_description1 }}"
                                        class="form-control" placeholder="Enter map link">{{ $about_cms->section3_description1 }}</textarea>
                                    @if ($errors->has('section3_description1'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section3_description1') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Image1<span style="color: red;">*</span></label>
                                    <input type="file" name="section3_image1" id="section3_image1" class="form-control">
                                    @if ($errors->has('section3_image1'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section3_image1') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">

                                    @if ($about_cms->section3_image1 != '')
                                        <img src="{{ Storage::url($about_cms->section3_image1) }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @else
                                        <img id="preview-back-image"
                                            src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Image1 Alt Tag</label>
                                    <input type="text" name="section3_img1_alt_tag" id="section3_img1_alt_tag" class="form-control" value="{{ $about_cms->section3_img1_alt_tag ?? '' }}">
                                    @if ($errors->has('section3_img1_alt_tag'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section3_img1_alt_tag') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Title2<span style="color: red;">*</span></label>
                                    <input type="text" name="section3_title2" value="{{ $about_cms->section3_title2 }}"
                                        class="form-control" placeholder="Enter section3 title1">
                                    @if ($errors->has('section3_title2'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section3_title2') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Description2<span style="color: red;">*</span></label>
                                    <textarea name="section3_description2" value="{{ $about_cms->section3_description2 }}"
                                        class="form-control" placeholder="Enter map link">{{ $about_cms->section3_description2 }}</textarea>
                                    @if ($errors->has('section3_description2'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section3_description2') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Image2<span style="color: red;">*</span></label>
                                    <input type="file" name="section3_image2" id="section3_image2" class="form-control">
                                    @if ($errors->has('section3_image2'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section3_image2') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">

                                    @if ($about_cms->section3_image2 != '')
                                        <img src="{{ Storage::url($about_cms->section3_image2) }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @else
                                        <img id="preview-back-image"
                                            src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Image2 Alt Tag</label>
                                    <input type="text" name="section3_img2_alt_tag" id="section3_img2_alt_tag" class="form-control" value="{{ $about_cms->section3_img2_alt_tag ?? '' }}">
                                    @if ($errors->has('section3_img2_alt_tag'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section3_img2_alt_tag') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Title3<span style="color: red;">*</span></label>
                                    <input type="text" name="section3_title3" value="{{ $about_cms->section3_title3 }}"
                                        class="form-control" placeholder="Enter section3 title1">
                                    @if ($errors->has('section3_title3'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section3_title3') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Description3<span style="color: red;">*</span></label>
                                    <textarea name="section3_description3" value="{{ $about_cms->section3_description3 }}"
                                        class="form-control" placeholder="Enter map link">{{ $about_cms->section3_description3 }}</textarea>
                                    @if ($errors->has('section3_description3'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section3_description3') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Image3<span style="color: red;">*</span></label>
                                    <input type="file" name="section3_image3" id="section3_image3" class="form-control">
                                    @if ($errors->has('section3_image3'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section3_image3') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">

                                    @if ($about_cms->section3_image3 != '')
                                        <img src="{{ Storage::url($about_cms->section3_image3) }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @else
                                        <img id="preview-back-image"
                                            src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Image3 Alt Tag</label>
                                    <input type="text" name="section3_img3_alt_tag" id="section3_img3_alt_tag" class="form-control" value="{{ $about_cms->section3_img3_alt_tag ?? '' }}">
                                    @if ($errors->has('section3_img3_alt_tag'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section3_img3_alt_tag') }}</div>
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
                                        value="{{ old('meta_title', $about_cms->meta_title ?? '') }}">
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
                                        value="{{ old('meta_keyword', $about_cms->meta_keyword ?? '') }}">
                                    @if ($errors->has('meta_keyword'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('meta_keyword') }}
                                        </div>
                                    @endif
                                </div>

                                {{-- Meta Description --}}
                                <div class="form-group col-md-12 mb-3">
                                    <label>Meta Description</label>
                                    <textarea name="meta_description" class="form-control" rows="3" placeholder="Enter Meta Description">{{ old('meta_description', $about_cms->meta_description ?? '') }}</textarea>
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
