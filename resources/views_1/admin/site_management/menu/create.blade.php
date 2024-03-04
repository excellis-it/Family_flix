@extends('admin.layouts.master')
@section('title')
    Menu Create
@endsection
@push('styles')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="breadcome-list">
            <div class="d-flex">
                <div class="arrow_left"><a href="{{ route('menu-management.index') }}" class="text-white"><i class="ti ti-arrow-left"></i></a></div>
                <div class="">
                    <h3>Add New Menu</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a> <span class="bread-slash">/</span></li>
                        <li><span class="bread-blod"><a href="{{ route('menu-management.index') }}">Menu</a></span><span
                                class="bread-slash">/</span></li>
                        <li><span class="bread-blod">Create New Menu</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card w-100">
                    <div class="card-body">
                        <form action="{{ route('menu-management.store') }}" method="POST" id="project-create-form" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6 mb-3">
                                    <label>Plan name</label>
                                        <select name="parent_id"  class="form-control">
                                            <option value="">Select a Parent Menu</option>
                                            @foreach ($parent_menus as $parent_menu)
                                                <option value="{{ $parent_menu->id }}">{{ $parent_menu->title }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('parent_id'))
                                            <div class="error" style="color:red;">
                                                {{ $errors->first('parent_id') }}</div>
                                        @endif
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    <label>Menu name<span
                                        style="color: red;">*</span></label>
                                    <input type="text" name="title" id=""
                                    class="form-control" 
                                    placeholder="Enter Menu Name">
                                    @if ($errors->has('title'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('title') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    <label>Status<span
                                        style="color: red;">*</span></label>
                                    <select name="status" id="" class="form-control">
                                        <option value="">Select Status</option>
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('status') }}</div>
                                    @endif
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
  
@endpush
