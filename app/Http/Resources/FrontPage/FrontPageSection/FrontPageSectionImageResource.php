<?php

namespace App\Http\Resources\FrontPage\FrontPageSection;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class FrontPageSectionImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        return [
            'imageId' => $this->id,
            'path' => Storage::disk('public')->url($this->path),
        ];
    }

}
