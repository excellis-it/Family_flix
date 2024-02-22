@extends('admin.layouts.master')
@section('title')
    Contact List
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
                    <h3>Contact us</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a> <span class="bread-slash">/</span></li>
                        <li><span class="bread-blod">Contact List</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">

                <div class="card w-100">
                    <div class="card-body">
                        <h4>List of User</h4>
                        <div class="table-responsive rounded-2 mb-4">
                            <table class="table table-hover customize-table mb-0 align-middle bg_tbody"
                                id="myTable">
                                <thead class="text-white fs-4 bg_blue">
                                    <tr>
                                        <th> User name</th>
                                        <th> User Email</th>
                                        <th> User Phone</th>
                                        <th> Message</th>
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

            var table = $('#myTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('contact-us.ajax.list') }}",
                columns: [{
                        data: 'user_name',
                        name: 'user_name'
                    },
                    {
                        data: 'user_email',
                        name: 'user_email'
                    },
                    {
                        data: 'user_phone',
                        name: 'user_phone'
                    },
                    {
                        data: 'message',
                        name: 'message'
                    },

                ]
            });

        });
    </script>
@endpush
