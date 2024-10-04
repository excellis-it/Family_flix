@extends('admin.layouts.master')
@section('title')
Customer Send mail
@endsection
@push('styles')
@endpush
@section('content')
<div class="container-fluid">
    <div class="breadcome-list">
        <div class="d-flex">
            <div class="arrow_left"><a href="{{ route('customers.index') }}" class="text-white"><i
                        class="ti ti-arrow-left"></i></a></div>
            <div class="">
                <h3>Customer Send Mail</h3>
                <ul class="breadcome-menu mb-0">
                    <li><a href="{{ route('admin.dashboard') }}">Home</a> <span class="bread-slash">/</span></li>
                    <li><span class="bread-blod"><a href="{{ route('customers.index') }}">
                                Customer List</a></span><span class="bread-slash"></span></li>
                </ul>
            </div>
        </div>
    </div>
    <!--  Row 1 -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card w-100">
                <div class="card-body">
                    <form action="{{ route('customers.recharge-code-send') }}" method="POST" id="project-create-form"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6 mb-3">
                                <label for="inputEnterYourName" class="col-form-label"> Name <span
                                        style="color: red;">*</span></label>
                                <input type="text" name="name" id="" class="form-control" value="{{ $user->name }}"
                                    placeholder="Enter Name">
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                @if ($errors->has('name'))
                                <div class="error" style="color:red;">
                                    {{ $errors->first('name') }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="row">

                            <div class="form-group col-md-6 mb-3">
                                <label>Description<span style="color: red;">*</span></label>
                                <textarea name="mail_content" id="editor1" class="form-control"
                                    placeholder="Enter Content"></textarea>
                                @if ($errors->has('mail_content'))
                                <div class="error" style="color:red;">
                                    {{ $errors->first('mail_content') }}</div>
                                @endif
                            </div>
                            <div class="w-100 text-end">
                                <button type="submit" class="print_btn">Send Mail</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
</div>
@endsection

@push('scripts')

<script src="https://cdn.ckeditor.com/4.20.1/standard/ckeditor.js"></script>
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