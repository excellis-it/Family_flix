@component('mail::message')

Hi {{ $maildata['name'] }},

Welcome to {{ config('app.name') }}. Your account has been created successfully.
<b>Email Address:</b> {{ $maildata['email'] }} </br>
<b>Password:</b> {{ $maildata['password'] }}

To access your account, simply visit our website and use the provided credentials to log in. 

We hope you enjoy your time with {{ config('app.name') }}!

@component('mail::button', ['url' => route('customer.login')])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent


