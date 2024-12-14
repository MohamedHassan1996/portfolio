<?php

namespace App\Services\Newsletter;

use App\Enums\Newsletter\NewsletterSubsciberStatus;
use App\Filters\Newsletter\FilterSubscriber;
use App\Models\Newsletter\Subscriber;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class SubscriberService{

    private $subscriber;
    public function __construct(Subscriber $subscriber)
    {
        $this->subscriber = $subscriber;
    }

    public function allSubscribers()
    {
        $subscribers = QueryBuilder::for(Subscriber::class)
            ->allowedFilters([
                AllowedFilter::custom('search', new FilterSubscriber()), // Add a custom search filter
                AllowedFilter::exact('isSubscribed'), // Add a custom search filter
            ])->get();

        return $subscribers;

    }

    public function createSubscriber(array $subscriberData): Subscriber
    {

        $subscriber = Subscriber::create([
            'email' => $subscriberData['email'],
            'is_subscribed' => NewsletterSubsciberStatus::from($subscriberData['isSubscribed'])->value,
        ]);

        return $subscriber;

    }

    public function editSubscriber(int $subscriberId)
    {
        return Subscriber::find($subscriberId);
    }

    public function updateSubscriber(array $subscriberData): Subscriber
    {

        $subscriber = Subscriber::find($subscriberData['subscriberId']);
        $subscriber->update([
            'email' => $subscriberData['email'],
            'is_subscribed' => NewsletterSubsciberStatus::from($subscriberData['isSubscribed'])->value,
        ]);

        return $subscriber;


    }


    public function deleteSubscriber(int $subscriberId)
    {

        Subscriber::find($subscriberId)->delete();

    }

    public function changeStatus(int $subscriberId, bool $isSubscribed)
    {
        $subscriber = Subscriber::find($subscriberId);
        $subscriber->is_subscribed = $isSubscribed;
        $subscriber->save();
    }




}
