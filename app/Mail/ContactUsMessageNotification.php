<?php

namespace App\Mail;

use App\Models\ContactUs\ContactUs;
use App\Models\ContactUs\ContactUsMessage;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUsMessageNotification extends Mailable
{
    use Queueable, SerializesModels;

    public $contactUsMessage;
    public $contactUs;

    /**
     * Create a new message instance.
     *
     */
    public function __construct(ContactUsMessage $contactUsMessage, ContactUs $contactUs)
    {
        $this->contactUsMessage = $contactUsMessage;
        $this->contactUs = $contactUs;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    /*public function build()
    {
        return $this->subject($this->contactUs->subject)
                    ->view('emails.contact_us_message')
                    ->with([
                        'subject' => $this->contactUs->subject,
                        'messageContent' => $this->contactUsMessage->message,
                        'isAdmin' => $this->contactUsMessage->is_admin ? 'Admin' : 'User',
                        'isRead' => $this->contactUsMessage->is_read ? 'Read' : 'Unread',
                    ]);
    }*/

    public function build()
{
    $messageId = "<contact-{$this->contactUs->id}@yourdomain.com>";

    $email = $this->subject($this->contactUs->subject)
                  ->view('Emails.contact_us_message')
                  ->with([
                      'subject' => $this->contactUs->subject,
                      'messageContent' => $this->contactUsMessage->message,
                  ])
                  ->replyTo($this->contactUs->email) // User will receive replies
                  ->withHeaders([
                      'Message-ID' => $messageId, // Unique ID for threading
                  ]);

    // If the message is from the admin, link it to the original thread
    if ($this->contactUsMessage->is_admin) {
        $email->withHeaders([
            'In-Reply-To' => $messageId, // Ensures threading
            'References' => $messageId, // Links it to the original message
        ]);
    }

    return $email;
}

}
