<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use Twilio\Rest\Client;

class TwilioChannel
{
    protected $twilio;

    public function __construct()
    {
        $this->twilio = new Client(env('TWILIO_ACCOUNT_SID'), env('TWILIO_AUTH_TOKEN'));
    }

    public function send($notifiable, Notification $notification)
    {
        if (! $to = $notifiable->routeNotificationFor('twilio', $notification)) {
            return;
        }

        $message = $notification->toTwilio($notifiable);

        $this->twilio->messages->create($to, [
            'from' => env('TWILIO_FROM'), // From a Twilio number in your account
            'body' => $message->content
        ]);
    }
}
