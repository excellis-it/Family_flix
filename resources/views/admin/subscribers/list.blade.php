@extends('admin.layouts.master')
@section('title')
    Subscriber List
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
                    <h3>Subscribers</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a> <span class="bread-slash">/</span></li>
                        <li><span class="bread-blod">List</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">

                <div class="card w-100">
                    <div class="card-body">
                        <h4>List of Subscribers</h4>
                        <div class="table-responsive rounded-2 mb-4">
                            <table class="table table-hover customize-table mb-0 align-middle bg_tbody"
                                id="myTable">
                                <thead class="text-white fs-4 bg_blue">
                                    <tr>
                                        <th><span class="fs-4 fw-semibold mb-0"> User Email</span></th>
                                        
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
    {{-- 
<script>
$(document).ready(function() {
// Initialize DataTable
var table = $('#myTable').DataTable({
    "aaSorting": [],
    "columnDefs": [{
            "orderable": false,
            "targets": [3]
        },
        {
            "orderable": true,
            "targets": [0, 1, 2]
        }
    ]
});
});
</script> --}}

    <script>
        $(document).ready(function() {

            var table = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('subscription.ajax.list') }}",
                columns: [{
                        data: 'email',
                        name: 'email'
                    },
                ]
            });

        });
    </script>
@endpush
