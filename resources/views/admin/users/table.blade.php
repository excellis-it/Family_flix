@if (count($users) == 0)
    <tr>
        <td colspan="4" class="text-center">No data found</td>
    </tr>
@else
    @foreach ($users as $key => $user)
        <tr class="tableRow" data-id="{{ $user->id }}">
            <td>{{ $user->name ?? 'N/A'}}</td>
            <td>{{ $user->email ?? 'N/A' }}</td>
            <td>{{ $user->phone ?? 'N/A' }}</td>
            <td>{{ $user->roles->first()->name ?? 'N/A' }}</td>
           <td>

            <a href="{{  route('users.edit',$user->id)}}" class="btn btn-sm"><i class="fas fa-edit" style="font-size: 18px;"></i></a>
            <a title="Delete User" data-route="{{ route('delete.user',$user->id)}}" id="delete" class="delete_acma btn btn-sm" href="javascipt:void(0);" style="font-size: 18px;"><i class="fas fa-trash"></i></a>
            </td>
        </tr>
    @endforeach
@endif

<tr class="toxic">
    <td colspan="5" class="text-left">
        <div class="d-flex justify-content-between">
            <div class="">
                {!! $users->links() !!}
            </div>
            <div>(Showing {{ $users->firstItem() }} – {{ $users->lastItem() }} users of
                {{ $users->total() }} users)</div>
        </div>
    </td>
</tr>
