<?php

namespace App\Http\Resources\FrontPage;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FrontPageResource extends JsonResource
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
                'title' . ucfirst($translation->locale) => $translation->title ?? "",
                'slug' . ucfirst($translation->locale) => $translation->slug ?? "",
                'metaData' . ucfirst($translation->locale) => $translation->meta_data ?? [],
            ];
        });

        return [
            'frontPageId' => $this->id,
            'isActive' => $this->is_active,

            // Translated fields
            'titleEn' => $translations['titleEn'] ?? "",
            'titleAr' => $translations['titleAr'] ?? "",
            'slugEn' => $translations['slugEn'] ?? "",
            'slugAr' => $translations['slugAr'] ?? "",
            'metaDataEn' => $translations['metaDataEn'] ?? [],
            'metaDataAr' => $translations['metaDataAr'] ?? [],
        ];
    }

}
