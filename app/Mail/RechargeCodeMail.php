<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RechargeCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $maildata;
    public $subject;

    public function __construct($maildata)
    {
        $this->maildata = $maildata;
        $this->subject = $maildata['subject'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('admin.mail.rechargeCodeMail')->subject($this->subject)->with('maildata',  $this->maildata);
    }
}
