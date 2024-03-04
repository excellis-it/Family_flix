@extends('admin.layouts.master')
@section('title')
    Faq For payment
@endsection
@push('styles')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="breadcome-list">
            <div class="d-flex">

                <div class="">
                    <h3>Payment Page Faq</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a> <span class="bread-slash">/</span></li>
                        <li><span class="bread-blod"><a href="{{ route('plan.index') }}">Faq</a></span></li>
                        
                    </ul>
                </div>
            </div>
        </div>
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card w-100">
                    <div class="card-body">
                        <form action="{{ route('faq.payment.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                           
                            <div class="row">
                                <input type="hidden" name="faq_cms_id" value="{{ $faq_cms->id }}">
                                <div class="form-group col-md-12 mb-3">
                                    <label>Banner Heading<span style="color: red;">*</span></label>
                                    <input type="text" name="title" value="{{ $faq_cms->banner_heading }}" class="form-control">
                                    @if ($errors->has('title'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('title') }}</div>
                                    @endif
                                </div>

                                <div class="form-group col-md-6 mb-3">
                                    <label>Frequently Asked Question Answer<span style="color: red;">*</span></label>
                                </div>
                                <div class="add-name">
                                    @foreach ($payments_faqs as $key => $vall)
                                        <div class="row">
                                            
                                            <div class="col-md-10 pb-3">
                                                <div style="display: flex">
                                                    <input type="text" name="question[]" value="{{ $vall->question }}" class="form-control" id="en-{{ $vall->id }}" placeholder="Enter Question">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-danger cross good-button"
                                                    data-id="{{ $vall->id }}"> <i class="fas fa-close"></i>
                                                    Remove</button>
                                            </div>
                                            <div class="col-md-10 pb-3">
                                                <div style="display: flex">
                                                    <textarea name="answer[]" value="{{ $vall->answer }}" class="form-control" id="en-{{ $vall->id }}" >{{ $vall->answer }}</textarea>
                                                </div>
                                            </div>
                                            
                                            
                                        </div>
                                    @endforeach

                                    <button type="button" class="btn btn-success add-faq good-button"><i
                                            class="fas fa-plus"></i> Add More Question Answer</button>
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
        $(document).ready(function () {
            var i = 0;
            $(".add-faq").click(function () {
                i++;
                $(".add-name").append('<div class="row" id="row' + i + '"><div class="col-md-10 pb-3"><div style="display: flex"><input type="text" name="question[]" class="form-control" id="en-' + i + '" placeholder="Enter Question"></div></div><div class="col-md-2"><button type="button" name="remove" id="' + i + '" class="btn btn-danger cross good-button"> <i class="fas fa-close"></i> Remove</button></div><div class="col-md-10 pb-3"><div style="display: flex"><textarea name="answer[]" class="form-control" id="en-' + i + '" placeholder="Enter Answer"></textarea></div></div></div>');
            });

            $(document).on('click', '.cross', function() {
                // remove pareent div
                $(this).parent().parent().remove();
            });
        });
        </script>
    
    @endpush
