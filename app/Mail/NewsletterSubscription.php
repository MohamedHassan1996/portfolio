<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterSubscription extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $unsubscribeToken;

    /**
     * Create a new message instance.
     *
     * @param string $email
     * @param string $unsubscribeToken
     */
    public function __construct($email, $unsubscribeToken)
    {
        $this->email = $email;
        $this->unsubscribeToken = $unsubscribeToken;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('You Have Subscribed to Our Newsletter!')
                    ->view('Emails.newsletter_subscription');
    }
}
