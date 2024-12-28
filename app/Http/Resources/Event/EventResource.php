<?php

namespace App\Http\Resources\Event;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class EventResource extends JsonResource
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
                'description' . ucfirst($translation->locale) => $translation->description ?? "",
                'slug' . ucfirst($translation->locale) => $translation->slug ?? "",
                'metaData' . ucfirst($translation->locale) => $translation->meta_data ?? [],
            ];
        });

        return [
            'eventId' => $this->id,
            'date' => $this->date ?? '',
            'time' => $this->time ?? '',
            'location' => $this->location ?? '',
            'thumbnail' => $this->thumbnail ? Storage::disk('public')->url($this->thumbnail) : "",
            'isPublished' => $this->is_published,

            // Translated fields
            'titleEn' => $translations['titleEn'] ?? "",
            'titleAr' => $translations['titleAr'] ?? "",
            'descriptionEn' => $translations['descriptionEn'] ?? "",
            'descriptionAr' => $translations['descriptionAr'] ?? "",
            'slugEn' => $translations['slugEn'] ?? "",
            'slugAr' => $translations['slugAr'] ?? "",
            'metaDataEn' => $translations['metaDataEn'] ?? [],
            'metaDataAr' => $translations['metaDataAr'] ?? [],
        ];
    }

}
