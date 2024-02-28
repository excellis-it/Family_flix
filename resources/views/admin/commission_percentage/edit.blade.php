@extends('admin.layouts.master')
@section('title')
    Commission Percentage Edit
@endsection
@push('styles')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="breadcome-list">
            <div class="d-flex">
                <div class="arrow_left"><a href="{{ route('commission-percentage.index') }}" class="text-white"><i
                            class="ti ti-arrow-left"></i></a></div>
                <div class="">
                    <h3>Edit Affiliate Commission</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a> <span class="bread-slash">/</span></li>
                        <li><span class="bread-blod"><a href="{{ route('commission-percentage.index') }}">Affiliate Commission</a></span><span class="bread-slash">/</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card w-100">
                    <div class="card-body">
                        <form action="{{ route('update.commission-percentage') }}" method="POST" 
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="form-group col-md-12 mb-3">
                                    <label>Affiliaters<span style="color: red;">*</span></label>
                                    <div class="multiselect-form affiliate-check">
                                    <select name="affiliaters[]" id="field2" multiple multiselect-search="true"
                                            multiselect-select-all="true" multiselect-max-items="3"
                                            onchange="console.log(this.selectedOptions)" >
                                            
                                            
                                                @foreach($affiliaters as $affiliater)
                                                    @php
                                                        $selected = false;
                                                        foreach($commi_affiliaters as $commi_affiliater) {
                                                            if($affiliater->id == $commi_affiliater->affiliate_id) {
                                                                $selected = true;
                                                                break;
                                                            }
                                                        }
                                                    @endphp
                                                    <option value="{{ $affiliater->id }}" {{ $selected ? 'selected' : '' }}>
                                                        {{ $affiliater->name }}
                                                    </option>
                                                @endforeach
                                       
                                            
                                    </select>
                                    </div>
                                    @if ($errors->has('affiliaters'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('affiliaters') }}</div>
                                    @endif
                                </div>


                                <div class="row">
                                    <div class="form-group col-md-12 mb-3">
                                        <label for="inputEnterYourName" class="col-form-label"> Percentage <span
                                                style="color: red;">*</span></label>
                                        <input type="text" name="percentage" value="{{ $affiliate_commission->percentage }}" class="form-control"
                                            placeholder="Enter percentage(%)">
                                        @if ($errors->has('percentage'))
                                            <div class="error" style="color:red;">
                                                {{ $errors->first('percentage') }}</div>
                                        @endif
                                    </div>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"
integrity="sha384-p34f1UUtsS3wqzfto5wAAmdvj+osOnFyQFpp4Ua3gs/ZVWx6oOypYoCJhGGScy+8" crossorigin="anonymous">
</script>
<script src="{{ asset('admin_assets/js/multiselect-dropdown.js') }}"></script>
    <script>
        $('#banner-img').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview-banner-image').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });


        $('#banner-logo').change(function() {
            let reader = new FileReader();
            reader.onload = (e) => {
                $('#preview-banner-logo').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        });
    </script>


    
@endpush
