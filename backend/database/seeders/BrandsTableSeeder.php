<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::create([
            'name' => 'Toyota',
            'country_of_origin' => 'Japan',
        ]);
        Brand::create([
            'name' => 'BMW',
            'country_of_origin' => 'Germany',
        ]);
        Brand::create([
            'name' => 'Ferrari',
            'country_of_origin' => 'Italy',
        ]);
        Brand::create([
            'name' => 'Audi',
            'country_of_origin' => 'Germany',
        ]);
    }
}
