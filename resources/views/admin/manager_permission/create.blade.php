@extends('admin.layouts.master')
@section('title')
   Manager Permission
@endsection
@push('styles')
@endpush
@section('content')

@php
    $modules = ['Profile','Affiliater','Customer','Plan', 'Product', 'Commission', 'Commission History', 'Manager',  'Entertainment Banner', 'Top Grid','Ott Platform', 'Cms','Business Management','Faq','Contactus','Coupon','Subscribers','Payment Detail', 'Wallet'];
@endphp
    <div class="container-fluid">
        <div class="breadcome-list">
            <div class="d-flex">

                <div class="">
                    <h3>Manager Permission</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Dashboard</a> <span class="bread-slash">/</span></li>
                        <li><a href=""><span class="bread-blod">Manager Permission</span></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card w-100">
                    <div class="card-body">
                        <form action="{{ route('manager-permission.submit') }}" method="POST" enctype="multipart/form-data">
                            @csrf  

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="role-label">
                                        <div class="row align-items-center">
                                          <div class="col-md-3">
                                             <label  for="inputEnterYourName" class="col-form-label">Role Name</label>
                                          </div>
                                          <div class="col-md-9">
                                            <input type="text" class="form-control" id="name" name="role_name" style="text-transform:uppercase" >
                                          </div>
                                        </div>
                                    </div>
                            
                                    <!--<div class="role-label">-->
                                    <!--    <div class="form-group row">-->
                                    <!--        <label  for="inputEnterYourName" class="col-form-label">Role Name</label>-->
                                    <!--            <input type="text" class="form-control" id="name" name="role_name" style="text-transform:uppercase" >-->
                                    <!--    </div>-->
                                    <!-- </div>-->
                                    @if ($errors->has('role_name'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('role_name') }}</div>
                                    @endif
                                    
                                </div>
                            </div>
                            
                            <div class="frm-head">
                               <h3>Permission</h3>
                            </div>
                            <div class="row">
                                <div class="container-fluid page__container">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 p-0">
                                            <div class="table-responsive border-bottom" data-toggle="lists">
                                                @if (!empty($permissions))
                                                
                                                <table class="table mb-0 table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 50px; text-align: center;">
                                                                <div class="">
                                                                    <input class="styled-checkbox" id="styled-checkbox-1" type="checkbox" value="value1">
                                                                    <label for="styled-checkbox-1"></label>
                                                                </div>
                                                            </th>
                                                            <th>Select All</th>
                                                            <th>Manage</th>
                                                            <th>Create</th>
                                                            <th>Update</th>
                                                            <th>Delete</th>
                                                            <th>View</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="list">
                                                        @foreach ($modules as $module)
                                                            <tr>
                                                                <td></td>
                                                                <td>{{ ucfirst($module) }} </td>
                                                                <td>
                                                                    @if (in_array('Manage ' . $module, (array) $permissions))
                                                                        @if ($key = array_search('Manage ' . $module, $permissions))
                                                                            <div class="toggle-check">
                                                                                <div class="form-check form-switch">
                                                                                    {{--   {{ Form::checkbox('permissions[]', $key, $role->permission, ['class' => 'form-check-input isscheck isscheck_' . str_replace(' ', '', $module), 'id' => 'permission' . $key]) }} --}}
                                                                                    <div class="button-switch">
                                                                                        <input type="checkbox" name="permissions[]" id="switch-orange" class="switch toggle-class-unbeatable" value="{{ $key }}"  />
                                                                                        <label for="switch-orange" class="lbl-off"></label>
                                                                                        <label for="switch-orange" class="lbl-on"></label>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if (in_array('Create ' . $module, (array) $permissions))
                                                                        @if ($key = array_search('Create ' . $module, $permissions))
                                                                            <div class="toggle-check">
                                                                                <div class="button-switch">
                                                                                    <input type="checkbox" id="switch-orange" name="permissions[]" class="switch toggle-class-unbeatable" value="{{ $key }}"   />
                                                                                    <label for="switch-orange" class="lbl-off"></label>
                                                                                    <label for="switch-orange" class="lbl-on"></label>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                </td>
        
                                                                <td>
                                                                    @if (in_array('Edit ' . $module, (array) $permissions))
                                                                        @if ($key = array_search('Edit ' . $module, $permissions))
                                                                            <div class="toggle-check">
                                                                                <div class="button-switch">
                                                                                    <input type="checkbox" id="switch-orange" name="permissions[]" class="switch toggle-class-unbeatable" value="{{ $key }}"   />
                                                                                    <label for="switch-orange" class="lbl-off"></label>
                                                                                    <label for="switch-orange" class="lbl-on"></label>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if (in_array('Delete ' . $module, (array) $permissions))
                                                                        @if ($key = array_search('Delete ' . $module, $permissions))
                                                                            <div class="toggle-check">
                                                                                <div class="button-switch">
                                                                                    <input type="checkbox" id="switch-orange" name="permissions[]" class="switch toggle-class-unbeatable" value="{{ $key }}"  />
                                                                                    <label for="switch-orange" class="lbl-off"></label>
                                                                                    <label for="switch-orange" class="lbl-on"></label>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    @if (in_array('View ' . $module, (array) $permissions))
                                                                        @if ($key = array_search('View ' . $module, $permissions))
                                                                            <div class="toggle-check">
                                                                                <div class="button-switch">
                                                                                    <input type="checkbox" id="switch-orange" name="permissions[]" class="switch toggle-class-unbeatable" value="{{ $key }}" />
                                                                                    <label for="switch-orange" class="lbl-off"></label>
                                                                                    <label for="switch-orange" class="lbl-on"></label>
                                                                                </div>
                                                                            </div>
                                                                        @endif
                                                                    @endif
                                                                </td>
                                                                
                                                            </tr>
                                                        @endforeach
        
                                                    </tbody>
                                                </table>
                                                @else
                                                    <p>No permissions available</p>
                                                @endif
                                                <span class="text-danger" id="permissions_msg"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if ($errors->has('permissions'))
                                <div class="error" style="color:red;">
                                    {{ $errors->first('permissions') }}</div>
                            @endif

                            <br>

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
    $(document).ready(function() {
        $("#styled-checkbox-1").click(function() {
            $('input:checkbox').prop('checked', this.checked);
        });

        // Handle individual checkboxes
        $('input:checkbox').not("#checkAll").click(function() {
            if (!this.checked) {
                $("#checkAll").prop('checked', false);
            }
        });
    });
</script>
@endpush
