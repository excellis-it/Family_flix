@extends('admin.layouts.master')
@section('title')
   Faq Management
@endsection
@push('styles')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="breadcome-list">
            <div class="d-flex">

                <div class="">
                    <h3>Faq Management</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a> <span class="bread-slash">/</span></li>
                        <li><span class="bread-blod"><a href="">Faq Management</a></span></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card w-100">
                    <div class="card-body">
                        <form action="{{ route('faq.management.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <h4 class="text-left">Faq Content</h4>
                                <hr>

                                <input type="hidden" name="id" value="{{ $faq->id }}">
                                <div class="form-group col-md-6 mb-3">
                                    <label>Banner Image<span style="color: red;">*</span></label>
                                    <input type="file" name="banner_image" id="banner_image" class="form-control" onchange="previewImage()">
                                    @if ($errors->has('banner_image'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('banner_image') }}
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="form-group col-md-6 mb-3">
                                    @if($faq->banner_image != '')
                                        <img id="preview-image" src="{{ Storage::url($faq->banner_image) }}" alt="preview image" style="max-height: 180px;">
                                    @else
                                        <img id="preview-image" src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image" style="max-height: 180px;">
                                    @endif
                                </div>

                                <div class="form-group col-md-12 mb-3">
                                    <label>Banner Heading<span style="color: red;">*</span></label>
                                    <input type="text" name="banner_heading" value="{{ $faq->banner_heading }}"
                                        class="form-control" placeholder="Enter banner heading">
                                    @if ($errors->has('banner_heading'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('banner_heading') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-12 mb-3">
                                    <label>Faq Type<span style="color: red;">*</span></label>
                                    <select name="faq_type"  placeholder="Enter banner heading">
                                    @if ($errors->has('banner_heading'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('banner_heading') }}</div>
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

<script>
    function previewImage() {
        var preview = document.getElementById('preview-image');
        var fileInput = document.getElementById('banner_image');
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
