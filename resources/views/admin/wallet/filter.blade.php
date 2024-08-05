@if (count($wallets) > 0)
    @foreach ($wallets as $wallet)
        <tr>
            <td>{{ $wallet->wallet_id ?? 'N/A' }}</td>
            <td>{{ $wallet->subscription->customer->name ?? 'N/A' }}</td>
            <td>{{ $wallet->subscription->plan_name ?? 'N/A' }}</td>
            <td>{{ $wallet->subscription->total ?? 'N/A' }}</td>
            <td>{{ $wallet->balance ?? 'N/A' }}
            </td>
            <td>{{ $wallet->created_at ? $wallet->created_at->format('Y-m-d, H.i A') : 'N/A' }}</td>
        </tr>
    @endforeach
    <tr class="toxic">
        <td colspan="6" class="text-left">
            <div class="d-flex justify-content-between">
                <div class="">
                    {!! $wallets->links() !!}
                </div>
                <div>(Showing {{ $wallets->firstItem() }} – {{ $wallets->lastItem() }} wallets of
                    {{ $wallets->total() }} wallets)</div>
            </div>
        </td>
    </tr>
@else
    <tr>
        <td colspan="6" class="text-center">No data found</td>
    </tr>
@endif
