@extends('admin.layouts.master')
@section('title')
    Commission List
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
                    <h3>Affiliate Commission</h3>
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
                    <a class="print_btn" href="{{ route('commission-percentage.create') }}" >+ Add Affiliate
                        Commission</a>
                </div>
                <div class="card w-100">
                    <div class="card-body">
                        <h4>List of Affiliate Commission</h4>
                        <div class="table-responsive rounded-2 mb-4">
                            <table class="table table-hover customize-table mb-0 align-middle bg_tbody"
                                id="myTable">
                                <thead class="text-white fs-4 bg_blue">
                                    <tr>
                                        <th>Percentage</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($commission_percentages) == 0)
                                        <tr>
                                            <td colspan="4" class="text-center">No commission Percentage found</td>
                                        </tr>
                                    @else
                                        @foreach ($commission_percentages as $key => $commission_percentage)
                                            <tr class="tableRow" data-id="{{ $commission_percentage->id }}">
                                                <td>{{ $commission_percentage->percentage }}%</td>
                                                
                                                <td>
                                                    <a title="Delete Coupon"
                                                        data-route="{{ route('delete.commission-percentage', $commission_percentage->id) }}"
                                                        class="delete_acma" href="javascipt:void(0);" id="delete"><i
                                                            class="fas fa-trash"></i></a>

                                                    <a href="{{ route('commission-percentage.edit', $commission_percentage->id) }}"> <i
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
                text: "To delete this commission .",
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
        $('.toggle-class').on('change', function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var coupon_id = $(this).data('id');
            
            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: "{{ route('coupon.changeStatus') }}",
                data: {
                    'status': status,
                    'coupon_id': coupon_id
                },
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    console.log(data.success)
                }
            });
        });
    });
    </script>
   
@endpush
