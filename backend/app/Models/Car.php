<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Brand;
use App\Models\CarImage;
use App\Models\ServiceHistory;
use App\Models\CarPart;


class Car extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'brand_id',
        'model',
        'color',
        'year',
        'price',
        'mileage',
        'transmission_type',
        'fuel_type',
        'engine_size',
        'number_of_seats',
        'body_type',
        'features',
        'featured',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function images()
    {
        return $this->hasMany(CarImage::class);
    }

    public function serviceHistories()
    {
        return $this->hasMany(ServiceHistory::class);
    }

    public function carParts()
    {
        return $this->hasMany(CarPart::class);
    }
}
