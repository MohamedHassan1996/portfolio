<?php

namespace App\Http\Resources\Blog;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        $translations = $this->translations->mapWithKeys(function ($translation) {
            return [
                'title' . ucfirst($translation->locale) => $translation->name ?? "",
                'slug' . ucfirst($translation->locale) => $translation->slug ?? "",
                'content' . ucfirst($translation->locale) => $translation->content ?? "",
                'metaData' . ucfirst($translation->locale) => $translation->meta_data ?? [],
            ];
        });

        return [
            'blogId' => $this->id,
            'titleAr' => $translations['titleAr'] ?? "",
            'titleEn' => $translations['titleEn'] ?? "",
            'slugAr' => $translations['slugAr'] ?? "",
            'slugEn' => $translations['slugEn'] ?? "",
            'contentAr' => $translations['contentAr'] ?? "",
            'contentEn' => $translations['contentEn'] ?? "",
            'metaDataAr' => $translations['metaDataAr'] ?? [],
            'metaDataEn' => $translations['metaDataEn'] ?? [],
            'thumbnail' => $this->thumbnail?Storage::disk('public')->url($this->thumbnail):"",
            'categoryId' => $this->category_id,
            'isPublished' => $this->is_published
        ];
    }
}
