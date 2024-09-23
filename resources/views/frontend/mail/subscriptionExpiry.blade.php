@component('mail::message')

# Plan Expiry Reminder

Hi user,

We hope you're enjoying the benefits of your current plan at **{{ config('app.name') }}**. 

Please be advised that your subscription is set to **expire on **.

@component('mail::panel')
To ensure continuous access to our services, we recommend renewing your plan before it expires.
@endcomponent

If you have any questions or need assistance, feel free to contact our support team.

Thanks,<br>
{{ config('app.name') }}

@endcomponent
