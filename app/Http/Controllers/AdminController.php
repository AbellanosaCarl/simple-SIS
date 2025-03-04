<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalUsers = User::count();
        $adminUsers = User::where('is_admin', true)->count();
        $regularUsers = User::where('is_admin', false)->count();

        return view('admin.adminDashboard', compact('totalUsers', 'adminUsers', 'regularUsers'));
    }
    // Show Add Student Form
    public function showAddStudentForm()
    {
        return view('admin.students.addStudent');
    }

    public function storeStudent(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'age' => 'required|numeric|min:10',
            'year_level' => 'required|in:1,2,3,4',
            'course' => 'required|string',  // Make sure course is required
        ]);
    
        // Generate a random password
        $password = 'pass123';
    
        // Create user first
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($password),
            'is_admin' => false
        ]);
    
        // Create associated student record - make sure to include course
        $student = Student::create([
            'user_id' => $user->id,
            'age' => $validatedData['age'],
            'year_level' => $validatedData['year_level'],
            'course' => $validatedData['course']  // Add this line
        ]);
    
        return redirect()->route('students.index')
            ->with('success', "Student created successfully. Generated password: $password");
    }
}