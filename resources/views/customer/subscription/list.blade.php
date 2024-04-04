@extends('customer.layouts.master')
@section('title')
    Dashboard
@endsection
@push('styles')
@endpush
@section('head')
    Dashboard
@endsection
@section('content')
  
    <section class="user-panel">
        <div class="container">
            <div class="user-panel-wrap">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="user-list">
                            <ul>
                                {{-- <li class="active-1"><a href="">Dashboard</a></li> --}}
                                <li class="{{ Request::is('customer/subscriptions*') ? 'active-1' : '' }}"><a href="{{ route('customer.subscription') }}">Subscriptions</a></li>
                                <li class="{{ Request::is('customer/profile*') ? 'active-1' : '' }}"><a href="{{ route('customer.profile') }}">Account details</a></li>
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
                                            <th scope="col">Affiliate name</th>
                                            <th scope="col">Action</th>
                                            <th scope="col">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($customer_subscriptions) == 0)
                                            <tr>
                                                <td colspan="6" class="text-center">No Plan found</td>
                                            </tr>
                                        @else
                                        @foreach($customer_subscriptions as $key => $customer_subscription)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $customer_subscription->plan_name ?? 'N/A'}}</td>
                                            <td>{{ $customer_subscription->total ?? 'N/A' }}</td>
                                            <td>{{ $customer_subscription->affiliate->name ?? 'N/A' }}</td>
                                            <td>
                                                <a href="{{ route('customer.subscription.show', $customer_subscription->id) }}"
                                                    class="btn btn-primary btn-sm v-btn"><i class="fa fa-eye"></i></a>
                                                {{-- <a href="{{ route('customer.subscription.show', $customer_subscription->id) }}" class="btn btn-primary btn-sm">Edit</a> --}}
                                            </td>
                                            <td>
                                                <a href="{{ route('pricing') }}" class="renewal-btn btn">Renewal</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif

                                        <tr class="">
                                            <td colspan="6" class="text-left">
                                                <div class="d-flex justify-content-between">
                                                    <div class="pg-ul">
                                                        {!! $customer_subscriptions->links() !!}
                                                    </div>
                                                    <div>(Showing {{ $customer_subscriptions->firstItem() }} – {{ $customer_subscriptions->lastItem() }} Subscriptions of
                                                        {{ $customer_subscriptions->total() }} Subscriptions)</div>
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
@endpush
