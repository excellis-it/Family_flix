@component('mail::message')


Hi {{ $maildata['name'] }},

Welcome to {{ config('app.name') }}. Your account has been created successfully. We're excited to have you join our team.

You can access your affiliate dashboard by visiting our website and logging with valid credentials. From there, you'll be able to track your affiliater link, commissions to help you succeed.

We look forward to working with you and achieving great success together!

@component('mail::button', ['url' => route('customer.login')])
Login
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent


