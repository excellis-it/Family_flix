@extends('admin.layouts.master')
@section('title')
    Menu Edit
@endsection
@push('styles')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="breadcome-list">
            <div class="d-flex">
                <div class="arrow_left"><a href="{{ route('menu-management.index') }}" class="text-white"><i class="ti ti-arrow-left"></i></a></div>
                <div class="">
                    <h3>Edit New Menu</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a> <span class="bread-slash">/</span></li>
                        <li><span class="bread-blod"><a href="{{ route('menu-management.index') }}">Menu</a></span><span
                                class="bread-slash">/</span></li>
                        <li><span class="bread-blod">Edit New Menu</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card w-100">
                    <div class="card-body">
                        <form action="{{ route('admin.menu-management.update') }}" method="POST" id="project-create-form" enctype="multipart/form-data">
                            @csrf

                            <input type="text" name="id" value="{{ $menu->id }}" hidden>
                            <div class="row">
                                <div class="form-group col-md-6 mb-3">
                                    <label>Parent Menu<span
                                        style="color: red;">*</span></label>
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
                                <div class="form-group col-md-6 mb-3">
                                    <label>Menu name<span
                                        style="color: red;">*</span></label>
                                    <input type="text" name="title" id=""
                                    class="form-control" value="{{ $menu->title }}"
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
                    
                                        <option value="1" {{ $menu->status== '1' ? 'selected':'' }}>Active</option>
                                        <option value="0" {{ $menu->status== '0' ? 'selected':'' }}>Inactive</option>
                                    </select>
                                    @if ($errors->has('status'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('status') }}</div>
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
  
@endpush
