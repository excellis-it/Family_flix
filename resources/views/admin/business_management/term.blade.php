@extends('admin.layouts.master')
@section('title')
   Term Management
@endsection
@push('styles')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="breadcome-list">
            <div class="d-flex">

                <div class="">
                    <h3>Term Management</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{ route('admin.dashboard') }}"></a> Home<span class="bread-slash">/</span></li>
                        
                        <li><span class="bread-blod">Term Management</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card w-100">
                    <div class="card-body">
                        <form action="{{ route('terms.management.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                           
                            <div class="row">

                                <input type="hidden" name="id" value="{{ $terms->id }}">

                                <h4 class="text-left">Banner Section</h4>
                                <hr>
                                <div class="form-group col-md-6 mb-3">
                                    <label>Banner Image<span style="color: red;">*</span></label>
                                    <input type="file" name="banner_image" id="banner_image" class="form-control">
                                    @if ($errors->has('banner_image'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('banner_image') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">

                                    @if ($terms->banner_image != '')
                                        <img src="{{ Storage::url($terms->banner_image) }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @else
                                        <img id="preview-back-image"
                                            src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image"
                                            style="max-height: 180px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-12 mb-3">
                                    <label>Banner Heading<span style="color: red;">*</span></label>
                                    <input type="text" name="banner_heading" value="{{ $terms->banner_heading }}"
                                        class="form-control" placeholder="Enter banner heading">
                                    @if ($errors->has('banner_heading'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('banner_heading') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-12 mb-3">
                                    <label>Main Content<span style="color: red;">*</span></label>
                                    <textarea name="content" id="editor1"
                                        class="form-control">{{ $terms->content }}</textarea>
                                    @if ($errors->has('content'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('content') }}</div>
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
    
    @endpush
