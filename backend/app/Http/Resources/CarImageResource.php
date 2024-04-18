<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarImageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id, // CarImage ID
            'car_id' => $this->car_id, // ID of the associated Car
            'image_url' => asset('storage/' . $this->image_url), // Full URL to the image
            'created_at' => $this->created_at->toIso8601String(), // Creation timestamp
            'updated_at' => $this->updated_at->toIso8601String(), // Update timestamp
        ];
    }
}
