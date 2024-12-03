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
            'description' => $this->description??"",
            'date' => $this->date?Carbon::parse($this->date)->format('d/m/Y'):"",
            'time' => $this->time?Carbon::parse($this->time)->format('H:i'):"",
            'location' => $this->location??'',
            'slug' => $this->slug??"",
            'thumbnail' => $this->thumbnail?Storage::url($this->thumbnail):"",
            'metaData' => $this->meta_data??[],
            'publishedAt' => $this->published_at ? Carbon::parse($this->published_at)->format('d/m/Y H:i:s') : "",
            'categoryName' => $this->blogCategory->name,
            'isPublished' => $this->is_published
        ];
    }
}
