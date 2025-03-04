@extends('layouts.adminTemplate')
@section('title')
<title>SIS_Admin - Add Student</title>
@endsection
@section('adminContent')
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Add Student</h1>
        <a href="{{ route('students.index') }}" class="d-none d-sm-inline-block btn btn-secondary shadow-sm">
            <i class="fas fa-arrow-left fa-sm text-white-50"></i> Back to List
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.store-student') }}">
        @csrf
        <div class="form-group">
            <label for="name">Student Name</label>
            <input type="text" name="name" id="name" class="form-control" required value="{{ old('name') }}">
        </div>

        <div class="form-group">
            <label for="email">Student Email</label>
            <input type="email" name="email" id="email" class="form-control" required value="{{ old('email') }}">
        </div>

        <div class="form-group">
            <label for="age">Age</label>
            <input type="number" name="age" id="age" class="form-control" required value="{{ old('age') }}" min="10">
        </div>

        <div class="form-group">
            <label for="year_level">Year Level</label>
            <select name="year_level" id="year_level" class="form-control" required>
                <option value="" selected disabled>Select Year Level</option>
                <option value="1">1st Year</option>
                <option value="2">2nd Year</option>
                <option value="3">3rd Year</option>
                <option value="4">4th Year</option>
            </select>
        </div>
        <div class="form-group">
    <label for="course">Course</label>
    <select name="course" id="course" class="form-control" required>
        <option value="" selected disabled>Select Course</option>
        <option value="BSIT">Bachelor of Science in Information Technology</option>
        <option value="BSCS">Bachelor of Science in Computer Science</option>
        <option value="BSIS">Bachelor of Science in Information Systems</option>
        <option value="BSEMC">Bachelor of Science in Entertainment and Multimedia Computing</option>
        <!-- Add more courses as needed -->
    </select>
</div>

        <button type="submit" class="btn btn-primary">Add Student</button>
    </form>
@endsection
