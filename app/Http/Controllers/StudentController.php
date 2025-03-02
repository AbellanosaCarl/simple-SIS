<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::whereHas('user', function($query) {
                $query->where('is_admin', false);
            })
            ->with('user')
            ->latest()
            ->get(); // Remove paginate(10) and use get() instead
        
        return view('admin.students.studentsIndex', compact('students'));
    }
    public function edit(Student $student)
    {
        return view('admin.students.edit', compact('student'));
    }
    public function update(Request $request, Student $student)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'required|integer|min:10',
            'year_level' => 'required|integer|between:1,4',
        ]);

        // Update User Information
        $student->user->update([
            'name' => $validatedData['name'],
        ]);

        // Update Student Information
        $student->update([
            'age' => $validatedData['age'],
            'year_level' => $validatedData['year_level'],
        ]);

        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }


    public function destroy(Student $student)
    {
        // Prevent deletion of admin users
        if ($student->user->is_admin) {
            return redirect()->route('students.index')
                ->with('error', 'Cannot delete admin users.');
        }

        // Prevent deletion of students with enrolled subjects
        if ($student->subjects()->exists()) {
            return redirect()->route('students.index')
                ->with('error', 'Cannot delete student. Please unenroll from all subjects first.');
        }

        // This will automatically delete the associated user due to cascade
        try {
            $student->delete();
            return redirect()->route('students.index')
                ->with('success', 'Student deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('students.index')
                ->with('error', 'An error occurred while deleting the student.');
        }
    }
}
