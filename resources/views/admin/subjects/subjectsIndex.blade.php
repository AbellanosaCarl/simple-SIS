@extends('layouts.adminTemplate')
@section('title')
<title>SIS_Admin - SUBJECTS</title>
@endsection
@section('adminContent')
    @include('admin.subjects.add-subject-modal')
    @foreach($subjects as $subject)
        @include('admin.subjects.edit-subject-modal', ['subject' => $subject])
    @endforeach

    <div id="modalContainer"></div>
    
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Subjects</h1>
        <button class="btn btn-primary" data-toggle="modal" data-target="#addSubjectModal">
            <i class="fas fa-plus fa-sm text-white-50"></i> Add New Subject
        </button>
    </div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Code</th>
                            <th>Name</th>
                            <th>Units</th>
                            <th>Description</th>
                            <th>Enrolled Students</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subjects as $subject)
                            <tr>
                                <td>{{ $subject->code }}</td>
                                <td>{{ $subject->name }}</td>
                                <td>{{ $subject->units }}</td>
                                <td>{{ $subject->description }}</td>
                                <td>{{ $subject->students()->count() }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-primary btn-sm" 
                                                data-toggle="modal" 
                                                data-target="#editSubjectModal{{ $subject->id }}">
                                            <i class="fas fa-edit"></i> Edit
                                        </button>
                                        <button type="button" class="btn btn-danger btn-sm" 
                                                onclick="deleteSubject({{ $subject->id }})">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Hidden Delete Form -->
    <form id="deleteForm" method="POST" style="display: none;">
        @csrf
        @method('DELETE')
    </form>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function() {
        $('#dataTable').DataTable();

        // Show modal if there are validation errors
        @if($errors->any())
            @if(old('_method') == 'PUT')
                $('#editSubjectModal{{ old("subject_id") }}').modal('show');
            @else
                $('#addSubjectModal').modal('show');
            @endif
        @endif
    });

    function deleteSubject(subjectId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById('deleteForm');
                form.action = `/subjects/${subjectId}`;
                form.submit();
            }
        });
    }

    // Show success message if it exists in session
    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Success!',
            text: '{{ session('success') }}'
        });
    @endif

    // Show error message if it exists in session
    @if(session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Error!',
            text: '{{ session('error') }}'
        });
    @endif
</script>
@endpush
