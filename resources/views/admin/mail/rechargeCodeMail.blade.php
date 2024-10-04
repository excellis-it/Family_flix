@component('mail::message')
# Recharge Code Confirmation

Hello {{ $maildata['name'] }},

We are pleased to inform you that your recharge request has been successfully processed. Below are the details of your recharge:

- **User Name**: {{ $maildata['name'] }}
- **User Email**: {{ $maildata['email'] }}

To apply the recharge code, You can use following code and please visit the following link:

@component('mail::panel')
{!! $maildata['mail_content'] !!}
@endcomponent


If you have any questions or need further assistance, feel free to contact our support team.

Thank you for choosing MyFamilyCinema!

Best regards,  
{{ config('app.name') }} Team
@endcomponent