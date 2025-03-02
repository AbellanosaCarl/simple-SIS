<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Student;

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

    // Store Student Data
    public function storeStudent(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'age' => 'required|integer|min:10',
            'year_level' => 'required|integer|between:1,4',
        ]);
    
        // Create User
        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => bcrypt($validatedData['password']),
            'role' => 'student', // Ensure role is set
        ]);
    
        // Create Student
        Student::create([
            'user_id' => $user->id,
            'age' => $validatedData['age'],
            'year_level' => $validatedData['year_level'],
        ]);
    
        return redirect()->back()->with('success', 'Student added successfully!');
    }
}