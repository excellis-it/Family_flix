@if (count($subscriptions) == 0)
    <tr>
        <td colspan="1" class="text-center">No data found</td>
    </tr>
@else
    @foreach ($subscriptions as $key => $subscription)
        <tr class="tableRow" data-id="{{ $subscription->id }}">
            <td>{{ $subscription->email }}</td>
        </tr>
    @endforeach
 
   
@endif

<tr class="toxic">
    <td colspan="1" class="text-left">
        <div class="d-flex justify-content-between">
            <div class="">
                {!! $subscriptions->links() !!}
            </div>
            <div>(Showing {{ $subscriptions->firstItem() }} – {{ $subscriptions->lastItem() }} subscriptions of
                {{ $subscriptions->total() }} subscriptions)</div>
        </div>
    </td>
</tr>


