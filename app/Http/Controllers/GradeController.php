<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class GradeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Grade $grade)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Student $student)
    {
        $student->load('subjects');
        return view('admin.grades.editForm', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Student $student)
    {
        $request->validate([
            'grades' => 'required|array',
            'grades.*' => [
                'nullable',
                'regex:/^([1-5](\.[0-9])?|INC)$/',
            ],
        ], [
            'grades.*.regex' => 'Grades must be between 1.0 and 5.0 with one decimal place, or INC.'
        ]);

        foreach ($request->grades as $subjectId => $grade) {
            // Format the grade to ensure it has one decimal place
            $formattedGrade = $grade === 'INC' ? 'INC' : number_format((float)$grade, 1);
            
            $student->subjects()->updateExistingPivot($subjectId, [
                'grade' => $formattedGrade
            ]);
        }

        return redirect()->back()->with('success', 'Grades updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Grade $grade)
    {
        //
    }

    public function getGradeModal(Student $student)
    {
        $student->load('subjects');
        return view('admin.grades.grade-student-modal', compact('student'));
    }
}
