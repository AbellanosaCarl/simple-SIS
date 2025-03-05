<div class="modal fade" id="editStudentModal{{ $student->id }}" tabindex="-1" role="dialog" aria-labelledby="editStudentModalLabel{{ $student->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editStudentModalLabel{{ $student->id }}">Edit Student</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('students.update', $student) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name{{ $student->id }}">Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name{{ $student->id }}" 
                               name="name" value="{{ old('name', $student->user->name) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="age{{ $student->id }}">Age <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="age{{ $student->id }}" 
                               name="age" value="{{ old('age', $student->age) }}" required min="16" max="100">
                    </div>

                    <div class="form-group">
                        <label for="year_level{{ $student->id }}">Year Level <span class="text-danger">*</span></label>
                        <select class="form-control" id="year_level{{ $student->id }}" name="year_level" required>
                            @for($i = 1; $i <= 4; $i++)
                                <option value="{{ $i }}" {{ $student->year_level == $i ? 'selected' : '' }}>
                                    {{ $i }}{{ $i == 1 ? 'st' : ($i == 2 ? 'nd' : ($i == 3 ? 'rd' : 'th')) }} Year
                                </option>
                            @endfor
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Student</button>
                </div>
            </form>
        </div>
    </div>
</div> 