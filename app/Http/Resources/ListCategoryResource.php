<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ListCategoryResource extends JsonResource
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
            'description' => $this->description,
            'image' => $this->image ? asset('admin_assets/images/categories/' . $this->image) : null,
            'banner' => $this->banner ? asset('admin_assets/images/categories/banners/' . $this->banner) : null,
            'parent_id' => $this->parent_id,
            'products_count' => $this->products()->count(),
            'children' => ListCategoryResource::collection(
                $this->activeChildren()->with('translations')->get()
            ),
        ];
    }
}
