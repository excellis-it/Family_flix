@if (count($affiliaters) > 0)
    @foreach ($affiliaters as $affiliater)
        <tr>
            <td>{{ $affiliater->name ?? 'N/A' }}</td>
            <td>{{ $affiliater->email ?? 'N/A' }}</td>
            <td>{{ $affiliater->phone ?? 'N/A' }}</td>
            <td><div class="affiliate-url" onclick="copyText(this)">{{  route('pricing', Crypt::encrypt($affiliater->id)) }}<i class="fa fa-copy"></i></div></td>
            <td><div class="button-switch"><input type="checkbox" id="switch-orange" class="switch toggle-class" data-id="{{ $affiliater->id }}" {{ $affiliater->status ? 'checked' : '' }} /><label for="switch-orange" class="lbl-off"></label><label for="switch-orange" class="lbl-on"></label></div></td>
            <td>
                <a href="{{ route('affliate-marketer.edit', $affiliater->id) }}"><i class="fas fa-edit"></i></a>&nbsp;&nbsp;<a title="Delete Affiliate Marketer" data-route="{{ route('affliate-marketer.delete', $affiliater->id) }}" href="javascipt:void(0);" id="delete"><i class="fas fa-trash"></i></a>
                   
            </td>
        </tr>
    @endforeach
    <tr class="toxic">
        <td colspan="8" class="text-left">
            <div class="d-flex justify-content-between">
                <div class="">
                    {!! $affiliaters->links() !!}
                </div>
                <div>(Showing {{ $affiliaters->firstItem() }} – {{ $affiliaters->lastItem() }} affiliaters of
                    {{ $affiliaters->total() }} affiliaters)</div>
            </div>
        </td>
    </tr>
@else
    <tr>
        <td colspan="8" class="text-center">No data found</td>
    </tr>
@endif
