<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use App\Models\Career\Candidate;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendCandidateCv extends Mailable
{
    use Queueable, SerializesModels;
    public $candidate;
    /**
     * Create a new message instance.
     */
    public function __construct(Candidate $candidate)
    {
        $this->candidate = $candidate;
    }


    public function build()
    {
        $cvPath = $this->candidate->cv;
        $sendCareer = $this->subject($this->candidate->name)
                    ->view('Emails.send_candidate_cv')
                    ->with('content', $this->candidate->email);
        if ($cvPath) {
            $sendCareer->attach(Storage::disk('public')->path($cvPath));
        }

        dd($cvPath);
        return $sendCareer;
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
