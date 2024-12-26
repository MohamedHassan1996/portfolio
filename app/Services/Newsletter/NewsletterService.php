<?php

namespace App\Services\Newsletter;

use App\Enums\Newsletter\NewsletterStatus;
use App\Filters\Newsletter\FilterNewsletter;
use App\Mail\NewsletterMail;
use App\Models\Newsletter\Newsletter;
use App\Models\Newsletter\Subscriber;
use Illuminate\Support\Facades\Mail;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class NewsletterService{

    private $newsletter;
    public function __construct(Newsletter $newsletter)
    {
        $this->newsletter = $newsletter;
    }

    public function allNewsletters()
    {
        $newsletters = QueryBuilder::for(Newsletter::class)
            ->allowedFilters([
                AllowedFilter::custom('search', new FilterNewsletter()), // Add a custom search filter
            ])->get();

        return $newsletters;

    }

    public function createNewsletter(array $newsletterData): Newsletter
    {

        $newsletter = Newsletter::create([
            'subject' => $newsletterData['subject'],
            'content' => $newsletterData['content'],
            'is_sent' => NewsletterStatus::from($newsletterData['isSent'])->value,
        ]);

        if($newsletter->is_sent == NewsletterStatus::SENT){
            $this->sendNewsletterEmails($newsletter);
        }

        return $newsletter;

    }

    public function editNewsletter(int $newsletterId)
    {
        return Newsletter::find($newsletterId);
    }

    public function updateNewsletter(array $newsletterData): Newsletter
    {

        $newsletter = Newsletter::find($newsletterData['newsletterId']);

        $newsletter->subject = $newsletterData['subject'];
        $newsletter->content = $newsletterData['content'];
        $newsletter->is_sent = NewsletterStatus::from($newsletterData['isSent'])->value;

        if($newsletter->is_sent == NewsletterStatus::SENT){
            $this->sendNewsletterEmails($newsletter);
        }

        $newsletter->save();

        return $newsletter;


    }


    public function deleteNewsletter(int $newsletterId)
    {

        Newsletter::find($newsletterId)->delete();

    }

    public function changeStatus(int $newsletterId, int $isSent)
    {
        $newsletter = Newsletter::find($newsletterId);
        if($newsletter->is_sent == NewsletterStatus::NOT_SENT){
            $newsletter->is_sent = $isSent;
        }
        $newsletter->save();
    }

    protected function sendNewsletterEmails(Newsletter $newsletter): void
    {
        $subscribers = Subscriber::where('is_subscribed', true)->get();

        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)->send(new NewsletterMail($newsletter));
        }

    }


}
