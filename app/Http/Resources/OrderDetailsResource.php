<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $items = $this->cartItem->map(function ($item) {
            return [
                'id'       => $item->id,
                'product'  => $item->product ? new ListProductResource($item->product) : null,
                'price'    => $item->price,
                'quantity' => $item->quantity,
                'subtotal' => round($item->price * $item->quantity, 2),
            ];
        });

        $subtotal = round($this->cartItem->sum(fn ($item) => $item->price * $item->quantity), 2);

        return [
            'id'         => $this->id,
            'status'     => $this->status,
            'payment'    => new PaymentResource($this->payment),
            'address'    => new AddressResource($this->address),
            'items'      => $items,
            'items_count' => $items->count(),
            'subtotal'   => $subtotal,
            'shipping'   => $this->shipping ?? 0,
            'total'      => $this->total,
            'created_at' => $this->created_at,
        ];
    }
}
