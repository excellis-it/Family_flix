@if (count($plans) == 0)
    <tr>
        <td colspan="5" class="text-center">No Plan found</td>
    </tr>
@else
    @foreach ($plans as $key => $plan)
        <tr class="tableRow" data-id="{{ $plan->id }}">
            <td>{{ $plan->plan_name }}</td>
            <td>
                {!! Str::limit($plan->plan_details, 70, ' ...') !!}
            </td>
            <td>{{ $plan->plan_actual_price }}</td>
            <td>{{ $plan->plan_offer_price }}</td>
            <td>
                <a title="Delete Plan" data-route="{{ route('delete.plan', $plan->id) }}" class="delete_acma"
                    href="javascipt:void(0);" id="delete"><i class="fas fa-trash"></i></a>

                <a href="{{ route('plan.edit', $plan->id) }}"> <i class="fas fa-edit"></i></a>
            </td>
        </tr>
    @endforeach
@endif


<tr class="toxic">
    <td colspan="5" class="text-left">
        <div class="d-flex justify-content-between">
            <div class="">
                {!! $plans->links() !!}
            </div>
            <div>(Showing {{ $plans->firstItem() }} – {{ $plans->lastItem() }} plans of
                {{ $plans->total() }} plans)</div>
        </div>
    </td>
</tr>
