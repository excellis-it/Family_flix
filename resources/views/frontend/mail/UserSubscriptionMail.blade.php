@component('mail::message')

Hi {{ $userSubscriptionMailData['name'] }},

Welcome to {{ config('app.name') }}! We are thrilled to have you as a new subscriber.

Your subscription has been activated successfully. Here are the details of your subscription:

- **Plan Name**: {{ $userSubscriptionMailData['plan_name'] }}
- **Start Date**: {{ $userSubscriptionMailData['plan_start_date'] }}
- **End Date**: {{ $userSubscriptionMailData['plan_expiry_date'] }}

To access your account and enjoy our services, simply visit our website and use the provided credentials to log in.


If you have any questions or need assistance, feel free to contact our support team.

We hope you enjoy your time with {{ config('app.name') }}!

Thanks,<br>
{{ config('app.name') }}
@endcomponent

