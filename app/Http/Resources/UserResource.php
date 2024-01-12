<?php

namespace App\Http\Resources;

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
        $original = [
            'id' => $this->id,
            'email' => $this->email,
            'name' => $this->name,
            'phone' => $this->phone,
            'code' => $this->code,
            'status' => $this->status,
            'image' => $this->image == null ? null : asset('admin_assets/images/users/' . $this->image),
            //'cart_count' => $this->baskets->count() == null ? 0 : $this->baskets->count(),
        ];
        return array_merge($original, [
            'token' => $this->token,
        ]);/*
        return [
            'id' => $this->id,
            'name' => $this->name,
            'phone' => $this->phone,
            'code' => $this->code,
            'status' => $this->status,
            'image' => asset('admin_assets/images/users/' . $this->image),
            'cart_count' => $this->baskets->count(),
        ]; */
    }
}
