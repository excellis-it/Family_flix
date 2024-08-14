@if (count($wallet_money_transfer) > 0)
    @foreach ($wallet_money_transfer as $wallet)
        <tr>
            <td>{{ $wallet_money_transfer->firstItem() + $loop->index }}</td>
            <td>{{ $wallet->transaction_id ?? 'N/A' }}</td>
            <td>
                {{ $wallet->user ? $wallet->user->name : 'N/A' }}
            </td>
            <td>
                {{ $wallet->user ? $wallet->user->email : 'N/A' }}
            </td>
            <td>{{ $wallet->transaction_type ?? 'N/A' }}</td>
            <td>{{ $wallet->transaction_amount ? '$' . $wallet->transaction_amount : 'N/A' }}</td>
            <td>{{ $wallet->last_available_balance ? '$' . $wallet->last_available_balance : 'N/A' }}</td>
            <td>{{ $wallet->created_at ? $wallet->created_at->format('Y-m-d') : 'N/A' }}</td>
        </tr>
    @endforeach
    <tr class="toxic">
        <td colspan="8" class="text-left">
            <div class="d-flex justify-content-between">
                <div class="">
                    {!! $wallet_money_transfer->links() !!}
                </div>
                <div>(Showing {{ $wallet_money_transfer->firstItem() }} – {{ $wallet_money_transfer->lastItem() }} wallet money transfer of
                    {{ $wallet_money_transfer->total() }} wallet money transfer)</div>
            </div>
        </td>
    </tr>
@else
    <tr>
        <td colspan="8" class="text-center">No data found</td>
    </tr>
@endif
