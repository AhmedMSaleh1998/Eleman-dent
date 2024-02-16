<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CustomerReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'name' => $this->id,
            'job' => 'Doctor',
            'review' => $this->review,
            'image' => asset('admin_assets/images/reviews/' . $this->image),
        ];
    }
}
