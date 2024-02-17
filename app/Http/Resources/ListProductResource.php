<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\Mime\Part\Multipart\RelatedPart;

class ListProductResource extends JsonResource
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
            'image' => asset('admin_assets/images/products/' . $this->image), 
            'price' => $this->price ?? 0,
            'is_cart' => 0,
            // 'is_favourite' => $this->is_favourite(),
            'is_favourite' =>0,
        ];
    }
}
