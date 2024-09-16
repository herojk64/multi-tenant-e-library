<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ServiceAboutToEndMail extends Mailable
{
    use Queueable, SerializesModels;



    /**
     * Create a new message instance.
     */
    public function __construct(public $user,public $service,public $endDate)
    {
    }

    /**
     * Envelope method to define the subject and recipients.
     */
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
        return $this->markdown('emails.tenants.service-about-to-end-mail')
            ->with([
                'user' => $this->user,  // Correct variable
                'service' => $this->service,  // Correct variable
                'endDate' => $this->endDate,  // Correct variable
            ]);
    }
}
