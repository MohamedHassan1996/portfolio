<?php

namespace App\Http\Resources\FrontPage\FrontPageSection;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

use function PHPUnit\Framework\isEmpty;

class FrontPageSectionResource extends JsonResource
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
                'content' . ucfirst($translation->locale) => $translation->content ?? "",
            ];
        });

        return [
            'frontPageSectionId' => $this->id,
            'isActive' => $this->is_active,
            'name' => $this->name,
            'images' => empty($this->images) ? [] : FrontPageSectionImageResource::collection($this->images),

            // Translated fields
            'contentEn' => $translations['contentEn'] ?? [],
            'contentAr' => $translations['contentAr'] ?? [],
        ];
    }

}
