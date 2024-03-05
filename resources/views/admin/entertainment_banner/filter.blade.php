@if (count($entertainment_banners) > 0)
    @foreach ($entertainment_banners as $entertainment_banner)
        <tr>
            <td>{{ $entertainment_banner->banner_type ?? 'N/A' }}</td>
            <td><img src="{{ Storage::url($entertainment_banner->banner_image) }}" style="hight:200px;width:100px;"></td>
            <td>
                <a href="{{  route('entertainment-banner.edit',$entertainment_banner->id)}}"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
                <a title="Delete Banner" data-route="{{ route('delete.entertainment-banner',$entertainment_banner->id)}}" id="delete" class="delete_acma" href="javascipt:void(0);" ><i class="fas fa-trash"></i></a>
            </td>
        </tr>
    @endforeach
    <tr class="toxic">
        <td colspan="8" class="text-left">
            <div class="d-flex justify-content-between">
                <div class="">
                    {!! $entertainment_banners->links() !!}
                </div>
                <div>(Showing {{ $entertainment_banners->firstItem() }} – {{ $entertainment_banners->lastItem() }} banners of
                    {{ $entertainment_banners->total() }} entertainment banners)</div>
            </div>
        </td>
    </tr>
@else
    <tr>
        <td colspan="8" class="text-center">No data found</td>
    </tr>
@endif
