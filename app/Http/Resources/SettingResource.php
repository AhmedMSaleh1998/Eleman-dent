<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SettingResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'location' => $this->location,
            'phone' => $this->phone,
            'email' => $this->email,
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'instagram' => $this->instagram,
            'youtube' => $this->youtube,
            'whatsapp' => $this->whatsapp,
            'address' => $this->address,
            'keywords' => $this->keywords,
            'aboutus' => $this->about_us,
            'privacy' => $this->privacy,
            'terms' => $this->terms,
        ];
    }
}
