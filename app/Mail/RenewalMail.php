<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RenewalMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $customer;
    public $new_expiry_date;


    public function __construct($customer, $new_expiry_date)
    {
        $this->customer = $customer;
        $this->new_expiry_date = $new_expiry_date;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Subscription Renewal Notification')
        ->view('customer.mail.RenewalMail')
        ->with([
            'customerName' => $this->customer->name,
            'newExpiryDate' => $this->new_expiry_date,
        ]);
    }
}
