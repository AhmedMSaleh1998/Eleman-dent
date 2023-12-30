<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BasketResource extends JsonResource
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
            'id' => $this->id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'total' => $this->price * $this->quantity,
            'product' => new ProductResource($this->product_size->product),
            'size' => new SizeResource($this->product_size->size),
            'color' => new ProductColorResource($this->color),
            'user'    => new UserResource($this->user),
            
        ];
    }
}