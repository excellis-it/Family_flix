@extends('admin.layouts.master')
@section('title')
    Menu List
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
                    <h3>Menu Management</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a> <span class="bread-slash">/</span></li>
                        <li><span class="bread-blod">Menu List</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <!--  Row 1 -->
        <div class="row">
            <div class="col-lg-12">
                <div class="w-100 text-end mb-3">
                    <a class="print_btn" href="{{ route('menu-management.create') }}" >+ Add
                        New Menu</a>
                </div>
                <div class="card w-100">
                    <div class="card-body">
                        <h4>List of Menu</h4>
                        <div class="table-responsive rounded-2 mb-4">
                            <table class="table table-hover customize-table mb-0 align-middle bg_tbody cusrsor-pointer"
                                id="myTable">
                                <thead class="text-white fs-4 bg_blue">
                                    <tr>

                                        <th><span class="fs-4 fw-semibold mb-0"> Menu name</span></th>
                                        <th><span class="fs-4 fw-semibold mb-0"> Slug</span></th>
                                        <th><span class="fs-4 fw-semibold mb-0"> Status</span></th>
                                        <th><span class="fs-4 fw-semibold mb-0"> Action</span></th>
                                    </tr>
                                </thead>
                                <tbody id="tableBodyContents">
                                    @if (count($menus) == 0)
                                        <tr>
                                            <td colspan="4" class="text-center">No Customer found</td>
                                        </tr>
                                    @else
                                        @foreach ($menus as $key => $menu)
                                            <tr class="tableRow" data-id="{{ $menu->id }}">
                                                <td>{{ $menu->title }}</td>
                                                <td>{{ $menu->slug }}</td>
                                                <td>
                                                    @if ($menu->status == 1)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                        <span class="badge bg-danger">Inactive</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a title="Delete Customer"
                                                        data-route="{{ route('delete.menu-managemnt', $menu->id) }}"
                                                        class="delete_acma" href="javascipt:void(0);" id="delete"><i
                                                            class="fas fa-trash"></i></a>

                                                    <a href="{{ route('menu-management.edit', $menu->id) }}"> <i
                                                            class="fas fa-edit"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif

                                </tbody>
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
        $(document).on('click', '#delete', function(e) {
            swal({
                    title: "Are you sure?",
                    text: "To delete this menu.",
                    type: "warning",
                    confirmButtonText: "Yes",
                    showCancelButton: true
                })
                .then((result) => {
                    if (result.value) {
                        window.location = $(this).data('route');
                    } else if (result.dismiss === 'cancel') {
                        swal(
                            'Cancelled',
                            'Your stay here :)',
                            'error'
                        )
                    }
                })
        });
    </script>

    <script type="text/javascript">
        $(document).ready(function() {
            $("#tableBodyContents").sortable({
                items: "tr",
                cursor: 'move',
                opacity: 0.6,
                update: function() {
                    sendOrderToServer();
                }
            });

            function sendOrderToServer() {
                var order = [];
                var token = $('meta[name="csrf-token"]').attr('content');

                $('tr.tableRow').each(function(index, element) {
                    order.push({
                        id: $(this).attr('data-id'),
                        position: index + 1
                    });
                });

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('admin.menu-management.reorder') }}", // Assuming you're using named routes in Laravel
                    data: {
                        order: order,
                        _token: token
                    },
                    success: function(response) {
                        if (response.status == "success") {
                            console.log("Reorder request successful:", response);
                        } else {
                            console.log("Reorder request failed:", response);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Reorder request failed with error:", error);
                    }
                });
            }
        });
    </script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            var table = $('#myTable').DataTable({
                "aaSorting": [],
                "bPaginate": true,
                

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
    </script>
@endpush
