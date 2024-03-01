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
                        
                        <div class="row justify-content-between align-items-center mb-2">
                            <div class="col-md-2">
                                <div><h4>List of Menu</h4></div>
                            </div>
                            <div class="col-md-6">
                                <div class="row g-1 justify-content-end">
                                    <div class="col-md-8 pr-0">
                                        <div class="search-field prod-search">
                                            <input type="text" name="search" id="search" placeholder="search..." required
                                                class="form-control">
                                            <a href="javascript:void(0)" class="prod-search-icon"><i class="ti ti-search"></i></a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                    @include('admin.site_management.menu.filter')

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
    $(document).ready(function() {
        function fetch_data(page, query) {
            $.ajax({
                url: "{{ route('menu-management.ajax.list') }}",
                data: {
                    page: page,
                    query: query
                },
                success: function(data) {
                    $('tbody').html(data.data);
                }
            });
        }

        $(document).on('keyup', '#search', function() {
            var query = $('#search').val();
            var page = $('#hidden_page').val();
            fetch_data(page, query);
        });
        $(document).on('click', '.close-pagination a', function(event) {
            event.preventDefault();
            var page = $(this).attr('href').split('page=')[1];
            $('#hidden_page').val(page);

            var query = $('#search').val();

            $('li').removeClass('active');
            $(this).parent().addClass('active');
            fetch_data(page, query);
        });

    });
</script>

<script>
    $('.toggle-class').change(function() {

        var status = $(this).prop('checked') == true ? 1 : 0;
        var menu_id = $(this).data('id');

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{ route('menu-management.changeStatus') }}",
            data: {
                'status': status,
                'menu_id': menu_id
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(resp) {
                console.log(resp.success)
            }
        });
    });
</script>


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
@endpush
