@extends('admin.layouts.master')
@section('title')
    Top Grid List
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
                    <h3>Top Grid</h3>
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
                    <a class="print_btn" href="{{ route('top-grid.create') }}" >+ Add
                        Top grid</a>
                </div>
                <div class="card w-100">
                    <div class="card-body">
                        <h4>List of Top grid</h4>
                        <div class="table-responsive rounded-2 mb-4">
                            <table class="table table-hover customize-table mb-0 align-middle bg_tbody"
                                id="myTable">
                                <thead class="text-white fs-4 bg_blue">
                                    <tr>
                                        <th>Title</th>
                                        <th>Icon</th>
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
        ajax: "{{ route('top-grid.ajax.list') }}",
        columns: [
            {
                data: 'title',
                name: 'title'
            },
            {
                data: 'icon',
                name: 'icon',
                render: function(data, type, full, meta) {
                    var imageUrl = storageUrl + data;
                    return '<img src="' + imageUrl + '" style="max-width:100px; max-height:100px;"/>';
                }
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
@endpush
