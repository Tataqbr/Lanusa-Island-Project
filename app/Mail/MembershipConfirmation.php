<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class MembershipConfirmation extends Mailable
{
    use Queueable, SerializesModels;

    public $data; // Tambahkan properti public

    public function __construct($data)
    {
        $this->data = $data; // Terima data
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Lanusa - Membership Confirmation & Access Code',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.membership', // Pastikan view-nya ada
        );
    }

    public function attachments(): array
    {
        return [];
    }
}