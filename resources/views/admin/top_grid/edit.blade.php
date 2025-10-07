@extends('admin.layouts.master')
@section('title')
    Top Grid Edit
@endsection
@push('styles')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="breadcome-list">
            <div class="d-flex">
                <div class="arrow_left"><a href="{{ route('top-grid.index') }}" class="text-white"><i class="ti ti-arrow-left"></i></a></div>
                <div class="">
                    <h3>Edit Top Grid</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a> <span class="bread-slash">/</span></li>
                        <li><span class="bread-blod"><a href="{{ route('top-grid.index') }}">Top Grid</a></span><span
                                class="bread-slash">/</span></li>
                        <li><span class="bread-blod">Edit Top Grid</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card w-100">
                    <div class="card-body">
                        <form action="{{ route('update.top-grid') }}" method="POST" id="project-create-form"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">

                            <input type="hidden" name="id" value="{{ $top_grid->id }}">

                            <div class="form-group col-md-6 mb-3">
                                <label>Icon<span style="color: red;">*</span></label>
                                <input type="file" name="icon" id="banner-img" class="form-control">
                                @if ($errors->has('icon'))
                                    <div class="error" style="color:red;">
                                        {{ $errors->first('icon') }}</div>
                                @endif
                            </div>

                            @if ($top_grid->icon != '')
                                <img src="{{ Storage::url($top_grid->icon) }}"
                                    alt="preview image" style="height: 150px;width: 200px;">
                                @else
                                    <img id="preview-back-image"
                                        src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image"
                                        style="max-height: 150px;">
                                @endif

                            <div class="form-group col-md-6 mb-3">
                                <label>Icon Alt Tag</label>
                                <input type="text" name="img_alt_tag" placeholder="Enter icon alt tag"
                                    class="form-control" value="{{ $top_grid->img_alt_tag ?? ''}}">
                                @if ($errors->has('img_alt_tag'))
                                    <div class="error" style="color:red;">
                                        {{ $errors->first('img_alt_tag') }}</div>
                                @endif
                            </div>

                            <div class="form-group col-md-6 mb-3">
                                <label>Title<span style="color: red;">*</span></label>
                                <input type="text" name="title" placeholder="Enter title"
                                    class="form-control" value="{{ $top_grid->title }}">
                                @if ($errors->has('title'))
                                    <div class="error" style="color:red;">
                                        {{ $errors->first('title') }}</div>
                                @endif
                            </div>
                            <div class="form-group col-md-6 mb-3">
                                <label>Small Description<span style="color: red;">*</span></label>
                                <textarea name="description" class="form-control" rows="2" cols="3">{{ $top_grid->description }}</textarea>
                                @if ($errors->has('description'))
                                    <div class="error" style="color:red;">
                                        {{ $errors->first('description') }}</div>
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
