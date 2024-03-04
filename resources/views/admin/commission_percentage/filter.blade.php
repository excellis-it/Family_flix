@if (count($commission_percentages) == 0)
<tr>
    <td colspan="4" class="text-center">No commission Percentage found</td>
</tr>
@else

@foreach ($commission_percentages->unique('percentage') as $key => $commission_percentage)
    <tr class="tableRow" data-id="{{ $commission_percentage->id }}">
        <td>{{ $commission_percentage->percentage }}%</td>
    
        
        <td>
            <a title="Delete Coupon"
                data-route="{{ route('delete.commission-percentage', $commission_percentage->id) }}"
                class="delete_acma" href="javascipt:void(0);" id="delete"><i
                    class="fas fa-trash"></i></a>

            <a href="{{ route('commission-percentage.edit', $commission_percentage->id) }}"> <i
                    class="fas fa-edit"></i></a>
        </td>
    </tr>
@endforeach

<tr class="toxic">
    <td colspan="5" class="text-left">
        <div class="d-flex justify-content-between">
            <div class="">
                {!! $commission_percentages->links() !!}
            </div>
            <div>(Showing {{ $commission_percentages->firstItem() }} – {{ $commission_percentages->lastItem() }} commission of
                {{ $distinct_percentage_count }}  percentage values)</div>
        </div>
    </td>
</tr>


@endif

