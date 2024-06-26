@extends('admin.layouts.master')
@section('title')
    OTT Icon Create
@endsection
@push('styles')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="breadcome-list">
            <div class="d-flex">
                <div class="arrow_left"><a href="{{ route('ott-service.index') }}" class="text-white"><i
                            class="ti ti-arrow-left"></i></a></div>
                <div class="">
                    <h3>Add OTT Icon</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a> <span class="bread-slash">/</span></li>
                        <li><span class="bread-blod"><a href="{{ route('ott-service.index') }}">OTT Icon</a></span><span class="bread-slash">/</span></li>
                        <li><span class="bread-blod">Create OTT Icon</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card w-100">
                    <div class="card-body">
                        <form action="{{ route('ott-service.store') }}" method="POST" id="project-create-form"
                            enctype="multipart/form-data">
                            @csrf
                            
                            <div class="row">
                                <div class="form-group col-md-6 mb-3">
                                    <label>Icon<span style="color: red;">*</span></label>
                                    <input type="file" name="icon" id="banner-img" class="form-control">
                                    @if ($errors->has('icon'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('icon') }}</div>
                                    @endif
                                </div>
                           
                                <div class="form-group col-md-6 mb-3">
                                    <img id="preview-banner-image" src="{{ asset('admin_assets/images/NoImageFound.jpg') }}"
                                        alt="preview image" style="max-height: 180px;">
                                </div>
                            </div>


                            <div class="w-100 text-end">
                                <button type="submit" class="print_btn">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $('#banner-img').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview-banner-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });

    </script>
@endpush
