<?php

namespace App\Http\Resources\Select\Brand;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BrandWithCatalogueCountSelectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'value' => $this->id,
            'label' => [
                'label' => $this->label,
                'imagePath' => $this->file_path?$this->file_path:"",
                'catalogueCount' => $this->catalogue_count
            ]
        ];

    }
}
