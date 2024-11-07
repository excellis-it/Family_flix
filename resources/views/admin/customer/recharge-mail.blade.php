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
                                Customer Send Mail</a></span><span class="bread-slash"></span></li>
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
                                <label for="inputEnterYourName" class="col-form-label"> Name </label>
                                <input type="text" name="name" id="" class="form-control" value="{{ $user->name }}"
                                    placeholder="Enter Name" readonly>
                                    <input type="hidden" name="user_id" value="{{ $user->id }}">
                                @if ($errors->has('name'))
                                <div class="error" style="color:red;">
                                    {{ $errors->first('name') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label>Email Template<span style="color: red;">*</span></label>
                                <select name="email_id" class="form-control">
                                    <option value="">Select Email Template</option>
                                    @foreach($emails as $email)
                                    <option value="{{ $email->id }}">{{ $email->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('email_id'))
                                    <div class="error" style="color:red;">
                                        {{ $errors->first('email_id') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label for="inputEnterYourName" class="col-form-label"> Company Name </label>
                                <input type="text" name="company_name" id="" class="form-control" value="{{ old('company_name') }}"
                                    placeholder="Enter Login Information" >
                                @if ($errors->has('company_name'))
                                <div class="error" style="color:red;">
                                    {{ $errors->first('company_name') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 mb-3">
                                <label for="inputEnterYourName" class="col-form-label"> Login Information </label>
                                <input type="text" name="login_information" id="" class="form-control" value="{{ old('login_information') }}"
                                    placeholder="Enter Login Information" >
                                @if ($errors->has('login_information'))
                                <div class="error" style="color:red;">
                                    {{ $errors->first('login_information') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label for="inputEnterYourName" class="col-form-label"> Account Number </label>
                                <input type="text" name="account_number" id="" class="form-control" value="{{ old('account_number') }}"
                                    placeholder="Enter Account Number" >
                                @if ($errors->has('account_number'))
                                <div class="error" style="color:red;">
                                    {{ $errors->first('account_number') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label for="inputEnterYourName" class="col-form-label"> Password </label>
                                <input type="text" name="password" id="" class="form-control" value="{{ old('password') }}"
                                    placeholder="Enter Password" >
                                @if ($errors->has('password'))
                                <div class="error" style="color:red;">
                                    {{ $errors->first('password') }}</div>
                                @endif
                            </div>

                            <div class="w-100 text-end">
                                <button type="submit" class="print_btn">Send</button>
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
