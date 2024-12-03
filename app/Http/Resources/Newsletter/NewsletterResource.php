<?php

namespace App\Http\Resources\Newsletter;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class NewsletterResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'newsletterId' => $this->id,
            'subject' => $this->subject,
            'content' => $this->content??"",
            'isSent' => $this->is_sent
        ];
    }
}
