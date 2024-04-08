<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
