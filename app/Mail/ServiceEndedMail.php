<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ServiceEndedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(public $service)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Your service is about to end',
        );
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->markdown('emails.tenants.service-end-mail')
            ->with([
                'service' => $this->service,
            ]);
    }
}
