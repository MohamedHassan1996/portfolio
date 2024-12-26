<?php

namespace App\Http\Resources\Blog\BlogCategory;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class BlogCategoryResource extends JsonResource
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
            ];
        });
        return [
            'blogCategoryId' => $this->id,
            'isActive' => $this->is_active,
            'nameEn' => $translations['nameEn'] ?? "", // Ensure English fallback if translation is missing
            'nameAr' => $translations['nameAr'] ?? "",
            'slugEn' => $translations['slugEn'] ?? "",
            'slugAr' => $translations['slugAr'] ?? "",
        ];
    }
}
