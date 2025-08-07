<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Address;
use App\Models\PanelSetting;

class TwoFactor extends Mailable
{
    use Queueable, SerializesModels;

    protected $title;
    protected $logo;
    protected $user;
    protected $agent;
    protected $code;
    protected $from_mail;

    /**
     * Create a new message instance.
     */
    public function __construct($title,$logo,$user,$agent,$code,$from_mail)
    {
        $this->title = $title;
        $this->logo = $logo;
        $this->user = $user;
        $this->agent = $agent;
        $this->code = $code;
        $this->from_mail = $from_mail;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'OTP Request',
            from: new Address($this->from_mail, $this->title),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.template',
            with: [
                'user' => $this->user,
                'title' => $this->title,
                'logo' => $this->logo,
                'agent' => $this->agent,
                'code' => $this->code
            ],
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
