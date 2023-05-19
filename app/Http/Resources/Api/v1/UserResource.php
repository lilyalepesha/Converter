<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    /**
     * @OA\Schema(
     *     schema="UserResource",
     *     description="Information about user",
     *     type="object",
     *     @OA\Property(property="id", type="int", example="17"),
     *     @OA\Property(property="name", type="string", example="Ilya"),
     *     @OA\Property(property="email", type="email", example="uploadfile14@gmail.com"),
     * )
     */


    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
        ];
    }
}
