<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EvaluatorInvitation extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(public $event, public $contact, public $token) {}

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Invitation à évaluer un événement')
            ->view('emails.evaluator_invitation')
            ->with([
                'event' => $this->event,
                'contact' => $this->contact,
                'token' => $this->token,
            ]);
    }
}
