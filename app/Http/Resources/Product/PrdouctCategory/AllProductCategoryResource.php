<?php

namespace App\Http\Resources\Product\ProductCategory;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AllProductCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {


        return [
            'productCategoryId' => $this->id,
            'name' => $this->name,
            'isActive' => $this->is_active,
        ];
    }
}
