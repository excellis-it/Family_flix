@if (count($customer_subscriptions) == 0)
    <tr>
        <td colspan="5" class="text-center">No Plan found</td>
    </tr>
@else
    @foreach ($customer_subscriptions as $key => $customer_subscription)
        <tr class="tableRow" data-id="{{ $customer_subscription->id }}">
            <td>{{ $customer_subscription->plan_name }}</td>
            <td>{{ $customer_subscription->total }}</td>
            <td>{{ $customer_subscription->affiliate->name ?? 'N/A' }}</td>
            <td>
                <a href="{{ route('customer.subscription.show', $customer_subscription->id) }}"
                    class="btn btn-primary btn-sm"><i class="ti ti-eye"></i></a>
                {{-- <a href="{{ route('customer.subscription.show', $customer_subscription->id) }}" class="btn btn-primary btn-sm">Edit</a> --}}
            </td>
        </tr>
    @endforeach
@endif


<tr class="toxic">
    <td colspan="5" class="text-left">
        <div class="d-flex justify-content-between">
            <div class="">
                {!! $customer_subscriptions->links() !!}
            </div>
            <div>(Showing {{ $customer_subscriptions->firstItem() }} – {{ $customer_subscriptions->lastItem() }} Customer Subscription of
                {{ $customer_subscriptions->total() }} Customer Subscriptions)</div>
        </div>
    </td>
</tr>
