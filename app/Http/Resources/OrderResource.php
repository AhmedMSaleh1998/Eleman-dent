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
            'payment'    => new PaymentResource($this->payment),
            'address'    => new AddressResource($this->address),
            'user'       => new UserResource($this->user),
            'total' => $this->total,
            'shipping' => $this->shipping,
            'status'     => $this->status,
        ];
    }
}