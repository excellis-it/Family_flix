@if (count($customers) > 0)
    @foreach ($customers as $customer)
        <tr>
            <td>{{ $customer->name ?? 'N/A' }}</td>
            <td>{{ $customer->email ?? 'N/A' }}</td>
            <td>{{ $customer->phone ?? 'N/A' }}</td>
            
            <td>
                <select name="status_update" id="status_update" class="form-control" data-id="{{ $customer->id }}">
                    <option value="1" {{ $customer->status == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ $customer->status == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
            </td>
            <td>
                
            </td>
            <td>
                <a href="{{ route('customers.plans.show', $customer->id) }}" class="btn btn-sm btn-primary" title="View Customer Plan">
                    <i class="fa fa-eye"></i>
                </a>
            </td>

        </tr>
    @endforeach
    <tr class="toxic">
        <td colspan="5" class="text-left">
            <div class="d-flex justify-content-between">
                <div class="">
                    {!! $customers->links() !!}
                </div>
                <div>(Showing {{ $customers->firstItem() }} – {{ $customers->lastItem() }} Customers of
                    {{ $customers->total() }} Customers)</div>
            </div>
        </td>
    </tr>
@else
    <tr>
        <td colspan="8" class="text-center">No data found</td>
    </tr>
@endif

