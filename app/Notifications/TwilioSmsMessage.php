<?php

namespace App\Notifications;

class TwilioSmsMessage
{
    public $content;

    public function content($content)
    {
        $this->content = $content;

        return $this;
    }
}
