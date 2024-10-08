@if (count($top_grids) == 0)
    <tr>
        <td colspan="5" class="text-center">No data found</td>
    </tr>
@else
    @foreach ($top_grids as $key => $top_grid)
        <tr class="tableRow" data-id="{{ $top_grid->id }}">
            <td>{{ $top_grid->title }}</td>
            <td><a href="{{ Storage::url($top_grid->icon) }}" target="_blank"> 
                <img src="{{ Storage::url($top_grid->icon) }}" height="50px;" width="70px;" >
                </a>
            </td>
            <td>
                <a href="{{ route('top-grid.edit', $top_grid->id) }}" class="edit-btn"> <i class="fas fa-edit"></i></a>
                <a title="Delete Banner" data-route="{{ route('delete.top-grid', $top_grid->id)}}" id="delete" class="delete_acma edit-btn" href="javascipt:void(0);"  ><i class="fas fa-trash"></i></a>
            </td>
        </tr>
    @endforeach
@endif


<tr class="toxic">
    <td colspan="5" class="text-left">
        <div class="d-flex justify-content-between">
            <div class="">
                {!! $top_grids->links() !!}
            </div>
            <div>(Showing {{ $top_grids->firstItem() }} – {{ $top_grids->lastItem() }} OTT Icon of
                {{ $top_grids->total() }} OTT Services)</div>
        </div>
    </td>
</tr>
