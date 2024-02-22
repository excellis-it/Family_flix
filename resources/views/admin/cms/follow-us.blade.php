@extends('admin.layouts.master')
@section('title')
    Follow Us
@endsection
@push('styles')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="breadcome-list">
            <div class="d-flex">

                <div class="">
                    <h3>Follow Us</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a> <span class="bread-slash">/</span></li>
                        <li><span class="bread-blod"><a href="{{ route('plan.index') }}">Follow Us</a></span><span
                                class="bread-slash">/</span></li>
                        
                    </ul>
                </div>
            </div>
        </div>
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card w-100">
                    <div class="card-body">
                        <form action="{{ route('update.follow-cms') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">

                                <h4 class="text-left">Follow Us Icon</h4>
                                <hr>
                                <div class="add-icon">
                                    @foreach($social_medias as $social_media)
                                        <div class="row">
                                            
                                            <div class="col-md-5 pb-3">
                                                <div style="display: flex">
                                                    <input type="text" class="form-control" name="icon[]" placeholder="Enter icon" value="{{ $social_media->icon }}" id="social-{{ $social_media->id }}">
                                                </div>
                                            </div>
                                            <div class="col-md-5 pb-3">                                         
                                                <div style="display: flex">
                                                    <input type="text" class="form-control" name="link[]" placeholder="Enter link" value="{{ $social_media->link }}" id="social-{{ $social_media->id }}">
                                                </div>
                                            </div>
                                           
                                            <div class="col-md-2">
                                                <button type="button" class="btn btn-danger cross good-button"
                                                    data-id="{{ $social_media->id }}"> <i class="fas fa-close"></i>
                                                    Remove</button>
                                            </div>
                                        </div>
                                    @endforeach

                                    <button type="button" class="btn btn-success add-social-details good-button"><i
                                            class="fas fa-plus"></i> Add More Details</button>       
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
            $(".add-social-details").click(function() {
            
                $(".add-icon").append(
                    '<div class="row"><div class="col-md-5 pb-3"> <div style="display: flex"><input type="text" class="form-control" name="icon[]" placeholder="Enter icon" > </div></div><div class="col-md-5 pb-3"><div style="display: flex"><input type="text" class="form-control" name="link[]" placeholder="Enter link" ></div></div><div class="col-md-2"><button type="button" class="btn btn-danger cross good-button"> <i class="fas fa-close"></i> Remove</button></div></div>'
                );
            });
        });
    
        $(document).on('click', '.cross', function() {
            // remove pareent div
            $(this).parent().parent().remove();
        });
    </script>
    
    @endpush
