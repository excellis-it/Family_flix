@extends('admin.layouts.master')
@section('title')
    Plan Create
@endsection
@push('styles')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="breadcome-list">
            <div class="d-flex">
                <div class="arrow_left"><a href="{{ route('plan.index') }}" class="text-white"><i class="ti ti-arrow-left"></i></a></div>
                <div class="">
                    <h3>Add New Plan</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a> <span class="bread-slash">/</span></li>
                        <li><span class="bread-blod"><a href="{{ route('plan.index') }}">Plan</a></span><span
                                class="bread-slash">/</span></li>
                        <li><span class="bread-blod">Create New Plan</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card w-100">
                    <div class="card-body">
                        <form action="{{ route('plan.store') }}" method="POST" id="project-create-form" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6 mb-3">
                                    <label>Plan name<span
                                        style="color: red;">*</span></label>
                                    <input type="text" name="plan_name" id=""
                                        class="form-control" value="{{ old('plan_name') }}"
                                        placeholder="Enter Plan Name">
                                    @if ($errors->has('plan_name'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('plan_name') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    <label>Plan actual price($)<span
                                        style="color: red;">*</span></label>
                                    <input type="text" name="plan_actual_price" id=""
                                        class="form-control" value="{{ old('plan_actual_price') }}"
                                        placeholder="Enter Plan Actual Price">
                                    @if ($errors->has('plan_actual_price'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('plan_actual_price') }}</div>
                                    @endif
                                </div>
                                <div class="form-group col-md-6 mb-3">
                                    <label>Plan offer price($)<span
                                        style="color: red;">*</span></label>
                                    <input type="text" name="plan_offer_price" id=""
                                        class="form-control" value="{{ old('plan_offer_price') }}"
                                        placeholder="Enter Plan Offer Price">
                                    @if ($errors->has('plan_offer_price'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('plan_offer_price') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Plan button text<span
                                        style="color: red;">*</span></label>
                                    <input type="text" name="button_text" id=""
                                        class="form-control" value="{{ old('button_text') }}"
                                        placeholder="Enter Plan Actual Price">
                                    @if ($errors->has('button_text'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('button_text') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-12 mb-3">
                                    <label>Plan details<span
                                        style="color: red;">*</span></label>
                                    <textarea name="plan_details" id="" class="form-control"
                                        placeholder="Enter Plan Details">{{ old('plan_details') }}</textarea>
                                    @if ($errors->has('plan_details'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('plan_details') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Plan Specifications<span
                                        style="color: red;">*</span></label>
                                </div>

                                <div class="add-name">                     
                                    <div class="row">
                                        <div class="col-md-6 pb-3">
                                            <div style="display: flex">
                                                <input type="text" name="plan_specification[]"
                                                    class="form-control"
                                                    value=""
                                                    placeholder="Enter Plan Specification" id="">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <button type="button"
                                                class="btn btn-success add good-button"><i
                                                    class="fas fa-plus"></i> Add More
                                                Specification</button>
                                        </div>
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
    $(document).ready(function() {
        $(".add").click(function() {

            $(".add-name").append(
                '<div class="row"><div class="col-md-6 pb-3"><div style="display: flex"><input type="text" name="plan_specification[]" required class="form-control"  placeholder="Enter Plan Specification"></div> </div> <div class="col-md-6"><button type="button" class="btn btn-danger cross good-button"> <i class="fas fa-close"></i> Remove</button></div>'
            );
        });
    });

    $(document).on('click', '.cross', function() {
        // remove pareent div
        $(this).parent().parent().remove();
    });
</script>
  
@endpush
