@extends('customer.layouts.master')
@section('title')
    Subscriptions
@endsection
@push('styles')
    <style>
        #page-container {
            height: 750px;
            overflow-y: auto !important;
        }
    </style>
@endpush
{{-- @section('head')
    Dashboard
@endsection --}}
@section('content')
    @php
        use App\Helpers\Helper;
    @endphp

    <section class="user-panel">
        <div class="container">
            <div class="user-panel-wrap">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="user-list">
                            <ul>
                                {{-- <li class="active-1"><a href="">Dashboard</a></li> --}}
                                <li class="{{ Request::is('customer/subscriptions*') ? 'active-1' : '' }}"><a
                                        href="{{ route('customer.subscription') }}">Subscriptions</a></li>
                                <li class="{{ Request::is('customer/profile*') ? 'active-1' : '' }}"><a
                                        href="{{ route('customer.profile') }}">Account details</a></li>
                                <li><a href="{{ route('customer.logout') }}">Log out</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <div class="user-panel-table user-list">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Plan name</th>
                                            <th scope="col">Plan Price($)</th>
                                            <th scope="col">Start date</th>
                                            <th scope="col">Expiry date</th>
                                            <th scope="col">Affiliate name</th>
                                            <th scope="col">Action</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($customer_subscriptions) == 0)
                                            <tr>
                                                <td colspan="8" class="text-center">No Plan found</td>
                                            </tr>
                                        @else
                                            @foreach ($customer_subscriptions as $key => $customer_subscription)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $customer_subscription->plan_name ?? 'N/A' }}</td>
                                                    <td>{{ $customer_subscription->total ?? 'N/A' }}</td>
                                                    <td>{{ date('d M,Y', strtotime($customer_subscription->plan_start_date)) ?? 'N/A' }}
                                                    </td>
                                                    <td>{{ date('d M,Y', strtotime($customer_subscription->plan_expiry_date)) ?? 'N/A' }}
                                                    </td>
                                                    <td>{{ $customer_subscription->affiliate->name ?? 'N/A' }}</td>
                                                    <td>
                                                        <a href="{{ route('customer.subscription.show', $customer_subscription->id) }}" style="font-size:17px;" ><i class="fas fa-eye"></i></a>
                                                    </td>
                                                    <td>
                                                    @if ($customer_subscription->subscription_status == 1)
                                                        <span class="text-success font-weight-bold" style="background-color: #63f384 !important; padding: 5px !important; border-radius: 5px !important; color: #fff !important;">
                                                            Active
                                                        </span>
                                                    @elseif ($customer_subscription->subscription_status == 2)
                                                        <span class="text-danger font-weight-bold" style="background-color: #f73e4e !important; padding: 5px !important; border-radius: 5px !important; color: #fff !important;">
                                                            Cancel
                                                        </span>
                                                    @elseif ($customer_subscription->subscription_status == 3)
                                                        <span class="text-secondary font-weight-bold" style="background-color: #9b3e08 !important; padding: 5px !important; border-radius: 5px !important; color: #fff !important;">
                                                            Expired
                                                        </span>
                                                    @elseif ($customer_subscription->subscription_status == 4)
                                                        <span class="text-warning font-weight-bold" style="background-color: #e7b425 !important; padding: 5px !important; border-radius: 5px !important; color: #fff !important;">
                                                            Renewal
                                                        </span>
                                                    @endif


                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif

                                        <tr class="">
                                            <td colspan="8" class="text-left">
                                                <div class="d-flex justify-content-between">
                                                    <div class="pg-ul">
                                                        {!! $customer_subscriptions->links() !!}
                                                    </div>
                                                    <div>(Showing {{ $customer_subscriptions->firstItem() }} –
                                                        {{ $customer_subscriptions->lastItem() }} Subscriptions of
                                                        {{ $customer_subscriptions->total() }} Subscriptions)</div>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-lg-12 mt-4">
                        <div style="height:1500px;">
                            @php
                                $url = 'https://myfamilycinema.com/en/download-my-family-cinema/';
                                $content = file_get_contents($url);

                                // Modify the content by removing header and footer (using regex, for example)
                                $content = preg_replace('/<header.*?<\/header>/s', '', $content);
                                $content = preg_replace('/<footer.*?<\/footer>/s', '', $content);

                                echo $content;
                            @endphp
                            <iframe src="{{ $content }}" name="iframe_all" scrolling="yes" frameborder="0"
                                height="100px" width="200px"></iframe>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        var frame = document.querySelector("iframe");
        header = frame.contentDocument.querySelector("header");
        header.remove();
        footer = frame.contentDocument.querySelector("footer");
        footer.remove();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        $(document).ready(function() {
            $('#renewal-button').click(function() {

                swal.fire({
                        title: "Renewal Subscription?",
                        text: "You want to renewal this subscription?",
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
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.subscription-status').change(function() {
                var subscriptionId = $(this).data('id');
                var newStatus = $(this).val();

                // Make an AJAX request to update the status
                $.ajax({
                    url: "{{ route('customer.subscription.change-status')}}", // Update with your actual endpoint
                    method: 'POST',
                    data: {
                        subscription_id: subscriptionId,
                        status: newStatus,
                        _token: '{{ csrf_token() }}' // Include CSRF token for security
                    },
                    success: function(response) {
                        // Handle success response
                        alert('Status updated successfully');
                        location.reload(); // Reload the page to reflect changes
                    },
                    error: function(xhr, status, error) {
                        // Handle error response
                        alert('Failed to update status');
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>


@endpush
