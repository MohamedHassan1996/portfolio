<?php

namespace App\Http\Resources\Product\ProductCategory;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // Extract translations for different locales
        $translations = $this->translations->mapWithKeys(function ($translation) {
            return [
                'name' . ucfirst($translation->locale) => $translation->name ?? "",
            ];
        });

        return [
            'productCategoryId' => $this->id,
            'isActive' => $this->is_active,

            // Translated fields
            'nameEn' => $translations['nameEn'] ?? "",
            'nameAr' => $translations['nameAr'] ?? "",
        ];
    }

}
