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
    public function build()
    {
        return $this->subject($this->contactUs->subject)
                    ->view('emails.contact_us_message')
                    ->with([
                        'messageSubject' => $this->contactUsMessage->subject,
                        'messageContent' => $this->contactUsMessage->message,
                        'isAdmin' => $this->contactUsMessage->is_admin ? 'Admin' : 'User',
                        'isRead' => $this->contactUsMessage->is_read ? 'Read' : 'Unread',
                    ]);
    }
}
