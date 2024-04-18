<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'brand_id' => $this->brand_id,
            'brand_name' => $this->brand ? $this->brand->name : null,
            'model' => $this->model,
            'color' => $this->color,
            'year' => $this->year,
            'price' => $this->price,
            'mileage' => $this->mileage,
            'transmission_type' => $this->transmission_type,
            'fuel_type' => $this->fuel_type,
            'engine_size' => $this->engine_size,
            'number_of_seats' => $this->number_of_seats,
            'body_type' => $this->body_type,
            'features' => json_decode($this->features, true), // Convert JSON string to array
            'images' => CarImageResource::collection($this->images),
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
