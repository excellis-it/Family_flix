@if (count($commissions) > 0)
    @foreach ($commissions as $commissionHistory)
        <tr>
            <td>{{ $commissionHistory->customerDetails->full_name ?? 'N/A' }}</td>
            <td>{{ $commissionHistory->customerDetails->email_address ?? 'N/A' }}</td>
            <td>{{ $commissionHistory->plan_name ?? 'N/A' }}</td>
            <td>{{ $commissionHistory->total ? '$' . $commissionHistory->total : 'N/A' }}
            </td>
            <td>
                {{$commissionHistory->affiliate->name ?? 'N/A'}}
            </td>
            <td>
                {{$commissionHistory->affiliate->email ?? 'N/A'}}
            </td>
            <td>{{ $commissionHistory->affiliate_commission ? '$' . $commissionHistory->affiliate_commission : 'N/A' }} </td>
            <td>
                <a href="{{ route('commission-history.show', $commissionHistory->id) }}"
                    class="btn btn-primary btn-sm"><i class="ti ti-eye"></i></a>
            </td>
        </tr>
    @endforeach
    <tr class="toxic">
        <td colspan="8" class="text-left">
            <div class="d-flex justify-content-between">
                <div class="">
                    {!! $commissions->links() !!}
                </div>
                <div>(Showing {{ $commissions->firstItem() }} – {{ $commissions->lastItem() }} commissions of
                    {{ $commissions->total() }} commissions)</div>
            </div>
        </td>
    </tr>
@else
    <tr>
        <td colspan="8" class="text-center">No data found</td>
    </tr>
@endif
