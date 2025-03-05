<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'age',
        'year_level',
        'course'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function subjects(): BelongsToMany
    {
        return $this->belongsToMany(Subject::class, 'student_subjects')
            ->withPivot('grade')
            ->withTimestamps();
    }

    public function getGradeAverage()
    {
        $validGrades = $this->subjects()
            ->get()
            ->filter(function ($subject) {
                // Only include numeric grades (exclude INC and null)
                return $subject->pivot->grade !== null && 
                       $subject->pivot->grade !== 'INC' && 
                       is_numeric($subject->pivot->grade);
            })
            ->map(function ($subject) {
                // Convert to float
                return (float) $subject->pivot->grade;
            });

        if ($validGrades->isEmpty()) {
            return 'N/A';
        }

        // Calculate average manually to avoid type issues
        $sum = $validGrades->sum();
        $count = $validGrades->count();
        $average = $sum / $count;

        return number_format($average, 2);
    }

    // Add a helper method to get grade status
    public function getGradeStatus()
    {
        $average = $this->getGradeAverage();
        
        if ($average === 'N/A') {
            return 'Not Available';
        }
        
        $numericAverage = (float) $average;
        if ($numericAverage <= 3.0) {
            return 'Passed';
        }
        
        return 'Failed';
    }
}
