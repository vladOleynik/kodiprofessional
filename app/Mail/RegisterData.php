<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RegisterData extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $login;
    private $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($login, $password)
    {
        $this->login = $login;
        $this->password = $password;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from('salekodiprofessional@gmail.com')
            ->view('mail.register-data', ['login' => $this->login, 'password' => $this->password]);
    }
}
