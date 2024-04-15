<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Models\Car;

class CarsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       // Fetch brand IDs
       $toyota = Brand::where('name', 'Toyota')->first();
       $bmw = Brand::where('name', 'BMW')->first();
       $audi = Brand::where('name', 'Audi')->first();
       $ferrari = Brand::where('name', 'Ferrari')->first();

       // Create cars for Toyota
       Car::create([
           'brand_id' => $toyota->id,
           'model' => 'Camry',
           'color' => 'Black',
           'year' => 2021,
           'price' => 30000,
           'mileage' => 15000,
           'transmission_type' => 'Automatic',
           'fuel_type' => 'Petrol',
           'engine_size' => '2.5L',
           'number_of_seats' => 5,
           'body_type' => 'Sedan',
           'features' => json_encode(['GPS', 'Bluetooth', 'Leather Seats']),
       ]);
      
        Car::create([
            'brand_id' => $toyota->id,
            'model' => 'Corolla',
            'color' => 'Blue',
            'year' => 2022,
            'price' => 25000,
            'mileage' => 20000,
            'transmission_type' => 'Automatic',
            'fuel_type' => 'Petrol',
            'engine_size' => '1.8L',
            'number_of_seats' => 5,
            'body_type' => 'Sedan',
            'features' => json_encode(['GPS', 'Bluetooth', 'Leather Seats']),
        ]);

       // Create cars for BMW
       Car::create([
           'brand_id' => $bmw->id,
           'model' => 'X5',
           'color' => 'White',
           'year' => 2020,
           'price' => 50000,
           'mileage' => 20000,
           'transmission_type' => 'Automatic',
           'fuel_type' => 'Diesel',
           'engine_size' => '3.0L',
           'number_of_seats' => 5,
           'body_type' => 'SUV',
           'features' => json_encode(['GPS', 'Sunroof', 'Leather Seats']),
       ]);

       // Create cars for Audi
       Car::create([
           'brand_id' => $audi->id,
           'model' => 'A4',
           'color' => 'Silver',
           'year' => 2021,
           'price' => 40000,
           'mileage' => 18000,
           'transmission_type' => 'Automatic',
           'fuel_type' => 'Petrol',
           'engine_size' => '2.0L',
           'number_of_seats' => 5,
           'body_type' => 'Sedan',
           'features' => json_encode(['GPS', 'Bluetooth', 'Leather Seats']),
       ]);

       // Create cars for Ferrari
       Car::create([
           'brand_id' => $ferrari->id,
           'model' => '488 GTB',
           'color' => 'Red',
           'year' => 2019,
           'price' => 250000,
           'mileage' => 5000,
           'transmission_type' => 'Automatic',
           'fuel_type' => 'Petrol',
           'engine_size' => '3.9L',
           'number_of_seats' => 2,
           'body_type' => 'Coupe',
           'features' => json_encode(['GPS', 'Carbon Fiber Interior', 'Rear Camera']),
       ]);
    }
}
