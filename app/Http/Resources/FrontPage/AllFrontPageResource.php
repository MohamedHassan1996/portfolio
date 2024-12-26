<?php

namespace App\Http\Resources\FrontPage;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AllFrontPageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {


        return [
            'frontPageId' => $this->id,
            'title' => $this->title,
            'isActive' => $this->is_active,
        ];
    }
}
