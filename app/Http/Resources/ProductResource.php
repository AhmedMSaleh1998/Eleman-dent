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
            'pdf' => $this->pdf !== null ? asset('admin_assets/images/product_pdfs/' . $this->pdf) : null, 
            'price' => $this->price ?? 0,
            'discount_price' => $this->discount_price ?? 0,
            'is_favourite' => $this->is_favourite($this->product),
            'in_cart' => 0,
            'status' => $this->status,
            'quantity' => $this->quantity,
            'path' => asset('admin_assets/images/products/'),
            'images' => $this->all_images(),
            'description_meta' => $this->description_meta ?? '',
            'keywords' => $this->keywords ?? '',
            'keywords_meta' => $this->keywords_meta ?? '',
            'category' => new CategoryResource($this->category),
            'video_url' => $this->video_url,
        ];
    }
}
