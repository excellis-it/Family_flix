@component('mail::message')

Dear {{ $userSubscriptionMailData['name'] }},

We are pleased to welcome you to Family-Flix! Thank you for choosing to subscribe with us.

We are happy to confirm that your subscription has been successfully activated. You will receive another email shortly containing your login credentials.

**Subscription Details:**
- **Plan Name**: {{ $userSubscriptionMailData['plan_name'] }}
- **Start Date**: {{ $userSubscriptionMailData['plan_start_date'] }}
- **End Date**: {{ $userSubscriptionMailData['plan_expiry_date'] }}

If you do not receive the email with your credentials, please check your spam folder.

Should you have any questions or require assistance, please do not hesitate to reach out to our support team. We hope you enjoy your experience with Family-Flix!

Thanks,<br>
The Family-Flix Team
@endcomponent

