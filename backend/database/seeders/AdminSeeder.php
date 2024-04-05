<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define admin credentials
        $adminData = [
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Admin123.'),
        ];

        // Insert admin data into the database
        DB::table('users')->insert($adminData);
    }
}
