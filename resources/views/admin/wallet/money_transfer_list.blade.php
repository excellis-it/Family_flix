@extends('admin.layouts.master')
@section('title')
    Affiliate Marketer Create
@endsection
@push('styles')
@endpush

@section('content')
    <div class="container-fluid">
        <div class="breadcome-list">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                    <h3>Wallet History</h3>
                    <ul class="breadcome-menu mb-0">
                        <li><a href="{{ route('admin.dashboard') }}">Home</a> <span class="bread-slash">/</span>
                        </li>
                        <li><span class="bread-blod">Wallet History</span></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row justify-content-end mb-2">
            <div class="col-md-6">
                <div class="row g-1 justify-content-end">
                    <div class="col-md-8 pr-0">
                        <div class="search-field prod-search">
                            <input type="text" name="search" id="search" placeholder="search..." required
                                class="form-control">
                            <a href="javascript:void(0)" class="prod-search-icon"><i class="ti ti-search"></i></a>
                        </div>
                    </div>
                    {{-- <div class="col-md-3 pl-0 ml-2">
                        <button class="btn btn-primary button-search" id="search-button"> <span class=""><i
                                    class="ph ph-magnifying-glass"></i></span> Search</button>
                    </div> --}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card w-100">
                    <div class="card-body">
                        <div class="table-responsive rounded-2 mb-4">
                            <table class="table table-hover customize-table mb-0 align-middle bg_tbody cusrsor-pointer"
                                id="myTable">
                                <thead class="text-white fs-4 bg_blue">
                                    <tr>

                                        <th><span class="fs-4 fw-semibold mb-0">#Id</span></th>
                                        <th>
                                            <span class="fs-4 fw-semibold mb-0">Transaction ID</span>
                                        </th>
                                        <th>
                                            <span class="fs-4 fw-semibold mb-0">Transaction By</span>
                                        </th>
                                        <th>
                                            <span class="fs-4 fw-semibold mb-0">Transaction By Mail ID</span>
                                        </th>
                                        <th><span class="fs-4 fw-semibold mb-0">Transaction Type</span></th>
                                        <th><span class="fs-4 fw-semibold mb-0">Transaction Amount</span></th>
                                        <th><span class="fs-4 fw-semibold mb-0">Last Available Balance</span></th>
                                        <th><span class="fs-4 fw-semibold mb-0">Transaction Date</span></th>
                                    </tr>
                                </thead>
                                <tbody id="tableBodyContents">
                                    @include('admin.wallet.filter-transfer')

                                </tbody>
                            </table>
                            <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
                            <input type="hidden" name="hidden_column_name" id="hidden_column_name" value="id" />
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
                url: "{{ route('wallet.money-transfer.fetch-data') }}",
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
@endpush
