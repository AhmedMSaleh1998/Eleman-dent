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
            'is_discount' => $this->is_discount,
            'discount_price' => $this->discount_price ?? 0,
            'category' => new CategoryResource($this->category),
            'material' => new ProductMaterialResource($this->material),
            'color' => new ProductColorResource($this->color),
            'model' => new ProductModelResource($this->shoe_model),
            'sole' => new ProductSoleResource($this->sole),
            'sizes' => ProductSizesResource::collection($this->sizes),
            //'images' => ProductImagesResource::collection($this->all_images()),
            'rates' => ProductRatesResource::collection($this->rates),
            'rate_count' => $this->whenLoaded('rates', function () {
                return $this->rates->count();
            }),
            'rate_avg' => $this->whenLoaded('rates', function () {
                return $this->rates->avg('rate');
            }),
            'related' => RelatedProductsResource::collection($this->related()),
            'is_favourite' => $this->is_favourite(),
            'status' => $this->status,
            'path' => asset('admin_assets/images/products/'),
            'all_images' => $this->all_images(),
        ];
    }
}
