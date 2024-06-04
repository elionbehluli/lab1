<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Service;

class ServicesTabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Service::create([
            'name' => 'Toyota',
            'description' => 'Japan',
            'duration' => '2024-05-28'
        ]);
        Service::create([
            'name' => 'Oil',
            'description' => 'Japan',
            'duration' => '2023-05-28'
        ]);
        Service::create([
            'name' => 'Tier',
            'description' => 'Japan',
            'duration' => '2022-05-28'
        ]);
        Service::create([
            'name' => 'Fill',
            'description' => 'Japan',
            'duration' => '2021-05-28'
        ]);
    }
}
