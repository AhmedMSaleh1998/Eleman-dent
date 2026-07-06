<?php

namespace App\Http\Resources;

use App\Models\Product;
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
        // منتجات القسم نفسه + كل الأقسام الفرعية بأي عمق
        $categoryIds = array_merge([$this->id], $this->resource->descendantIds());

        return [
            'id' => $this->id,
            'name' => $this->name,
            'image' => $this->image ? asset('admin_assets/images/categories/' . $this->image) : null,
            'parent_id' => $this->parent_id,
            'alt' => $this->alt,
            'keywords' => $this->keywords,
            'keywords_meta' => $this->keywords_meta,
            'title' => $this->title,
            'description' => $this->description,
            'description_meta' => $this->description_meta,
            'breadcrumbs' => collect($this->resource->ancestors())->map(function ($ancestor) {
                return [
                    'id' => $ancestor->id,
                    'name' => $ancestor->name,
                ];
            })->values(),
            'children' => ListCategoryResource::collection(
                $this->activeChildren()->with('translations')->get()
            ),
            'products' => ListProductResource::collection(
                Product::active()
                    ->whereHas('categories', function ($query) use ($categoryIds) {
                        $query->whereIn('categories.id', $categoryIds);
                    })
                    ->orderBy('seq', 'asc')
                    ->get()
            ),
        ];
    }
}
