@extends('admin.layouts.master')
@section('title')
    Customer Edit
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
                    <h3>Edit Customer</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a> <span class="bread-slash">/</span></li>
                        <li><span class="bread-blod"><a href="{{ route('customers.index') }}">
                                    List</a></span><span class="bread-slash">/</span></li>
                        <li><span class="bread-blod">Edit Customer</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card w-100">
                    <div class="card-body">
                        <h5 class="font-weight-bold pb-3">Placeholders</h5>
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="card">
                                <div class="card-header card-body">
                                    <div class="row text-xs">

                                        <div class="row">
                                            @if ($email->id == 2)
                                                <p class="col-4">Customer Name : <span
                                                        class="pull-end text-primary">{customer_name}</span></p>
                                                <p class="col-4">Rental Code : <span
                                                        class=" text-primary">{rental_code}</span></p>
                                                <p class="col-4">Company Name : <span
                                                        class=" text-primary">{company_name}</span>
                                                </p>
                                            @else
                                                <p class="col-4">Customer Name : <span
                                                        class="pull-end text-primary">{customer_name}</span></p>
                                                <p class="col-4">Login Information : <span
                                                        class=" text-primary">{login_information}</span></p>
                                                <p class="col-4">Account Number : <span
                                                        class=" text-primary">{account_number}</span></p>
                                                <p class="col-4">Company Name : <span
                                                        class=" text-primary">{company_name}</span>
                                                </p>
                                                <p class="col-4">Password : <span class=" text-primary">{password}</span>
                                                </p>
                                            @endif

                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <form action="{{ route('emails.update', $email->id) }}" method="POST" id="project-create-form"
                            enctype="multipart/form-data">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6 mb-3">
                                    <label for="inputEnterYourName" class="col-form-label"> Template Name <span
                                            style="color: red;">*</span></label>
                                    <input type="text" name="name" id="" class="form-control"
                                        value="{{ $email->name ?? '' }}" placeholder="Enter Name">
                                    @if ($errors->has('name'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('name') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    <label for="inputEnterYourName" class="col-form-label"> Mail Subject <span
                                            style="color: red;">*</span></label>
                                    <input type="text" name="subject" id="" class="form-control"
                                        value="{{ $email->subject ?? '' }}" placeholder="Enter Mail Subject">
                                    @if ($errors->has('subject'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('subject') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-12 mb-3">
                                    <label for="inputEnterYourName" class="col-form-label">Mail Title <span
                                            style="color: red;">*</span></label>
                                    <input type="text" name="title" id="" class="form-control"
                                        value="{{ $email->title ?? '' }}" placeholder="Enter Mail Title">
                                    @if ($errors->has('title'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('title') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-12 mb-3">
                                    <label>Mail Content<span style="color: red;">*</span></label>
                                    <textarea name="content" id="content" class="form-control" placeholder="Enter Mail Content">{{ $email->content ?? '' }}</textarea>
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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
        // ClassicEditor.create(document.querySelector("#description"));
        $('#content').summernote({
            placeholder: 'Enter Mail Content*',
            tabsize: 2,
            height: 400
        });
    </script>
@endpush
