<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class FeedbackMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;
    /**
     * @var string
     */
    private $emailUser;
    /**
     * @var string
     */
    private $message;
    /**
     * @var string
     */
    private $messageFromUser;

    /**
     * Create a new message instance.
     *
     * @param string $emailUser
     * @param string $messageFromUser
     */
    public function __construct(string $emailUser, string $messageFromUser)
    {
        $this->emailUser = $emailUser;
        $this->messageFromUser = $messageFromUser;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $emailUser = $this->emailUser;
        $messageFromUser = $this->messageFromUser;
        return $this
            ->from('salekodiprofessional@gmail.com')
            ->view('mail.feedback-mail', compact('emailUser', 'messageFromUser'));
    }
}
