<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            BrandsTableSeeder::class,
            CarsTableSeeder::class,
            ServicesTabelSeeder::class
            // Add other seeders here
        ]);

    }
}
