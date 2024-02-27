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
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a> <span class="bread-slash">/</span></li>
                       
                        <li><a href=""><span class="bread-blod">Home</span></a></li>
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
                                    <input type="file" name="top_back_image" id="top_back_image" class="form-control">
                                    @if ($errors->has('top_back_image'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('top_back_image') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    @if ($home_cms->top_back_image != '')
                                        <img src="{{ Storage::url($home_cms->top_back_image) }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @else
                                        <img id="preview-back-image"
                                            src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Top Short Title<span style="color: red;">*</span></label>
                                    <input type="text" name="top_short_title" value="{{ $home_cms->top_short_title }}"
                                        class="form-control" placeholder="Enter short Title">
                                    @if ($errors->has('top_short_title'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('top_short_title') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Top Main Title<span style="color: red;">*</span></label>
                                    <input type="text" name="top_main_title" value="{{ $home_cms->top_main_title }}"
                                        class="form-control" placeholder="Enter Main Title">
                                    @if ($errors->has('top_main_title'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('top_main_title') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Top Button text<span style="color: red;">*</span></label>
                                    <input type="text" name="top_button_text" value="{{ $home_cms->top_button_text }}"
                                        class="form-control" placeholder="Enter button Text">
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
                                    <input type="file" name="section1_main_image" id="section1_main_image"
                                        class="form-control">
                                    @if ($errors->has('section1_main_image'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section1_main_image') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    @if ($home_cms->section1_main_image != '')
                                        <img src="{{ Storage::url($home_cms->section1_main_image) }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @else
                                        <img id="preview-section1"
                                            src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Background Image<span style="color: red;">*</span></label>
                                    <input type="file" name="section1_back_image" id="section1_back_image"
                                        class="form-control">
                                    @if ($errors->has('section1_back_image'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section1_back_image') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    @if ($home_cms->section1_back_image != '')
                                        <img src="{{ Storage::url($home_cms->section1_back_image) }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @else
                                        <img id="preview-section1-back"
                                            src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Top Grid<span style="color: red;">*</span></label>
                                </div>
                                <div class="add-name">
                                    @foreach ($top_grids as $key => $vall)
                                        <div class="row">
                                            
                                            <div class="col-md-2 pb-3">
                                                <div style="display: flex">
                                                   
                                                    <img src="{{ Storage::url($vall->icon) }}"
                                                    id="grid-{{ $vall->id }}">
                                                </div>
                                                
                                            </div>
                                            <div class="col-md-3 pb-3">
                                                <div style="display: flex">
                                                    <input type="text" name="grid_title[]"
                                                        value="{{ $vall->title }}" class="form-control"
                                                        id="grid-{{ $vall->id }}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-5 pb-3">
                                                <div style="display: flex">
                                                    <textarea name="grid_description[]" class="form-control" id="grid-{{ $vall->id }}" readonly>{{ $vall->description }}</textarea>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-danger cross good-button remove-grid"
                                                    data-id="{{ $vall->id }}"> <i class="fas fa-close"></i>
                                                    Remove</button>
                                            </div>
                                        </div>
                                    @endforeach

                                    <button type="button" class="btn btn-success add good-button"><i
                                            class="fas fa-plus"></i> Add More Grid</button>
                                    <br>
                                    {{-- <div class="add-grid"> </div>         --}}
                                </div>
                            </div>
                            <br>

                            <div class="row">
                                <h4 class="text-left">Section 2</h4>
                                <hr>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Main Image<span style="color: red;">*</span></label>
                                    <input type="file" name="section2_main_image" id="section2_main_image"
                                        class="form-control">
                                    @if ($errors->has('section2_main_image'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section2_main_image') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    @if ($home_cms->section2_main_image != '')
                                        <img src="{{ Storage::url($home_cms->section2_main_image) }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @else
                                        <img id="preview-section2-img"
                                            src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Background Image<span style="color: red;">*</span></label>
                                    <input type="file" name="section2_back_image" id="section2_back_image"
                                        class="form-control">
                                    @if ($errors->has('section2_back_image'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section2_back_image') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    @if ($home_cms->section2_back_image != '')
                                        <img src="{{ Storage::url($home_cms->section2_back_image) }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @else
                                        <img id="preview-section2-back"
                                            src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image"
                                            style="max-height: 180px;">
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
                                    <textarea name="section2_description" id="" class="form-control" placeholder="Enter Section 2 Description"
                                        rows="4" cols="5">{{ $home_cms->section2_description }}</textarea>
                                    @if ($errors->has('section2_description'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section2_description') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Short Title<span style="color: red;">*</span></label>
                                    <input type="text" name="section2_short_title" class="form-control"
                                        placeholder="Enter Short title" value="{{ $home_cms->section2_short_title }}">
                                    @if ($errors->has('section2_short_title'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section2_short_title') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Section2 Main Icon<span style="color: red;">*</span></label>
                                    <input type="file" name="section2_main_icon" id="section2_main_icon"
                                        class="form-control">
                                    @if ($errors->has('section2_main_icon'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section2_main_icon') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    @if ($home_cms->section2_main_icon != '')
                                        <img src="{{ Storage::url($home_cms->section2_main_icon) }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @else
                                        <img id="preview-section2-main"
                                            src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @endif
                                </div>

                                
                                @foreach($ott_icons as $key => $ott_icon)
                                <div class="form-group col-md-3 mb-3">
                                    <label>{{ $key +1 }}st Small Icon<span style="color: red;">*</span></label>
                                    
                                    @if ($errors->has('ott_icon'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('ott_icon') }}</div>
                                    @endif
                                    <br>
                                    @if ($ott_icon->icon != '')
                                        <img src="{{ Storage::url($ott_icon->icon) }}" alt="preview image"
                                            style="max-height: 180px;">
                                            <a class="remove-ott-icon" href="javascript:void(0);" data-id="{{$ott_icon->id}}" style="display: inline;">&#215;</a>
                                
                                    @endif
                                </div>
                                @endforeach
                                

                                
                            </div>
                            <button type="button" class="btn btn-success add-ott good-button "><i
                                class="fas fa-plus"></i> Add More OTT Icon</button>
                                <br>

                                <div class="add-ott-icon pb-3"> </div>        
                            <br>

                            <div class="row">
                                <h4 class="text-left">Entertainment section</h4>
                                <hr>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Title<span style="color: red;">*</span></label>
                                    <input type="text" name="entertainment_title" value="{{ $home_cms->entertainment_title }}" class="form-control">
                                    @if ($errors->has('entertainment_title'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('entertainment_title') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Description<span style="color: red;">*</span></label>
                                    <textarea name="entertainment_description" class="form-control">{{ $home_cms->entertainment_description }}</textarea>
                                    @if ($errors->has('entertainment_description'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('entertainment_description') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Entertainment Image<span style="color: red;">*</span></label>
                                </div>
                                <div class="add-ent">
                                    @foreach ($entertainments as $key => $vall)
                                        <div class="row">
                                            
                                            <div class="col-md-5 pb-3">
                                                <div style="display: flex">
                                                    <img src="{{ Storage::url($vall->image) }}"
                                                        id="en-{{ $vall->id }}" width="200px;">
                                                </div>
                                            </div>
                                            <div class="col-md-5 pb-3">
                                                
                                                <div style="display: flex">
                                                    <input type="text" name="image_name[]"
                                                        value="{{ $vall->image_name }}" class="form-control"
                                                        id="en-{{ $vall->id }}" placeholder="Enter Image Name" readonly>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-danger cross good-button remove-ent"
                                                    data-id="{{ $vall->id }}"> <i class="fas fa-close"></i>
                                                    Remove</button>
                                            </div>
                                        </div>
                                    @endforeach

                                    <button type="button" class="btn btn-success ent-image good-button"><i
                                            class="fas fa-plus"></i> Add More Image</button>

                                    <div class="entr-image-add"> </div>        
                                </div>
                            </div>

                            <div class="row">
                                <h4 class="text-left">Section 3</h4>
                                <hr>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Background Image<span style="color: red;">*</span></label>
                                    <input type="file" name="section3_back_image" id="section3_back_image"
                                        class="form-control">
                                    @if ($errors->has('section3_back_image'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section3_back_image') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    @if ($home_cms->section3_back_image != '')
                                        <img src="{{ Storage::url($home_cms->section3_back_image) }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @else
                                        <img id="preview-section3-back"
                                            src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Main Image<span style="color: red;">*</span></label>
                                    <input type="file" name="section3_main_image" id="section3_main_image"
                                        class="form-control">
                                    @if ($errors->has('section3_main_image'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section3_main_image') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    @if ($home_cms->section3_main_image != '')
                                        <img src="{{ Storage::url($home_cms->section3_main_image) }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @else
                                        <img id="preview-section3-main-image"
                                            src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image"
                                            style="max-height: 180px;">
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
                                    <input type="text" name="section3_video_link"
                                        value="{{ $home_cms->section3_video_link }}" class="form-control"
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
                                    <input type="file" name="section4_back_image" id="section4_back_image"
                                        class="form-control">
                                    @if ($errors->has('section4_back_image'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section4_back_image') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    @if ($home_cms->section4_back_image != '')
                                        <img src="{{ Storage::url($home_cms->section4_back_image) }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @else
                                        <img id="preview-section4-back-img"
                                            src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @endif
                                </div>

                            </div>
                            <br>

                            <div class="row">
                                <h4 class="text-left">Section 5</h4>
                                <hr>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Background Image<span style="color: red;">*</span></label>
                                    <input type="file" name="section5_back_image" id="section5_back_image"
                                        class="form-control">
                                    @if ($errors->has('section5_back_image'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section5_back_image') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    @if ($home_cms->section5_back_image != '')
                                        <img src="{{ Storage::url($home_cms->section5_back_image) }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @else
                                        <img id="preview-section5-back-img"
                                            src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Main Image<span style="color: red;">*</span></label>
                                    <input type="file" name="section5_main_image" id="section5_main_image"
                                        class="form-control">
                                    @if ($errors->has('section5_main_image'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section5_main_image') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    @if ($home_cms->section5_main_image != '')
                                        <img src="{{ Storage::url($home_cms->section5_main_image) }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @else
                                        <img id="preview-section5-main-img"
                                            src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Title<span style="color: red;">*</span></label>
                                    <input type="text" name="section5_main_title"
                                        value="{{ $home_cms->section5_main_title }}" class="form-control"
                                        placeholder="Enter Section5 Title" >
                                    @if ($errors->has('section5_main_title'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('section5_main_title') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Description<span style="color: red;">*</span></label>
                                    <textarea name="section5_main_description" id="editor1" class="form-control" 
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
                                        placeholder="Enter Plan Section Title"
                                        value="{{ $home_cms->plan_section_title }}">
                                    @if ($errors->has('plan_section_title'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('plan_section_title') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Background Image<span style="color: red;">*</span></label>
                                    <input type="file" name="plan_section_back_image" id="plan_section_back_image"
                                        class="form-control">

                                    @if ($errors->has('plan_section_back_image'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('plan_section_back_image') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    @if ($home_cms->plan_section_back_image != '')
                                        <img src="{{ Storage::url($home_cms->plan_section_back_image) }}"
                                            alt="preview image" style="max-height: 180px;">
                                    @else
                                        <img id="preview-plan-back-img"
                                            src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image"
                                            style="max-height: 180px;">
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

    <script src="https://cdn.ckeditor.com/4.13.0/standard/ckeditor.js"></script>
    <script>
        CKEDITOR.replace('editor1');
        CKEDITOR.on('instanceReady', function(evt) {
            var editor = evt.editor;

            editor.on('change', function(e) {
                var contentSpace = editor.ui.space('contents');
                var ckeditorFrameCollection = contentSpace.$.getElementsByTagName('iframe');
                var ckeditorFrame = ckeditorFrameCollection[0];
                var innerDoc = ckeditorFrame.contentDocument;
                var innerDocTextAreaHeight = $(innerDoc.body).height();
                console.log(innerDocTextAreaHeight);
            });
        });
    </script>


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

<script>
    $(document).ready(function() {
        $(".add").click(function() {

            $(".add-name").append(
                '<div class="row"><div class="col-md-2 pb-3"><div style="display: flex"> <input type="file" name="grid_icon[]" class="form-control"></div> </div> <div class="col-md-3 pb-3"><div style = "display: flex"><input type = "text" name="grid_title[]"  class="form-control" ></div></div> <div class="col-md-5 pb-3"><div style="display: flex"><textarea name="grid_description[]" class="form-control"></textarea> </div></div><div class="col-md-2" ><button type="button" class="btn btn-danger cross good-button"><i class="fas fa-close"></i> Remove</button></div></div>'
            );
        });
    });

    $(document).on('click', '.cross', function() {
        // remove pareent div
        $(this).parent().parent().remove();
    });
</script>
{{-- ott icon --}}
<script>
    $(document).ready(function() {
        $(".add-ott").click(function() {

            $(".add-ott-icon").append(
                '<div class="row"><div class="col-md-6 pb-3"><div style="display: flex"> <input type="file" name="ott_icon[]" class="form-control"></div> </div> <div class="col-md-2" ><button type="button" class="btn btn-danger cross good-button"><i class="fas fa-close"></i> Remove</button></div></div>'
            );
        });
    });

    $(document).on('click', '.cross', function() {
        // remove pareent div
        $(this).parent().parent().remove();
    });
</script>
{{-- entertainment --}}
<script>
    $(document).ready(function() {
        $(".ent-image").click(function() {

            $(".entr-image-add").append(
                '<div class="row"><div class="col-md-5 pb-3"><div style="display: flex"><input type="file" name="entern_image[]" class="form-control"></div></div><div class="col-md-5 pb-3"><div style="display: flex"><input type="text" name="image_name[]" placeholder="Enter Image name" class="form-control"></div></div><div class="col-md-2"><button type="button" class="btn btn-danger cross good-button"><i class="fas fa-close"></i>Remove</button></div></div>'
            );
        });
    });

    $(document).on('click', '.cross', function() {
        // remove pareent div
        $(this).parent().parent().remove();
    });
</script>


<script>
    $('.remove-grid').on('click', function() {
        var result = confirm('Are you sure you want to delete?');

        if (result) {
            var id = $(this).attr('data-id');
            $.ajax({
                    url: "{{ route('delete.grid-image') }}",
                    type: "POST",
                    data: {
                        id: id,
                        _token: "{{ csrf_token() }}"
                    },
                success: function(response) {
                    $('#'+id).hide();
                }
            });
        }else{
            return false;
        }
    });
</script>

<script>
    $('.remove-ott-icon').on('click', function() {
        var result = confirm('Are you sure you want to delete?');
        
        if (result) {
            var id = $(this).attr('data-id');
            $.ajax({
                    url: "{{ route('delete.ott-icon') }}",
                    type: "POST",
                    data: {
                        id: id,
                        _token: "{{ csrf_token() }}"
                    },
                success: function(response) {
                    $('#'+id).hide();
                }
            });
        }else{
            return false;
        }
    });

    </script>

    <script>
        $('.remove-ent').on('click', function() {
            var result = confirm('Are you sure you want to delete?');
            
            if (result) {
                var id = $(this).attr('data-id');
                $.ajax({
                    url: "{{ route('delete.entertainment-image') }}",
                    type: "POST",
                    data: {
                        id: id,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        $('#'+id).hide();
                    }
                });
            }else{
                return false;
            }
        });

        
        </script>
@endpush
