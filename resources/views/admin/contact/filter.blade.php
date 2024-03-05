@if (count($contactUs) == 0)
<tr>
    <td colspan="4" class="text-center">No Data found</td>
</tr>
@else
@foreach ($contactUs as $key => $contact)
    <tr class="tableRow" data-id="{{ $contact->id }}">
        <td>{{ $contact->user_name }}</td>
        <td>{{ $contact->user_email }}</td>
        <td>{{ $contact->user_phone }}</td>
        <td>{{ $contact->message }}</td>                                           
        
    </tr>
@endforeach
@endif

<tr class="toxic">
    <td colspan="4" class="text-left">
        <div class="d-flex justify-content-between">
            <div class="">
                {!! $contactUs->links() !!}
            </div>
            <div>(Showing {{ $contactUs->firstItem() }} – {{ $contactUs->lastItem() }} contact us of
                {{ $contactUs->total() }} contactus)</div>
        </div>
    </td>
</tr>


