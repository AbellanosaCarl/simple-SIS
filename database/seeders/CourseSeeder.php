<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    public function run()
    {
        Course::insert([
            ['name' => 'Computer Science'],
            ['name' => 'Information Technology'],
            ['name' => 'Engineering'],
            ['name' => 'Business Administration'],
        ]);
    }
}
