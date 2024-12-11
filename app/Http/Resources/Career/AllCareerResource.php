<?php

namespace App\Http\Resources\Career;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class AllCareerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {


        return [
            'careerId' => $this->id,
            'title' => $this->title,
            'description' => $this->description??"",
            'isActive' => $this->is_active,
        ];
    }
}
