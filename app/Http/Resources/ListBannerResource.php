<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Symfony\Component\Mime\Part\Multipart\RelatedPart;

class ListBannerResource extends JsonResource
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
            'alt' => $this->alt,
            'image' => asset('admin_assets/images/banners/' . $this->image), 

        ];
    }
}
