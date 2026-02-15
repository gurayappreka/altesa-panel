<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@altesa.com',
            'password' => bcrypt('demo1234'),
        ]);

        // Manager
        User::create([
            'name' => 'Proje Yöneticisi',
            'email' => 'manager@altesa.com',
            'password' => bcrypt('demo1234'),
        ]);

        // Staff
        User::create([
            'name' => 'Personel',
            'email' => 'staff@altesa.com',
            'password' => bcrypt('demo1234'),
        ]);
    }
}
