<?php

namespace App\Http\Resources\User;

use App\Http\Resources\Role\RoleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

class AllUserDataResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {


        //dd($userData);

        return [
            'userId' => $this->id,
            'name' => $this->name??"",
            'email' => $this->email??"",
            'username' => $this->username??"",
            'phone' => $this->phone??"",
            'address' => $this->address??"",
            'status' => $this->status,
            'avatar' => $this->avatar?Storage::disk('public')->url($this->avatar):"",
            'roleId' => RoleResource::collection($this->whenLoaded('roles'))[0]->id,
        ];
    }
}
