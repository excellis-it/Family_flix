@if (count($roles) > 0)
    @foreach ($roles as $role)
        <tr>
            <td>{{ $role->name ?? 'N/A' }}</td>
            <td>
                @foreach ($role->permissions as $permission)
                    <span class="badge rounded-pill manager-list">{{ $permission->name }}</span>
                @endforeach
            </td>
            <td>
                <a href="{{ route('manager-permission.edit', $role->id) }}" class="edit-btn"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;
                   
            </td>
        </tr>
    @endforeach
    <tr class="toxic">
        <td colspan="8" class="text-left">
            <div class="d-flex justify-content-between">
                <div class="">
                    {!! $roles->links() !!}
                </div>
                <div>(Showing {{ $roles->firstItem() }} – {{ $roles->lastItem() }} Roles of
                    {{ $roles->total() }} Roles)</div>
            </div>
        </td>
    </tr>
@else
    <tr>
        <td colspan="8" class="text-center">No data found</td>
    </tr>
@endif

