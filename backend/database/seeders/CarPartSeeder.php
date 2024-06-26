<?php

use Illuminate\Database\Seeder;
use App\Models\CarPart;

class CarPartSeeder extends Seeder
{
    public function run()
    {
        CarPart::create([
            'brand_id' => 1,
            'car_id' => 1,
            'name' => 'Engine Oil',
            'description' => 'High-performance engine oil for all weather conditions.',
            'price' => 29.99,
            'year_of_production' => 2022,
            'image_url' => 'engine_oil.jpg',
        ]);

        // Add more sample data as needed...
    }
}
