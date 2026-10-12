<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat akun Admin
        User::create([
            'name' => 'Admin SkillConnect',
            'email' => 'admin@skillconnect.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            'role' => 'admin',
        ]);

        // Membuat akun Member (User biasa)
        User::create([
            'name' => 'User Member',
            'email' => 'member@skillconnect.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            'role' => 'member',
        ]);

         User::create([
            'name' => 'della',
            'email' => 'della@skillconnect.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            'role' => 'member',
        ]);

        User::create([
            'name' => 'mulmul',
            'email' => 'mulia@skillconnect.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            'role' => 'member',
        ]);

        User::create([
            'name' => 'vinda',
            'email' => 'vinda@skillconnect.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            'role' => 'member',
        ]);

        User::create([
            'name' => 'salim',
            'email' => 'salim@skillconnect.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            'role' => 'member',
        ]);

        User::create([
            'name' => 'farel',
            'email' => 'farel@skillconnect.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password123'),
            'role' => 'member',
        ]);

    }
}
