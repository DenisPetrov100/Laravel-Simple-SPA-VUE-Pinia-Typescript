<?php

namespace App\Http\Resources;

use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $array = parent::toArray($request);
        $role = User::findOrFail($array["id"])->roles->first();

        $array["role"] = [];

        $array["role"] = [
            "id" => $role->id,
            "name" => $role->name,
        ];

        return $array;
    }
}
