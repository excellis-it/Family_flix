@if (count($managers) > 0)
    @foreach ($managers as $manager)
        <tr>
            <td>{{ $manager->name ?? 'N/A' }}</td>
            <td>{{ $manager->email ?? 'N/A' }}</td>
            <td>{{ $manager->phone ?? 'N/A' }}</td>
            <td><div class="button-switch"><input type="checkbox" id="switch-orange" class="switch toggle-class" data-id="{{ $manager->id }}" {{ $manager->status ? 'checked' : '' }} /><label for="switch-orange" class="lbl-off"></label><label for="switch-orange" class="lbl-on"></label></div></td>
            <td>
                <a href="{{ route('managers.edit', $manager->id) }}" class="edit-btn"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;<a title="Delete Affiliate Marketer" data-route="{{ route('managers.delete', $manager->id) }}" href="javascipt:void(0);" id="delete"><i class="fas fa-trash"></i></a>
                   
            </td>
        </tr>
    @endforeach
    <tr class="toxic">
        <td colspan="8" class="text-left">
            <div class="d-flex justify-content-between">
                <div class="">
                    {!! $managers->links() !!}
                </div>
                <div>(Showing {{ $managers->firstItem() }} – {{ $managers->lastItem() }} managers of
                    {{ $managers->total() }} managers)</div>
            </div>
        </td>
    </tr>
@else
    <tr>
        <td colspan="8" class="text-center">No data found</td>
    </tr>
@endif

