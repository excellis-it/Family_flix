@extends('admin.layouts.master')
@section('title')
    Contact Details 
@endsection
@push('styles')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="breadcome-list">
            <div class="d-flex">

                <div class="">
                    <h3>Contact Details</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Contact Detail</a> <span class="bread-slash">/</span></li>
                        
                        
                    </ul>
                </div>
            </div>
        </div>
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card w-100">
                    <div class="card-body">
                        <form action="{{ route('update.contact-details.cms') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                           
                            <div class="row">
                                <div class="add-name">
                                    @foreach($contact_details as $contact_detail)
                                        <div class="row">
                                            
                                            <div class="col-md-3 pb-3">
                                                <div style="display: flex">
                                                    <input type="text" class="form-control" name="icon[]" placeholder="Enter icon" value="{{ $contact_detail->icon }}" id="cont-{{ $contact_detail->id }}">
                                                </div>
                                            </div>
                                            <div class="col-md-4 pb-3">                                         
                                                <div style="display: flex">
                                                    <input type="text" class="form-control" name="title[]" placeholder="Enter title" value="{{ $contact_detail->title }}" id="cont-{{ $contact_detail->id }}">
                                                </div>
                                            </div>
                                            <div class="col-md-3 pb-3">                                         
                                                <div style="display: flex">
                                                    <input type="text" class="form-control" name="details[]" placeholder="Enter details" value="{{ $contact_detail->details }}" id="cont-{{ $contact_detail->id }}">
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-danger cross good-button"
                                                    data-id="{{ $contact_detail->id }}"> <i class="fas fa-close"></i>
                                                    Remove</button>
                                            </div>
                                        </div>
                                    @endforeach

                                    <button type="button" class="btn btn-success add-contact-details good-button"><i
                                            class="fas fa-plus"></i> Add More Details</button>

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

    <script>
        $(document).ready(function() {
            $(".add-contact-details").click(function() {
            
                $(".add-name").append(
                    '<div class="row"><div class="col-md-3 pb-3"><div style="display: flex"><input type="text" class="form-control" name="icon[]" placeholder="Enter icon" ></div></div><div class="col-md-4 pb-3"><div style="display: flex"><input type="text" class="form-control" name="title[]" placeholder="Enter title" ></div></div><div class="col-md-3 pb-3"><div style="display: flex"><input type="text" class="form-control" name="details[]" placeholder="Enter details" ></div></div><div class="col-md-2"><button type="button" class="btn btn-danger cross good-button" data-id=""> <i class="fas fa-close"></i>Remove</button></div></div>'
                );
            });
        });
    
        $(document).on('click', '.cross', function() {
            // remove pareent div
            $(this).parent().parent().remove();
        });
    </script>
    
    @endpush
