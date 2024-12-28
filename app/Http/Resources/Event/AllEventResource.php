<?php

namespace App\Http\Resources\Event;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class AllEventResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {


        return [
            'eventId' => $this->id,
            'title' => $this->title,
            'date' => $this->date?Carbon::parse($this->date)->format('d/m/Y'):"",
            'time' => $this->time?Carbon::parse($this->time)->format('H:i'):"",
            'location' => $this->location??'',
            'thumbnail' => $this->thumbnail?Storage::disk('public')->url($this->thumbnail):"",
            'publishedAt' => $this->published_at ? Carbon::parse($this->published_at)->format('d/m/Y H:i:s') : "",
            'isPublished' => $this->is_published
        ];
    }
}
