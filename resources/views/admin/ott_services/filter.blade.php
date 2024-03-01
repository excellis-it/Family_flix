@if (count($ott_services) == 0)
    <tr>
        <td colspan="5" class="text-center">No data found</td>
    </tr>
@else
    @foreach ($ott_services as $key => $ott_service)
        <tr class="tableRow" data-id="{{ $ott_service->id }}">
            <td><img src="{{ Storage::url($ott_service->icon) }}"></td>
            <td>
                <a title="Delete Plan" data-route="{{ route('delete.ott-service', $ott_service->id) }}" class="delete_acma"
                    href="javascipt:void(0);" id="delete"><i class="fas fa-trash"></i></a>

                <a href="{{ route('plan.edit', $ott_service->id) }}"> <i class="fas fa-edit"></i></a>
            </td>
        </tr>
    @endforeach
@endif


<tr class="toxic">
    <td colspan="5" class="text-left">
        <div class="d-flex justify-content-between">
            <div class="">
                {!! $ott_services->links() !!}
            </div>
            <div>(Showing {{ $ott_services->firstItem() }} – {{ $ott_services->lastItem() }} OTT Icon of
                {{ $ott_services->total() }} OTT Services)</div>
        </div>
    </td>
</tr>
