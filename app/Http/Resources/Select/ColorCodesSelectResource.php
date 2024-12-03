<?php

namespace App\Http\Resources\Select;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ColorCodesSelectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'value' => $this->id,
            'label' => substr($this->variantField[0]->pivot->value, 1)
        ];
    }
}
