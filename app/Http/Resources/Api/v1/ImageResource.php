<?php

namespace App\Http\Resources\Api\v1;

use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */

    /**
     * @OA\Schema(
     *     schema="ImageResource",
     *     description="Images",
     *     type="object",
     *     @OA\Property(property="id", type="int", example="1735"),
     *     @OA\Property(property="name", type="string", example="1212121245randomkey"),
     *     @OA\Property(property="width", type="integer", example="100"),
     *     @OA\Property(property="height", type="integer", example="100"),
     * )
     */

    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'width' => $this->width,
            'height' => $this->height,
        ];
    }
}
