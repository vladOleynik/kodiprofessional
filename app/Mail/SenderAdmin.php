<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SenderAdmin extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    private $emailUser;
    private $order;

    /**
     * SenderAdmin constructor.
     * @param $emailUser
     * @param $order
     */
    public function __construct($emailUser, $order)
    {
        $this->emailUser = $emailUser;
        $this->order = $order;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $emailUser = $this->emailUser;
        $details = $this->order->details;
        return $this->from('example@example.com')->view('mail.sender-to-admin-order-success', compact('emailUser', 'details'));
    }
}
