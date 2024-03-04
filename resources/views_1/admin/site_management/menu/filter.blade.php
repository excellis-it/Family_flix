@if (count($menus) == 0)
    <tr>
        <td colspan="4" class="text-center">No data found</td>
    </tr>
@else
    @foreach ($menus as $key => $menu)
        <tr class="tableRow" data-id="{{ $menu->id }}">
            <td>{{ $menu->title }}</td>
            <td>{{ $menu->slug }}</td>
            <td>

                <label class="switch">
                    <input type="checkbox" class="toggle-class" data-id="{{ $menu->id }}"
                        {{ $menu->status == 1 ? 'checked' : '' }}>
                    <span class="slider round"></span>
                </label>
            </td>
            <td>
                <a title="Delete Customer" data-route="{{ route('delete.menu-managemnt', $menu->id) }}"
                    class="delete_acma" href="javascipt:void(0);" id="delete"><i class="fas fa-trash"></i></a>

                <a href="{{ route('menu-management.edit', $menu->id) }}"> <i class="fas fa-edit"></i></a>
            </td>
        </tr>
    @endforeach
@endif

<tr class="toxic">
    <td colspan="4" class="text-left">
        <div class="d-flex justify-content-between">
            <div class="">
                {!! $menus->links() !!}
            </div>
            <div>(Showing {{ $menus->firstItem() }} – {{ $menus->lastItem() }} menus of
                {{ $menus->total() }} menus)</div>
        </div>
    </td>
</tr>
