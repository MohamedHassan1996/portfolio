<?php

namespace App\Http\Resources\Select\PriceList;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PriceListBaseSelectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */

    public function toArray(Request $request): array
    {
        return [
            'value' => $this['base'],
            'label' => $this['base'],
        ];
    }
}
