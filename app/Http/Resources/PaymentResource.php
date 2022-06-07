<?php

namespace App\Http\Resources;

use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Resources\Json\JsonResource;

class PaymentResource extends JsonResource
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
        $user = Payment::findOrFail($array["id"])->user;

        $array["user"] = [];

        $array["user"] = [
            "id" => $user->id,
            "name" => $user->name,
        ];

        return $array;
    }
}
