<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Subject;

class SubjectsTableSeeder extends Seeder
{
    public function run(): void
    {
        $subjects = [
            [
                'code' => 'GE101',
                'name' => 'Understanding the Self',
                'description' => 'Nature of identity, factors affecting personality development.',
                'units' => 3,
            ],
            [
                'code' => 'GE102',
                'name' => 'Mathematics in the Modern World',
                'description' => 'Mathematics as an important tool in understanding the modern world.',
                'units' => 3,
            ],
            [
                'code' => 'IT101',
                'name' => 'Introduction to Computing',
                'description' => 'Basic concepts and principles of computing and information technology.',
                'units' => 3,
            ],
            [
                'code' => 'IT102',
                'name' => 'Computer Programming 1',
                'description' => 'Fundamentals of computer programming using a high-level language.',
                'units' => 3,
            ],
            [
                'code' => 'IT103',
                'name' => 'Web Development',
                'description' => 'Basic concepts of web development and design.',
                'units' => 3,
            ],
            [
                'code' => 'IT104',
                'name' => 'Database Management Systems',
                'description' => 'Concepts and principles of database design and management.',
                'units' => 3,
            ],
            [
                'code' => 'PE101',
                'name' => 'Physical Fitness',
                'description' => 'Basic physical education and fitness activities.',
                'units' => 2,
            ],
            [
                'code' => 'NSTP1',
                'name' => 'National Service Training Program 1',
                'description' => 'Civic consciousness and defense preparedness.',
                'units' => 3,
            ],
            [
                'code' => 'ENG101',
                'name' => 'Purposive Communication',
                'description' => 'Writing and speaking skills for academic and professional purposes.',
                'units' => 3,
            ],
            [
                'code' => 'FIL101',
                'name' => 'Filipino sa Iba\'t Ibang Disiplina',
                'description' => 'Gamit ng Filipino sa iba\'t ibang larangan.',
                'units' => 3,
            ],
        ];

        foreach ($subjects as $subject) {
            Subject::create($subject);
        }
    }
}