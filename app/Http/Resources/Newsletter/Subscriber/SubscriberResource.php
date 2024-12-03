<?php

namespace App\Http\Resources\Newsletter\Subscriber;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SubscriberResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'subscriberId' => $this->id,
            'email' => $this->email,
            'isSubscribed' => $this->is_subscribed,
        ];
    }
}
