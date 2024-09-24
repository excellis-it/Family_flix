<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\UserSubscription;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\View;

class SubscriptionExpiryMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subscription;

    public function __construct(UserSubscription $subscription)
    {
        $this->subscription = $subscription;
    }

    public function build()
    {
        return $this->view('frontend.mail.subscription-expiry') // Updated path
                    ->subject('Your subscription is expiring soon');
                    
                    
    }
}
