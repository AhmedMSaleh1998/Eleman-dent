<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
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
            'alt' => $this->alt,
            'keywords' => $this->keywords,
            'keywords_meta' => $this->keywords_meta,
            'title' => $this->title,
            'description' => $this->description,
            'description_meta' => $this->description_meta,
            'products' => $this->products
        ];
    }
}