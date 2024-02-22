@extends('admin.layouts.master')
@section('title')
    Coupon List
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
                    <h3>Coupon</h3>
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
                    <a class="print_btn" href="{{ route('coupons.create') }}" >+ Add
                        Coupon</a>
                </div>
                <div class="card w-100">
                    <div class="card-body">
                        <h4>List of Coupon</h4>
                        <div class="table-responsive rounded-2 mb-4">
                            <table class="table table-hover customize-table mb-0 align-middle bg_tbody"
                                id="myTable">
                                <thead class="text-white fs-4 bg_blue">
                                    <tr>
                                        <th>Plan name</th>
                                        <th>Coupon Code</th>
                                        <th>Coupon Type</th>
                                        <th>value</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($coupons) == 0)
                                        <tr>
                                            <td colspan="4" class="text-center">No Coupon found</td>
                                        </tr>
                                    @else
                                        @foreach ($coupons as $key => $coupon)
                                            <tr class="tableRow" data-id="{{ $coupon->id }}">
                                                <td>{{ $coupon->plan->plan_name }}
                                                <td>{{ $coupon->code }}</td>
                                                <td>{{ $coupon->coupon_type }}</td>
                                                <td>{{ $coupon->value }}</td>
                                                <td>
                                                    <label class="switch">
                                                        <input type="checkbox" class="toggle-class"
                                                            data-id="{{ $coupon->id }}" {{ $coupon->status == 1 ? 'checked' : '' }}>
                                                        <span class="slider round"></span>
                                                    </label>
                                                </td>
                                                <td>
                                                    <a title="Delete Coupon"
                                                        data-route="{{ route('delete.coupons', $coupon->id) }}"
                                                        class="delete_acma" href="javascipt:void(0);" id="delete"><i
                                                            class="fas fa-trash"></i></a>

                                                    <a href="{{ route('coupons.edit', $coupon->id) }}"> <i
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
                text: "To delete this coupon.",
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
