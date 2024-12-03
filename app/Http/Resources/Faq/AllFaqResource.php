<?php

namespace App\Http\Resources\Faq;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AllFaqResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {


        return [
            'faqId' => $this->id,
            'question' => $this->question,
            'order' => $this->order,
            'isPublished' => $this->is_published
        ];
    }
}
