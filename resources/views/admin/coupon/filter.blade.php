@if (count($coupons) == 0)
<tr>
    <td colspan="7" class="text-center">No Coupon found</td>
</tr>
@else
@foreach ($coupons as $key => $coupon)
    <tr class="tableRow" data-id="{{ $coupon->id }}">
        <td>{{ $coupon->plan->plan_name }}</td>
        <td>@if($coupon->user_type == 'new_user') New User @else EXisting User @endif</td>
        <td>{{ $coupon->code }}</td>
        <td>{{ $coupon->coupon_type }}</td>                                           
        <td>{{ $coupon->value }}</td>
        <td>
            <label class="switch">
                <input type="checkbox" class="toggle-class"
                    data-id="{{ $coupon->id }}" {{ $coupon->status == 1 ? 'checked' : '' }}>
                <span class="slider round"></span>
            </label>
        </td>
        <td>
            <a href="{{ route('coupons.edit', $coupon->id) }}" class="edit-btn"> <i
                class="fas fa-edit"></i></a>
            <a title="Delete Coupon"
                data-route="{{ route('delete.coupons', $coupon->id) }}"
                class="delete_acma edit-btn" href="javascipt:void(0);" id="delete"><i
                    class="fas fa-trash"></i></a>

            
        </td>
    </tr>
@endforeach
@endif

<tr class="toxic">
    <td colspan="7" class="text-left">
        <div class="d-flex justify-content-between">
            <div class="">
                {!! $coupons->links() !!}
            </div>
            <div>(Showing {{ $coupons->firstItem() }} – {{ $coupons->lastItem() }} coupons of
                {{ $coupons->total() }} coupons)</div>
        </div>
    </td>
</tr>


