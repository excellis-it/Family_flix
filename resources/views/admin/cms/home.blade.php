@extends('admin.layouts.master')
@section('title')
    Home CMS
@endsection
@push('styles')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="breadcome-list">
            <div class="d-flex">

                <div class="">
                    <h3>Home Cms</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a> <span class="bread-slash">/</span></li>
                        <li><span class="bread-blod"><a href="{{ route('plan.index') }}">Cms</a></span><span
                                class="bread-slash">/</span></li>
                        <li><span class="bread-blod">Home</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card w-100">
                    <div class="card-body">
                        <form action="{{ route('home.cms.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <input type="hidden" value="{{ $home_cms->id }}" name="id"> 
                            <div class="row">
                                <h4 class="text-left">Banner Section</h4>
                                <hr>
                                <div class="form-group col-md-6 mb-3">
                                    <label>Top Background Image<span style="color: red;">*</span></label>
                                    <input type="file" name="top_back_image" id="top_back_image" class="form-control" >
                                    @if ($errors->has('top_back_image'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('top_back_image') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">    
                                    @if($home_cms->top_back_image !='')
                                    <img src="{{ Storage::url($home_cms->top_back_image) }}"
                                        alt="preview image" style="max-height: 180px;">
                                    @else
                                    <img id="preview-back-image"
                                        src="{{ asset('admin_assets/images/NoImageFound.jpg') }}"
                                        alt="preview image" style="max-height: 180px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Top Short Title<span style="color: red;">*</span></label>
                                    <input type="text" name="top_short_title" value="{{ $home_cms->top_short_title }}" class="form-control"
                                        placeholder="Enter short Title">
                                    @if ($errors->has('top_short_title'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('top_short_title') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Top Main Title<span style="color: red;">*</span></label>
                                    <input type="text" name="top_main_title"  value="{{ $home_cms->top_main_title }}" class="form-control"
                                        placeholder="Enter Main Title">
                                    @if ($errors->has('top_main_title'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('top_main_title') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Top Button text<span style="color: red;">*</span></label>
                                    <input type="text" name="top_button_text" value="{{ $home_cms->top_button_text }}" class="form-control"
                                        placeholder="Enter button Text">
                                    @if ($errors->has('top_button_text'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('top_button_text') }}</div>
                                    @endif
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <h4 class="text-left">Section 1</h4>
                                <hr>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Main Image<span style="color: red;">*</span></label>
                                    <input type="file" name="section1_main_image" id="section1_main_image" class="form-control">
                                    @if ($errors->has('section1_main_image'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section1_main_image') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">   
                                    @if($home_cms->section1_main_image !='') 
                                    <img src="{{ Storage::url($home_cms->section1_main_image) }}"
                                    alt="preview image" style="max-height: 180px;">
                                    @else
                                    <img id="preview-section1"
                                        src="{{ asset('admin_assets/images/NoImageFound.jpg') }}"
                                        alt="preview image" style="max-height: 180px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Background Image<span style="color: red;">*</span></label>
                                    <input type="file" name="section1_back_image" id="section1_back_image" class="form-control">
                                    @if ($errors->has('section1_back_image'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section1_back_image') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">    
                                    @if($home_cms->section1_back_image !='') 
                                    <img src="{{ Storage::url($home_cms->section1_back_image) }}"
                                    alt="preview image" style="max-height: 180px;">
                                    @else
                                    <img id="preview-section1-back"
                                        src="{{ asset('admin_assets/images/NoImageFound.jpg') }}"
                                        alt="preview image" style="max-height: 180px;">
                                    @endif    
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <h4 class="text-left">Section 2</h4>
                                <hr>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Main Image<span style="color: red;">*</span></label>
                                    <input type="file" name="section2_main_image" id="section2_main_image" class="form-control">
                                    @if ($errors->has('section2_main_image'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section2_main_image') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3"> 
                                    @if($home_cms->section2_main_image !='') 
                                    <img src="{{ Storage::url($home_cms->section2_main_image) }}"
                                    alt="preview image" style="max-height: 180px;">
                                    @else   
                                    <img id="preview-section2-img"
                                        src="{{ asset('admin_assets/images/NoImageFound.jpg') }}"
                                        alt="preview image" style="max-height: 180px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Background Image<span style="color: red;">*</span></label>
                                    <input type="file" name="section2_back_image" id="section2_back_image" class="form-control">
                                    @if ($errors->has('section2_back_image'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section2_back_image') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3"> 
                                    @if($home_cms->section2_back_image !='')  
                                    <img src="{{ Storage::url($home_cms->section2_back_image) }}"
                                    alt="preview image" style="max-height: 180px;">
                                    @else  
                                    <img id="preview-section2-back"
                                        src="{{ asset('admin_assets/images/NoImageFound.jpg') }}"
                                        alt="preview image" style="max-height: 180px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-12 mb-3">
                                    <label>Main Title<span style="color: red;">*</span></label>
                                    <input type="text" name="section2_title" id="" class="form-control"
                                        placeholder="Enter Section 2 Title" value="{{ $home_cms->section2_title }}">
                                    @if ($errors->has('section2_title'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section2_title') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Description<span style="color: red;">*</span></label>
                                    <textarea name="section2_description" id="" class="form-control" placeholder="Enter Section 2 Description" rows="4" cols="5"
                                        >{{ $home_cms->section2_description }}</textarea>
                                    @if ($errors->has('section2_description'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section2_description') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Short Title<span style="color: red;">*</span></label>
                                    <input type="text" name="section2_short_title"  class="form-control" placeholder="Enter Short title"  value="{{ $home_cms->section2_short_title }}"
                                        >
                                    @if ($errors->has('section2_short_title'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section2_short_title') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Section2 Main Icon<span style="color: red;">*</span></label>
                                    <input type="file" name="section2_main_icon" id="section2_main_icon" class="form-control">
                                    @if ($errors->has('section2_main_icon'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section2_main_icon') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3"> 
                                    @if($home_cms->section2_main_icon !='')
                                    <img src="{{ Storage::url($home_cms->section2_main_icon) }}" alt="preview image" style="max-height: 180px;">   
                                    @else  
                                    <img id="preview-section2-main"
                                        src="{{ asset('admin_assets/images/NoImageFound.jpg') }}"
                                        alt="preview image" style="max-height: 180px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-3 mb-3">
                                    <label>1st Small Icon<span style="color: red;">*</span></label>
                                    <input type="file" name="section2_icon1" id="section2_icon1" class="form-control">
                                    @if ($errors->has('section2_icon1'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section2_icon1') }}</div>
                                    @endif
                                    <br>
                                    @if($home_cms->section2_icon1 !='')
                                    <img src="{{ Storage::url($home_cms->section2_icon1) }}" alt="preview image" style="max-height: 180px;">   
                                    @else
                                    <img id="preview-section2-icon1"
                                    src="{{ asset('admin_assets/images/NoImageFound.jpg') }}"
                                    alt="preview image" style="max-height: 100px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-3 mb-3">
                                    <label>2nd Small Icon<span style="color: red;">*</span></label>
                                    <input type="file" name="section2_icon2" id="section2_icon2" class="form-control">
                                    @if ($errors->has('section2_icon2'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section2_icon2') }}</div>
                                    @endif
                                    <br>
                                    @if($home_cms->section2_icon2 !='')
                                    <img src="{{ Storage::url($home_cms->section2_icon2) }}" alt="preview image" style="max-height: 180px;">   
                                    @else
                                    <img id="preview-section2-icon2"
                                    src="{{ asset('admin_assets/images/NoImageFound.jpg') }}"
                                    alt="preview image" style="max-height: 100px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-3 mb-3">
                                    <label>3rd Small Icon<span style="color: red;">*</span></label>
                                    <input type="file" name="section2_icon3" id="section2_icon3" class="form-control">
                                    @if ($errors->has('section2_icon3'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section2_icon3') }}</div>
                                    @endif
                                    <br>
                                    @if($home_cms->section2_icon3 !='')
                                    <img src="{{ Storage::url($home_cms->section2_icon3) }}" alt="preview image" style="max-height: 180px;">   
                                    @else
                                    <img id="preview-section2-icon3"
                                    src="{{ asset('admin_assets/images/NoImageFound.jpg') }}"
                                    alt="preview image" style="max-height: 100px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-3 mb-3">
                                    <label>4th Small Icon<span style="color: red;">*</span></label>
                                    <input type="file" name="section2_icon4" id="section2_icon4" class="form-control">
                                    @if ($errors->has('section2_icon4'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section2_icon4') }}</div>
                                    @endif
                                    <br>
                                    @if($home_cms->section2_icon4 !='')
                                    <img src="{{ Storage::url($home_cms->section2_icon4) }}" alt="preview image" style="max-height: 180px;">   
                                    @else
                                    <img id="preview-section2-icon4"
                                    src="{{ asset('admin_assets/images/NoImageFound.jpg') }}"
                                    alt="preview image" style="max-height: 100px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-3 mb-3">
                                    <label>5th Small Icon<span style="color: red;">*</span></label>
                                    <input type="file" name="section2_icon5" id="section2_icon5" class="form-control">
                                    @if ($errors->has('section2_icon5'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section2_icon5') }}</div>
                                    @endif
                                    <br>
                                    @if($home_cms->section2_icon5 !='')
                                    <img src="{{ Storage::url($home_cms->section2_icon5) }}" alt="preview image" style="max-height: 180px;">   
                                    @else
                                    <img id="preview-section2-icon5"
                                    src="{{ asset('admin_assets/images/NoImageFound.jpg') }}"
                                    alt="preview image" style="max-height: 100px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-3 mb-3">
                                    <label>6th Small Icon<span style="color: red;">*</span></label>
                                    <input type="file" name="section2_icon6" id="section2_icon6" class="form-control">
                                    @if ($errors->has('section2_icon6'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section2_icon6') }}</div>
                                    @endif
                                    <br>
                                    @if($home_cms->section2_icon6 !='')
                                    <img src="{{ Storage::url($home_cms->section2_icon6) }}" alt="preview image" style="max-height: 180px;">   
                                    @else
                                    <img id="preview-section2-icon6"
                                    src="{{ asset('admin_assets/images/NoImageFound.jpg') }}"
                                    alt="preview image" style="max-height: 100px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-3 mb-3">
                                    <label>7th Small Icon<span style="color: red;">*</span></label>
                                    <input type="file" name="section2_icon7" id="section2_icon7" class="form-control">
                                    @if ($errors->has('section2_icon7'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section2_icon7') }}</div>
                                    @endif
                                    <br>
                                    @if($home_cms->section2_icon7 !='')
                                    <img src="{{ Storage::url($home_cms->section2_icon7) }}" alt="preview image" style="max-height: 180px;">   
                                    @else
                                    <img id="preview-section2-icon7"
                                    src="{{ asset('admin_assets/images/NoImageFound.jpg') }}"
                                    alt="preview image" style="max-height: 100px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-3 mb-3">
                                    <label>8th Small Icon<span style="color: red;">*</span></label>
                                    <input type="file" name="section2_icon8" id="section2_icon8" class="form-control">
                                    @if ($errors->has('section2_icon8'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section2_icon8') }}</div>
                                    @endif
                                    <br>
                                    @if($home_cms->section2_icon8 !='')
                                    <img src="{{ Storage::url($home_cms->section2_icon8) }}" alt="preview image" style="max-height: 180px;">   
                                    @else
                                    <img id="preview-section2-icon8"
                                    src="{{ asset('admin_assets/images/NoImageFound.jpg') }}"
                                    alt="preview image" style="max-height: 100px;">
                                    @endif
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <h4 class="text-left">Section 3</h4>
                                <hr>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Background Image<span style="color: red;">*</span></label>
                                    <input type="file" name="section3_back_image" id="section3_back_image" class="form-control">
                                    @if ($errors->has('section3_back_image'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section3_back_image') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3"> 
                                    @if($home_cms->section3_back_image !='')
                                    <img src="{{ Storage::url($home_cms->section3_back_image) }}" alt="preview image" style="max-height: 180px;">   
                                    @else   
                                    <img id="preview-section3-back"
                                        src="{{ asset('admin_assets/images/NoImageFound.jpg') }}"
                                        alt="preview image" style="max-height: 180px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Main Image<span style="color: red;">*</span></label>
                                    <input type="file" name="section3_main_image" id="section3_main_image" class="form-control">
                                    @if ($errors->has('section3_main_image'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section3_main_image') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">   
                                    @if($home_cms->section3_main_image !='')
                                    <img src="{{ Storage::url($home_cms->section3_main_image) }}" alt="preview image" style="max-height: 180px;">   
                                    @else    
                                    <img id="preview-section3-main-image"
                                        src="{{ asset('admin_assets/images/NoImageFound.jpg') }}"
                                        alt="preview image" style="max-height: 180px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Title<span style="color: red;">*</span></label>
                                    <input type="text" name="section3_title" id="" class="form-control"
                                        placeholder="Enter Section3 Title" value="{{ $home_cms->section3_title }}">
                                    @if ($errors->has('section3_title'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section3_title') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Video Link<span style="color: red;">*</span></label>
                                    <input type="text" name="section3_video_link" value="{{ $home_cms->section3_video_link }}" class="form-control"
                                        placeholder="Enter Video link">
                                    @if ($errors->has('section3_video_link'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section3_video_link') }}</div>
                                    @endif
                                </div>

                            </div>
                            <br>

                            <div class="row">
                                <h4 class="text-left">Section 4</h4>
                                <hr>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Title<span style="color: red;">*</span></label>
                                    <input type="text" name="section4_title" id="" class="form-control"
                                        placeholder="Enter Section4 Title" value="{{ $home_cms->section4_title }}">
                                    @if ($errors->has('section4_title'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section4_title') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Description<span style="color: red;">*</span></label>
                                    <textarea name="section4_description" id="" class="form-control" rows="4" cols="5"
                                        placeholder="Enter Section4 Description">{{ $home_cms->section4_description }}</textarea>
                                    @if ($errors->has('section4_description'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section4_description') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Background Image<span style="color: red;">*</span></label>
                                    <input type="file" name="section4_back_image" id="section4_back_image" class="form-control">
                                    @if ($errors->has('section4_back_image'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section4_back_image') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">  
                                    @if($home_cms->section4_back_image !='')
                                    <img src="{{ Storage::url($home_cms->section4_back_image) }}" alt="preview image" style="max-height: 180px;">   
                                    @else      
                                    <img id="preview-section4-back-img"
                                        src="{{ asset('admin_assets/images/NoImageFound.jpg') }}"
                                        alt="preview image" style="max-height: 180px;">
                                    @endif
                                </div>

                            </div>
                            <br>

                            <div class="row">
                                <h4 class="text-left">Section 5</h4>
                                <hr>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Background Image<span style="color: red;">*</span></label>
                                    <input type="file" name="section5_back_image" id="section5_back_image" class="form-control">
                                    @if ($errors->has('section5_back_image'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section5_back_image') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3"> 
                                    @if($home_cms->section5_back_image !='')
                                    <img src="{{ Storage::url($home_cms->section5_back_image) }}" alt="preview image" style="max-height: 180px;">   
                                    @else        
                                    <img id="preview-section5-back-img"
                                        src="{{ asset('admin_assets/images/NoImageFound.jpg') }}"
                                        alt="preview image" style="max-height: 180px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Main Image<span style="color: red;">*</span></label>
                                    <input type="file" name="section5_main_image" id="section5_main_image" class="form-control">
                                    @if ($errors->has('section5_main_image'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section5_main_image') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3"> 
                                    @if($home_cms->section5_main_image !='')
                                    <img src="{{ Storage::url($home_cms->section5_main_image) }}" alt="preview image" style="max-height: 180px;">   
                                    @else     
                                    <img id="preview-section5-main-img"
                                        src="{{ asset('admin_assets/images/NoImageFound.jpg') }}"
                                        alt="preview image" style="max-height: 180px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Title<span style="color: red;">*</span></label>
                                    <input type="text" name="section5_main_title" value="{{ $home_cms->section5_main_title }}" class="form-control"
                                        placeholder="Enter Section5 Title">
                                    @if ($errors->has('section5_main_title'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section5_main_title') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Description<span style="color: red;">*</span></label>
                                    <textarea name="section5_main_description" id="" class="form-control" rows="6" cols="8"
                                        placeholder="Enter Section5 Description">{{ $home_cms->section5_main_description }}</textarea>
                                    @if ($errors->has('section5_main_description'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section5_main_description') }}</div>
                                    @endif
                                </div>

                            </div>
                            <br>

                            <div class="row">
                                <h4 class="text-left">Plan Section</h4>
                                <hr>

                                <div class="form-group col-md-12 mb-3">
                                    <label>Title<span style="color: red;">*</span></label>
                                    <input type="text" name="plan_section_title" id="" class="form-control"
                                        placeholder="Enter Plan Section Title" value="{{ $home_cms->plan_section_title }}">
                                    @if ($errors->has('plan_section_title'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('plan_section_title') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Background Image<span style="color: red;">*</span></label>
                                    <input type="file" name="plan_section_back_image" id="plan_section_back_image" class="form-control">
                                     
                                    @if ($errors->has('plan_section_back_image'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('plan_section_back_image') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">  
                                    @if($home_cms->plan_section_back_image !='')
                                    <img src="{{ Storage::url($home_cms->plan_section_back_image) }}" alt="preview image" style="max-height: 180px;">   
                                    @else   
                                    <img id="preview-plan-back-img"
                                        src="{{ asset('admin_assets/images/NoImageFound.jpg') }}"
                                        alt="preview image" style="max-height: 180px;">
                                    @endif
                                </div>

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
    <script type="text/javascript">
        $(document).ready(function(e) {
            // top image preview
            $('#top_back_image').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-back-image').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
            // section1_main_image preview
            $('#section1_main_image').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-section1').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });

            // section1_back_image preview
            $('#section1_back_image').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-section1-back').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });

            // section2_main_image preview
            $('#section2_main_image').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-section2-img').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });

            // section2_back_image preview
            $('#section2_back_image').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-section2-back').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
            // section2_main_icon preview
            $('#section2_main_icon').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-section2-main').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
            // section2_1st_icon preview
            $('#section2_icon1').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-section2-icon1').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });

            //section2_icon2 preview
            $('#section2_icon2').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-section2-icon2').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }); 

            // section2_icon4 preview
            $('#section2_icon4').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-section2-icon4').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }); 

            //section2_icon5 preview
            $('#section2_icon5').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-section2-icon5').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }); 

            //section2_icon6 preview
            $('#section2_icon6').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-section2-icon6').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }); 

            //section2_icon7 preview
            $('#section2_icon7').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-section2-icon7').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }); 

            // section2_icon8 preview
            $('#section2_icon8').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-section2-icon8').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }); 

            // section3_back_image preview
            $('#section3_back_image').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-section3-back').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }); 
 
            //section3-main-image preview
            $('#section3_main_image').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-section3-main-image').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }); 
            //section4_back_image preview
            $('#section4_back_image').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-section4-back-img').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }); 
            //section5_back_image preview
            $('#section5_back_image').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-section5-back-img').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            }); 

            //section5_main_image preview
            $('#section5_main_image').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-section5-main-img').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });
            //plan_section_back_image preview
            $('#plan_section_back_image').change(function() {
                let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-plan-back-img').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
            });

            

        });
    </script>
@endpush
