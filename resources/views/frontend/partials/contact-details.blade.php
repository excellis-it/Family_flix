@foreach ($contact_details as $contact_detail)
    <div class="add d-flex">
        <div class="add-icon">
            <span><i class="{{ $contact_detail->icon }}"></i></span>
        </div>
        <div class="add-text">
            <h4>{{ $contact_detail->title }}</h4>
            <a href="mailTo:{{ $contact_detail->details }}">{{ $contact_detail->details }}</a>
        </div>
    </div>
@endforeach