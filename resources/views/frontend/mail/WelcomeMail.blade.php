@component('mail::message')
Hi {{ $maildata['name'] }},

Welcome to {{ config('app.name') }}. Your account has been created successfully.
your EmailId and Password is{{ $maildata['id'] }}, {{ $maildata['password'] }}.

@component('mail::button', ['url' => route('affiliate-marketer.login')])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
