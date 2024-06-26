<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Car;
use App\Models\Brand;


class CarPart extends Model
{
    protected $fillable = [
        'brand_id',
        'car_id',
        'name',
        'description',
        'price',
        'year_of_production',
        'brand_id',
        'image_url'
    ];
    
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function car()
    {
        return $this->belongsTo(Car::class);
    }
}