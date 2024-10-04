@component('mail::message')

Hello Admin,

We are pleased to inform you that a new user has successfully subscribed to {{ config('app.name') }}. Below are the details of the subscription:

- **User Name**: {{ $userSubscriptionMailData['name'] }}
- **User Email**: {{ $userSubscriptionMailData['email'] }}
- **Plan Name**: {{ $userSubscriptionMailData['plan_name'] }}
- **Start Date**: {{ $userSubscriptionMailData['plan_start_date'] }}
- **End Date**: {{ $userSubscriptionMailData['plan_expiry_date'] }}

Please ensure that the user has access to all the benefits associated with their subscription plan.

If you have any questions or need further information, feel free to contact our support team.

Thanks,<br>
{{ config('app.name') }} Team
@endcomponent