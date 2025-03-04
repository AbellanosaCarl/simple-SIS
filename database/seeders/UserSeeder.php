<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        for ($i = 0; $i < 50; $i++) {
            $student_number = 2201100000 + $i; // Generates unique numbers (2201100000, 2201100001, ...)

            User::create([
                'name' => fake()->name(),
                'email' => $student_number . '@student.buksu.edu.ph',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'remember_token' => Str::random(10),
                'is_admin' => false,
            ]);
            User::insert([
                ['name' => 'ADMIN'],
                ['email' => 'admin@gmail.com'],
                ['password' => 'admin123'],
                ['email_verified_at' => now(),],
                ['remember_token' => Str::random(10)],
                ['is_admin' => true],
            ]);
        }
    }
}
