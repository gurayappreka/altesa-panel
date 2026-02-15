<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin User
        User::create([
            'name' => 'Admin',
            'email' => 'admin@altesa.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        // Manager User
        User::create([
            'name' => 'Manager',
            'email' => 'manager@altesa.com',
            'password' => Hash::make('password'),
            'role' => 'manager',
            'is_active' => true,
        ]);

        // Staff User
        User::create([
            'name' => 'Staff',
            'email' => 'staff@altesa.com',
            'password' => Hash::make('password'),
            'role' => 'staff',
            'is_active' => true,
        ]);
    }
}
