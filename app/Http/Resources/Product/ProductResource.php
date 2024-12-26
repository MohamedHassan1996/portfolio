<?php

namespace App\Http\Resources\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use function PHPUnit\Framework\isEmpty;

class ProductResource extends JsonResource
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
                'slug' . ucfirst($translation->locale) => $translation->slug ?? "",
                'description' . ucfirst($translation->locale) => $translation->description ?? "",
                'content' . ucfirst($translation->locale) => $translation->content ?? "",
                'metaData' . ucfirst($translation->locale) => $translation->meta_data ?? "",
            ];
        });

        return [
            'productId' => $this->id,
            'isActive' => $this->is_active,

            // Translated fields
            'nameEn' => $translations['nameEn'] ?? "",
            'nameAr' => $translations['nameAr'] ?? "",
            'slugEn' => $translations['slugEn'] ?? "",
            'slugAr' => $translations['slugAr'] ?? "",
            'descriptionEn' => $translations['descriptionEn'] ?? "",
            'descriptionAr' => $translations['descriptionAr'] ?? "",
            'contentEn' => $translations['contentEn'] ?? "",
            'contentAr' => $translations['contentAr'] ?? "",
            'metaDataEn' => isEmpty($translations['metaDataEn'])? [] : $translations['metaDataEn'],
            'metaDataAr' => isEmpty($translations['metaDataAr'])? [] : $translations['metaDataAr'],
        ];
    }

}
