@extends('admin.layouts.master')
@section('title')
    Product Edit
@endsection
@push('styles')
@endpush
@section('content')
    <div class="container-fluid">
        <div class="breadcome-list">
            <div class="d-flex">
                <div class="arrow_left"><a href="{{ route('products.index') }}" class="text-white"><i
                            class="ti ti-arrow-left"></i></a></div>
                <div class="">
                    <h3>Edit Product</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a> <span class="bread-slash">/</span></li>
                        <li><span class="bread-blod"><a href="{{ route('products.index') }}">
                                    List</a></span><span class="bread-slash">/</span></li>
                        <li><span class="bread-blod">Edit Product</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card w-100">
                    <div class="card-body">
                        <form action="{{ route('update.products') }}" method="POST" id="project-create-form"
                            enctype="multipart/form-data">
                            @csrf

                            <input type="hidden"  name="product_id"  value="{{ $product_edit->id }}">
                            <div class="row">
                                <div class="form-group col-md-6 mb-3">
                                    <label>Product For<span
                                        style="color: red;">*</span></label>
                                    <select name="type" class="form-control">
                                       
                                        <option value="shows" {{ $product_edit->type == 'shows' ? 'selected':'' }}>Shows</option>
                                        <option value="movie" {{ $product_edit->type == 'movie' ? 'selected':'' }}>Movies</option>
                                        <option value="kids" {{ $product_edit->type == 'kids' ? 'selected':'' }}>Kids</option>
                                    </select>
                                    @if ($errors->has('type'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('type') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6 mb-3">
                                    <label>Product Image<span style="color: red;">*</span></label>
                                    <input type="file" name="product_image" id="banner-img" class="form-control">
                                    @if ($errors->has('product_image'))
                                        <div class="error" style="color:red;">
                                            {{ $errors->first('product_image') }}</div>
                                    @endif
                                </div>
                            </div>
                            @if ($product_edit->product_image != '')
                            <img src="{{ Storage::url($product_edit->product_image) }}"
                                alt="preview image" style="height: 150px;width: 200px;">
                            @else
                                <img id="preview-back-image"
                                    src="{{ asset('admin_assets/images/NoImageFound.jpg') }}" alt="preview image"
                                    style="max-height: 150px;">
                            @endif


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
