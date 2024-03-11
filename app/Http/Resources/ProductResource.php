<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\Mime\Part\Multipart\RelatedPart;

class ProductResource extends JsonResource
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
            'name' => $this->name,
            'description' => $this->description ?? '',
            'image' => asset('admin_assets/images/products/' . $this->image), 
            'price' => $this->price ?? 0,
            'is_favourite' => $this->is_favourite(),
            'in_cart' => 0,
            'status' => $this->status,
            'path' => asset('admin_assets/images/products/'),
            'images' => $this->all_images(),
            'category' => new CategoryResource($this->category),
        ];
    }
}
