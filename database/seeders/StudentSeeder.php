<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Student;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $courses = ['BSIT', 'BSCS', 'BSIS', 'BSEMC'];
        $yearLevels = [1, 2, 3, 4];

        // Create 50 sample students
        for ($i = 1; $i <= 50; $i++) {
            // Create user first
            $user = User::create([
                'name' => fake()->name(),
                'email' => '2201' . str_pad($i, 6, '0', STR_PAD_LEFT) . '@student.buksu.edu.ph',
                'password' => Hash::make('pass1234'),
                'is_admin' => false,
                'email_verified_at' => now(),
            ]);

            // Create associated student record
            Student::create([
                'user_id' => $user->id,
                'age' => fake()->numberBetween(18, 25),
                'year_level' => fake()->randomElement($yearLevels),
                'course' => fake()->randomElement($courses)
            ]);
        }

        // Create an admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'is_admin' => true,
            'email_verified_at' => now(),
        ]);
    }
}