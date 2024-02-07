@extends('admin.layouts.master')
@section('title')
    All Menu Details - {{ env('APP_NAME') }}
@endsection
@push('styles')
    <style>
        .dataTables_filter {
            margin-bottom: 10px !important;
        }
    </style>





@endpush

@section('content')
    <section id="loading">
        <div id="loading-content"></div>
    </section>
    <div class="page-wrapper">

        <div class="content container-fluid">

            <div class="page-header">
                <div class="row align-items-center">
                    <div class="col-md-8">
                        <h3 class="page-title">Plan Information</h3>
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('plan.index') }}">Plans</a>
                            </li>
                            <li class="breadcrumb-item active">List</li>
                        </ul>
                    </div>

                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="card-title">
                        <div class="row">
                            <div class="col-md-6">
                                <h4 class="mb-0">Plan List</h4>
                            </div>
                            <div class="col-md-6 text-end">
                                <a href="{{ route('plan.create') }}" class="btn px-5 submit-btn"><i
                                        class="fas fa-plus"></i> Add New Plan</a>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive" id="customers_data">
                        <table id="myTable" class="dd table table-striped table-hover" style="width:100%">
                            <thead>
                                <tr>
                                    <th> Plan name</th>
                                    <th> Plan Details</th>
                                    <th> Plan actual price($)</th>
                                    <th> Plan offer price($)</th>
                                    <th> Action</th>
                                </tr>
                            </thead>
                            <tbody id="tableBodyContents">
                                @if (count($plans) == 0)
                                    <tr>
                                        <td colspan="5" class="text-center">No Customer found</td>
                                    </tr>
                                @else
                                    @foreach ($plans as $key => $plan)
                                        <tr  class="tableRow" data-id="{{ $plan->id }}">
                                            <td >{{ $plan->plan_name }}</td>
                                            <td >{{ $plan->plan_details }}</td>
                                            <td >{{ $plan->plan_actual_price }}</td>
                                            <td >{{ $plan->plan_offer_price }}</td>
                                            <td>
                                                <a title="Delete Plan"
                                                    data-route="{{ route('delete.plan', $plan->id) }}"  class="delete_acma"
                                                    href="javascipt:void(0);" id="delete"><i
                                                        class="fas fa-trash"></i></a>

                                                <a href="{{ route('plan.edit', $plan->id) }}"> <i class="fas fa-edit"></i></a>
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
@endsection




@push('scripts')


    <script>
        $(document).on('click', '#delete', function(e) {
            swal({
                    title: "Are you sure?",
                    text: "To delete this plan.",
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
            url: "{{ route('admin.plan.reorder') }}", // Assuming you're using named routes in Laravel
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
@endpush
