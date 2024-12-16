<?php

namespace App\Http\Resources\ContactUs;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class AllContactUsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {


        return [
            'contactUsId' => $this->id,
            'subject' => $this->subject,
            'name' => $this->name??"",
            'email' => $this->email??"",
            'phone' => $this->phone??"",
            'status' => $this->status,
            'newMessagesCount' => $this->newMessagesCount
        ];

    }
}
