<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Reset extends Mailable
{
    use Queueable, SerializesModels;

    public $password;
    public $from_mail;
    public $title;

    public function __construct($password, $from_mail, $title)
    {
        $this->from_mail = $from_mail;
        $this->title = $title;
        $this->password = $password;
    }

    public function build()
    {
        return $this->from($this->from_mail, $this->title)
                    ->subject('Reset Pin')
                    ->view('mail.reset')
                    ->with(['newPassword' => $this->password]);
    }
}
