@extends('customer.layouts.master')
@section('title')
    Dashboard
@endsection
@push('styles')
    <style>
        #page-container {
            height: 750px;
            overflow-y: auto !important;
        }
    </style>
@endpush
@section('head')
    Dashboard
@endsection
@section('content') 
    @php
        use App\Helpers\Helper;
    @endphp

    <section class="user-panel">
        <div class="container">
            <div class="user-panel-wrap">
                <div class="row">
                    <div class="col-lg-4">
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
                    <div class="col-lg-8">
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
                                                        <a href="{{ route('customer.subscription.show', $customer_subscription->id) }}"
                                                            class="btn btn-primary btn-sm v-btn"><i
                                                                class="fa fa-eye"></i></a>
                                                        {{-- <a href="{{ route('customer.subscription.show', $customer_subscription->id) }}" class="btn btn-primary btn-sm">Edit</a> --}}
                                                    </td>
                                                    <td>
                                                        @if ($customer_subscription->plan_expiry_date < date('Y-m-d'))
                                                            <span class="text-danger">Expired</span>
                                                        @else
                                                            @if ($customer_subscription->paypal_subscription_id == null)
                                                                <a title="Renewal plan"
                                                                    data-route="{{ route('create-payments', ['id' => encrypt($customer_subscription->plan_id)]) }}"
                                                                    class="renewal-btn btn" id="renewal-button">Renewal</a>
                                                            @else
                                                                @if (isset($customer_subscription->userSubscriptionRecurring) &&
                                                                        $customer_subscription->userSubscriptionRecurring->status == 'ACTIVE')
                                                                    <span class="text-success">Active</span>
                                                                @else
                                                                    <a title="Renewal plan"
                                                                        data-route="{{ route('create-payments', ['id' => encrypt($customer_subscription->plan_id)]) }}"
                                                                        class="renewal-btn btn"
                                                                        id="renewal-button">Renewal</a>
                                                                @endif
                                                            @endif
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
                    <div class="col-lg-12 mt-4">
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
                    </div>
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
@endpush
