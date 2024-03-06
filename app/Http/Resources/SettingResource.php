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
            'location_one' => $this->location_one,
            'location_two' => $this->location_two,
            'phone_one' => $this->phone_one,
            'phone_two' => $this->phone_two,
            'src_one' => $this->src_one,
            'src_two' => $this->src_two,
            'email' => $this->email,
            'facebook' => $this->facebook,
            'linkedin' => $this->twitter,
            'instagram' => $this->instagram,
            'youtube' => $this->youtube,
            'whatsapp' => $this->whatsapp,
            'address_one' => $this->address_one,
            'address_two' => $this->address_two,
            'keywords' => $this->keywords,
            'aboutus' => $this->about_us,
            'privacy' => $this->privacy,
            'terms' => $this->terms,
        ];
    }
}
