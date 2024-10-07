@php
    use App\Helpers\Helper;
@endphp
@if (count($customers) > 0)
    @foreach ($customers as $customer)
        <tr>
            <td>{{ $customer->name ?? 'N/A' }}</td>
            <td>{{ $customer->email ?? 'N/A' }}</td>
            <td>{{ $customer->phone ?? 'N/A' }}</td>
            <td>
                @if (isset($customer->userLastSubscription) && $customer->userLastSubscription != null)
                    @if (Helper::expireTo($customer->userLastSubscription->plan_expiry_date) == 0)
                        <p class="text-success">Today is the last day</p>
                    @elseif (Helper::expireTo($customer->userLastSubscription->plan_expiry_date) == 1)
                        <p class="text-success">Tomorrow is the last day</p>
                    @elseif (Helper::expireTo($customer->userLastSubscription->plan_expiry_date) < 0)
                        <p class="text-danger">Expired</p>
                    @else
                        @if (Helper::expireTo($customer->userLastSubscription->plan_expiry_date) <= 10)
                            <p class="text-danger">
                                {{ Helper::expireTo($customer->userLastSubscription->plan_expiry_date) }} days left</p>
                        @else
                            <p class="text-success">
                                {{ Helper::expireTo($customer->userLastSubscription->plan_expiry_date) }} days left</p>
                        @endif
                    @endif
                @else
                    <p class="text-danger">No Ongoing Plan</p>
                @endif
            </td>
            <td>
                {{-- <select name="status_update" id="status_update" class="form-select" data-id="{{ $customer->id }}">
                    <option value="1" {{ $customer->status == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ $customer->status == 0 ? 'selected' : '' }}>Inactive</option>
                </select> --}}

                <div class="button-switch"><input type="checkbox" id="switch-orange" class="switch toggle-class" data-id="{{ $customer->id }}" {{ $customer->status ? 'checked' : '' }} /><label for="switch-orange" class="lbl-off"></label><label for="switch-orange" class="lbl-on"></label></div>
            </td>
            <td>
                <a href="{{ route('customers.plans.show', $customer->id) }}" class="edit-btn" data-toggle="tooltip" data-placement="right" title="View Plan">
                    <i class="fa fa-eye" ></i>
                </a>
            </td>
            <td>
                <a href="{{ route('customers.edit-detail', $customer->id) }}" class="edit-btn" data-toggle="tooltip" data-placement="top" title="Edit Customer"
                    ><i class="fas fa-edit" ></i>
                </a>
                <a href="{{ route('customers.recharge-code-mail', $customer->id) }}" class="edit-btn" data-toggle="tooltip" data-placement="top" title="Send Mail"
                   ><i class="fa fa-send" ></i>&nbsp;
                </a>
            </td>
        </tr>
    @endforeach
    <tr class="toxic">
        <td colspan="7" class="text-left">
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
        <td colspan="7" class="text-center">No data found</td>
    </tr>
@endif
