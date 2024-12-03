<?php

namespace App\Http\Resources\Select\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BirthDateSelectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'value' => $this->birth_date,
            'label' => $this->birth_date,
        ];
    }
}
