<?php

namespace App\Http\Resources\Select\Catalogue;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CatalogueSelectResource extends JsonResource
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
                'status' => $this->status,
                "products" => $this->product_count,
                'year'=> $this->year,
                'season'=> $this->season,
                'yearId' => $this->yearId??0,
                'seasonId' => $this->seasonId??0,
                'startPreorder' => $this->start_preorder?$this->start_preorder:"",
                'endPreorder' => $this->end_preorder?$this->end_preorder:"",
                'imagePath' => $this->image_path?$this->image_path:""
            ]
        ];

    }
}
