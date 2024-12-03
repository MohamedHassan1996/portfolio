<?php

namespace App\Http\Resources\Select;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryTreeSelectResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        /*$categories = parent::toArray($request);
        $categoriesArr = [];
        foreach ($categories as $key => $category) {
            $categoryParents = $category->
            
        }
        return $categories;*/
        return parent::toArray($request);
    }
}
