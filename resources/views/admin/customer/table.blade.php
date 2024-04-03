@if (count($customers) > 0)
    @foreach ($customers as $customer)
        <tr>
            <td>{{ $customer->name ?? 'N/A' }}</td>
            <td>{{ $customer->email ?? 'N/A' }}</td>
            <td>{{ $customer->phone ?? 'N/A' }}</td>
            <td><div class="button-switch"><input type="checkbox" id="switch-orange" class="switch toggle-class" data-id="{{ $customer->id }}" {{ $customer->status ? 'checked' : '' }} /><label for="switch-orange" class="lbl-off"></label><label for="switch-orange" class="lbl-on"></label></div></td>
           
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

