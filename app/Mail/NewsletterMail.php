<?php

namespace App\Mail;

use App\Models\Newsletter\Newsletter;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewsletterMail extends Mailable
{
    use Queueable, SerializesModels;

    public $newsletter;

    /**
     * Create a new message instance.
     *
     * @param Newsletter $newsletter
     */
    public function __construct(Newsletter $newsletter)
    {
        $this->newsletter = $newsletter;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->newsletter->subject)
                    ->view('Emails.newsletter')
                    ->with('content', $this->newsletter->content);
    }
}
