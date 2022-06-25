<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotificationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public array $details;

    /**
     * @param  array  $details
     */
    public function __construct(string $subject, array $details)
    {
        $this->subject = $subject;
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->subject($this->subject)
            ->markdown('emails.notification-mail', [
                'url' => route('notifications'),
            ]);
    }
}
