<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;
use App\Models\PanelSetting;

class Update extends Mailable
{
    use Queueable, SerializesModels;

    protected $title;
    protected $logo;
    protected $user;
    protected $agent;
    protected $code;
    protected $action;
    protected $from_mail;

    /**
     * Create a new message instance.
     */
    public function __construct($title,$logo,$user,$agent,$code,$action,$from_mail)
    {
        $this->title = $title;
        $this->logo = $logo;
        $this->user = $user;
        $this->agent = $agent;
        $this->code = $code;
        $this->action = $action;
        $this->from_mail = $from_mail;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'OTP Request - '.$this->action,
            from: new Address($this->from_mail, $this->title),
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.update',
            with: [
                'user' => $this->user,
                'title' => $this->title,
                'logo' => $this->logo,
                'agent' => $this->agent,
                'code' => $this->code,
                'action' => $this->action
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
