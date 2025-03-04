@extends('layouts.template')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">My Academic Dashboard</h1>
    </div>

    <!-- Content Row -->
    <div class="row">
        <!-- Total Units Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Units Enrolled</div>
                            @if(auth()->user()->student)
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ auth()->user()->student->subjects->sum('units') }}
                                </div>
                            @else
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    No student record found
                                </div>
                            @endif
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-book fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Average Grade Card -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Average Grade</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                @php
                                    $student = auth()->user()->student;
                                    $average = 'N/A';
                                    if ($student && $student->subjects->isNotEmpty()) {
                                        $grades = $student->subjects->pluck('pivot.grade')->filter();
                                        $average = $grades->count() > 0 ? number_format($grades->average(), 2) : 'N/A';
                                    }
                                @endphp
                                {{ $average }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enrolled Subjects Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">My Enrolled Subjects</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                @if(auth()->user()->student && auth()->user()->student->subjects->isNotEmpty())
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Code</th>
                                <th>Subject Name</th>
                                <th>Units</th>
                                <th>Description</th>
                                <th>Grade</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach(auth()->user()->student->subjects as $subject)
                                <tr>
                                    <td>{{ $subject->code }}</td>
                                    <td>{{ $subject->name }}</td>
                                    <td>{{ $subject->units }}</td>
                                    <td>{{ Str::limit($subject->description, 50) }}</td>
                                    <td>
                                        @if($subject->pivot->grade)
                                            <span class="badge badge-info">{{ $subject->pivot->grade }}</span>
                                        @else
                                            <span class="badge badge-secondary">Not Graded</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($subject->pivot->grade)
                                            @if($subject->pivot->grade === 'INC')
                                                <span class="badge badge-secondary">Pending</span>
                                            @elseif($subject->pivot->grade <= 3.0)
                                                <span class="badge badge-success">Passed</span>
                                            @else
                                                <span class="badge badge-danger">Failed</span>
                                            @endif
                                        @else
                                            <span class="badge badge-warning">Ongoing</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-center text-muted">No enrolled subjects found.</p>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection

@push('styles')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
@endpush

@push('scripts')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable();
        });
    </script>
@endpush
