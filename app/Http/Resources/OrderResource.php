<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'id'         => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'payment'    => new PaymentResource($this->payment_method),
            'address'    => new AddressResource($this->address),
            'user'       => new UserResource($this->user),
            'total' => $this->total,
            'shipping' => $this->shipping,
            'cart_items' => BasketResource::collection($this->cart_items),
            'status'     => $this->status,
        ];
    }
}