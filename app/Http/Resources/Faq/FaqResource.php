<?php

namespace App\Http\Resources\Faq;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FaqResource extends JsonResource
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
                'question' . ucfirst($translation->locale) => $translation->question ?? "",
                'answer' . ucfirst($translation->locale) => $translation->answer ?? "",
            ];
        });

        return [
            'faqId' => $this->id,
            'isPublished' => $this->is_published,

            // Translated fields
            'questionEn' => $translations['questionEn'] ?? "",
            'questionAr' => $translations['questionAr'] ?? "",
            'answerEn' => $translations['answerEn'] ?? "",
            'answerAr' => $translations['answerAr'] ?? "",
        ];
    }

}
