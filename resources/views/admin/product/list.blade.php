@extends('admin.layouts.master')
@section('title')
    Product List
@endsection
@push('styles')
    <style>
        .error {
            color: red !important;
        }
    </style>
@endpush
@section('content')
    <section id="loading">
        <div id="loading-content"></div>
    </section>
    <div class="container-fluid">
        <div class="breadcome-list">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <h3>Product</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a> <span class="bread-slash">/</span></li>
                        <li><span class="bread-blod"> List</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="w-100 text-end mb-3">
                    <a class="print_btn" href="{{ route('products.create') }}">+ Add
                        New Product</a>
                </div>
                <div class="card w-100">
                    <div class="card-body">
                        <h4>List of Product</h4>
                        <div class="table-responsive rounded-2 mb-4">
                            <table class="table table-hover customize-table mb-0 align-middle bg_tbody" id="myTable">
                                <thead class="text-white fs-4 bg_blue">
                                    <tr>
                                        <th>Product For</th>
                                        <th>Product Image</th>
                                        <th>Top 10 Product</th>
                                        <th>Popular Product</th>
                                        <th>Unbeatable Product</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Define your storage URL
            var storageUrl = "{{ Storage::url('') }}"; // Assuming you're using Laravel's Storage facade

            var table = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('products.ajax.list') }}",
                columns: [{
                        data: 'type',
                        name: 'type'
                    },
                    {
                        data: 'product_image',
                        name: 'product_image',
                        render: function(data, type, full, meta) {
                            // Assuming data contains the relative path of the image
                            // Concatenate storage URL with the image path
                            var imageUrl = storageUrl + data;
                            return '<img src="' + imageUrl +
                                '" style="max-width:100px; max-height:100px;"/>';
                        }
                    },
                    {
                        data: 'top_10_status',
                        name: 'top_10_status',
                    },
                    {
                        data: 'popular_status',
                        data: 'popular_status',
                    },
                    {
                        data: 'unbeatable_status',
                        data: 'unbeatable_status',
                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    </script>
    <script>
        $(document).on('change', '.toggle-class', function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var pro_id = $(this).data('id');

            $.ajax({
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('product.top-status') }}",
                data: {
                    'status': status,
                    'pro_id': pro_id
                },
                success: function(resp) {
                    console.log(resp.success)
                }
            });
        });
    </script>

    <script>
        $(document).on('change', '.toggle-class-popular', function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var pro_id = $(this).data('id');

            $.ajax({
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('product.popular-status') }}",
                data: {
                    'status': status,
                    'pro_id': pro_id
                },
                success: function(resp) {
                    console.log(resp.success)
                }
            });
        });
    </script>

    <script>
        $(document).on('change', '.toggle-class-unbeatable', function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var pro_id = $(this).data('id');

            $.ajax({
                type: "POST",
                dataType: "json",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('product.unbeatable-status') }}",
                data: {
                    'status': status,
                    'pro_id': pro_id
                },
                success: function(resp) {
                    console.log(resp.success)
                }
            });
        });
    </script>
@endpush
