<?php

namespace App\Http\Resources\ContactUs\ContactUsMessage;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AllContactUsMessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {


        return [
            'contactUsMessageId' => $this->id,
            'message' => $this->message,
            'isAdmin' => $this->is_admin,
            'adminName' => $this->created_by != null? $this->user->name : '',
            'sentAt' => Carbon::parse($this->created_at)->format('d/m/Y H:i'),
        ];
    }
}
