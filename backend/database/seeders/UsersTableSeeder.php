<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Add admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('Admin123.'),
            'role' => 'admin'
        ]);

        User::create([
            'name' => 'Employee',
            'email' => 'employee@gmail.com',
            'password' => Hash::make('Employee123.'),
            'role' => 'employee'
        ]);

        // Add three employee users
        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => 'Employee' . ($i + 1),
                'email' => 'employee' . ($i + 1) . '@example.com',
                'password' => Hash::make('password'),
                'role' => 'employee'
            ]);
        }

        User::create([
            'name' => 'Customer',
            'email' => 'customer@gmail.com',
            'password' => Hash::make('Customer123.'),
            'role' => 'customer'
        ]);
        // Add three customer users
        for ($i = 0; $i < 10; $i++) {
            User::create([
                'name' => 'Customer ' . ($i + 1),
                'email' => 'customer' . ($i + 1) . '@example.com',
                'password' => Hash::make('password'),
                'role' => 'customer'
            ]);
        }
    }
}
