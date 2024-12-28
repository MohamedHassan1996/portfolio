<?php

namespace App\Http\Resources\Product\ProductImage;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class ProductImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {


        return [
            'imageId' => $this->id,
            'path' => Storage::disk('public')->url($this->path),
        ];
    }

}
