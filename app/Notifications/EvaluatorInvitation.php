<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EvaluatorInvitation extends Notification
{
    use Queueable;

    public $event;
    public $token;

    public function __construct($event, $token)
    {
        $this->event = $event;
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = route('evaluator.show', [
            'event' => $this->event->id,
            'token' => $this->token
        ]);

        return (new MailMessage)
            ->line('Vous avez été invité à évaluer un événement.')
            ->action('Évaluer maintenant', $url);
    }
}
