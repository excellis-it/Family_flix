@if (count($emails) == 0)
<tr>
    <td colspan="4" class="text-center">No Data found</td>
</tr>
@else
@foreach ($emails as $key => $email)
    <tr class="tableRow" data-id="{{ $email->id }}">
        <td>{{ $email->name ?? '-' }}</td>
        <td>{{ $email->subject ?? '-' }}</td>
        <td>{{ $email->title ?? '-' }}</td>
        <td>
            <a href="{{ route('emails.edit', $email->id) }}" class="edit-btn" data-toggle="tooltip" data-placement="top" title="Edit Email"
                ><i class="fas fa-edit" ></i>
            </a>
        </td>
    </tr>
@endforeach
@endif

<tr class="toxic">
    <td colspan="4" class="text-left">
        <div class="d-flex justify-content-between">
            <div class="">
                {!! $emails->links() !!}
            </div>
            <div>(Showing {{ $emails->firstItem() }} – {{ $emails->lastItem() }} email  of
                {{ $emails->total() }} emails)</div>
        </div>
    </td>
</tr>


