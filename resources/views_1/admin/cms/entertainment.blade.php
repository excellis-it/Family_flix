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
                        <form action="{{ route('entertainment.cms.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                           
                            <div class="row">

                                <input type="hidden" name="id" value="{{ $entertainment_cms->id }}">
                                
                                <div class="form-group col-md-6 mb-3">
                                    <label>Title<span style="color: red;">*</span></label>
                                    <input type="text" name="title" value="{{ $entertainment_cms->title }}" class="form-control">
                                    @if ($errors->has('title'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('title') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Description<span style="color: red;">*</span></label>
                                    <textarea name="description" class="form-control">{{ $entertainment_cms->description }}</textarea>
                                    @if ($errors->has('description'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('description') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Entertainment Image<span style="color: red;">*</span></label>
                                </div>
                                <div class="add-name">
                                    @foreach ($entertainments as $key => $vall)
                                        <div class="row">
                                            
                                            <div class="col-md-5 pb-3">
                                                <div style="display: flex">
                                                    <img src="{{ Storage::url($vall->image) }}"
                                                        id="en-{{ $vall->id }}">
                                                </div>
                                            </div>
                                            <div class="col-md-5 pb-3">
                                                
                                                <div style="display: flex">
                                                    <input type="text" name="image_name[]"
                                                        value="{{ $vall->image_name }}" class="form-control"
                                                        id="en-{{ $vall->id }}" placeholder="Enter Image Name">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-danger cross good-button"
                                                    data-id="{{ $vall->id }}"> <i class="fas fa-close"></i>
                                                    Remove</button>
                                            </div>
                                        </div>
                                    @endforeach

                                    <button type="button" class="btn btn-success add-image good-button"><i
                                            class="fas fa-plus"></i> Add More Image</button>

                                    <div class="add-entr-image"> </div>        
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
    
    @endpush
