@extends('admin.layouts.master')
@section('title')
    {{ env('APP_NAME') }} | Edit Menu
@endsection
@push('styles')
@endpush

@section('content')
    <div class="page-wrapper">

        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col">
                        <h3 class="page-title">Edit</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('menu-management.index') }}">Menu</a>
                            </li>
                            <li class="breadcrumb-item active">Edit Menu</li>
                        </ul>
                    </div>
                    <div class="col-auto float-end ms-auto">
                        {{-- <a href="#" class="btn add-btn" data-bs-toggle="modal" data-bs-target="#add_group"><i
                            class="fa fa-plus"></i> Add Account manager</a> --}}
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="row">
                            <div class="col-xl-12 mx-auto">
                                <h6 class="mb-0 text-uppercase">Edit Menu</h6>
                                <hr>
                                <div class="border-0 border-4">
                                    <div class="card-body">
                                        <form action="{{ route('admin.menu-management.update', $menu->id) }}" method="post"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="border p-4 rounded">
                                                <div class="row">

                                                    <input type="text" name="id" value="{{ $menu->id }}" hidden>
                                                    <div class="col-md-6">
                                                        <label for="inputEnterYourName" class="col-form-label">Parent Menu </label>
                                                        <select name="parent_id"  class="form-control">
                                                            <option value="">Select a Parent Menu</option>
                                                            @foreach ($parent_menus as $parent_menu)
                                                                <option value="{{ $parent_menu->id }}"  {{ $menu->parent_id ==  $parent_menu->id ? 'selected' : '' }}>{{ $parent_menu->title }}</option>
                                                            @endforeach
                                                        </select>
                                                        @if ($errors->has('parent_id'))
                                                            <div class="error" style="color:red;">
                                                                {{ $errors->first('parent_id') }}</div>
                                                        @endif
                                                    </div>

                                                    <div class="col-md-6">
                                                        <label for="inputEnterYourName" class="col-form-label"> Menu name <span
                                                                style="color: red;">*</span></label>
                                                        <input type="text" name="title" id=""
                                                            class="form-control" value="{{ $menu->title }}"
                                                            placeholder="Enter Menu Name">
                                                        @if ($errors->has('title'))
                                                            <div class="error" style="color:red;">
                                                                {{ $errors->first('title') }}</div>
                                                        @endif
                                                    </div>
                                                   
                                                    <div class="col-md-6">
                                                        <label for="inputEnterYourName" class="col-form-label"> Status
                                                            <span style="color: red;">*</span></label>
                                                        <select name="status" id="" class="form-control">
                    
                                                            <option value="1" {{ $menu->status== '1' ? 'selected':'' }}>Active</option>
                                                            <option value="0" {{ $menu->status== '0' ? 'selected':'' }}>Inactive</option>
                                                        </select>
                                                        @if ($errors->has('status'))
                                                            <div class="error" style="color:red;">
                                                                {{ $errors->first('status') }}</div>
                                                        @endif
                                                    </div>
                                                   
                                                    <div class="row" style="margin-top: 20px; float: left;">
                                                        <div class="col-sm-9">
                                                            <button type="submit"
                                                                class="btn px-5 submit-btn">Update</button>
                                                        </div>
                                                    </div>
                                                </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection

@push('scripts')


@endpush
