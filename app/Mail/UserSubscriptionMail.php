<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserSubscriptionMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

     public $userSubscriptionMailData;

    public function __construct($userSubscriptionMailData)
    {
        $this->userSubscriptionMailData = $userSubscriptionMailData;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('frontend.mail.UserSubscriptionMail')->subject('Welcome to our website')->with('userSubscriptionMailData', $this->userSubscriptionMailData);
    }
}
