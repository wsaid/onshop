<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->uuid,
            'type' => $this->resourceType,
            'attributes' => [
                'status' => $this->status,
                'coupon' => [
                    'code' => $this->coupon,
                    'reduction' => $this->reduction
                ],
                'total' => $this->total
            ],
            'relationships' => [
                'items' => CartItemResource::collection(
                    $this->whenLoaded(
                        'items'
                    )
                )
            ]
        ];
    }
}
