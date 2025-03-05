<div class="modal fade" id="addSubjectModal" tabindex="-1" role="dialog" aria-labelledby="addSubjectModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addSubjectModalLabel">Add New Subject</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('subjects.store') }}">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="code">Subject Code <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="code" name="code" required>
                    </div>

                    <div class="form-group">
                        <label for="name">Subject Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    <div class="form-group">
                        <label for="units">Units <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="units" name="units" required min="1" max="6">
                    </div>

                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                    </div>

                    <div class="form-group">
                        <label for="grade">Grade</label>
                        <select class="form-control @error('grade') is-invalid @enderror" name="grade">
                            <option value="">Select Grade</option>
                            @php
                                $grades = [];
                                for ($i = 1; $i <= 5; $i++) {
                                    for ($j = 0; $j <= 9; $j++) {
                                        $grades[] = number_format($i + ($j/10), 1);
                                    }
                                }
                            @endphp
                            @foreach($grades as $grade)
                                <option value="{{ $grade }}" {{ old('grade') == $grade ? 'selected' : '' }}>
                                    {{ $grade }}
                                </option>
                            @endforeach
                            <option value="INC" {{ old('grade') == 'INC' ? 'selected' : '' }}>INC</option>
                        </select>
                        @error('grade')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add Subject</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Only show the grade student modal if student data exists --}}
@if(isset($student))
<div class="modal fade" id="gradeStudentModal{{ $student->id }}" tabindex="-1" role="dialog" aria-labelledby="gradeStudentModalLabel{{ $student->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="gradeStudentModalLabel{{ $student->id }}">Student Grades: {{ $student->user->name }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('grades.update', $student) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Subject Code</th>
                                    <th>Subject Name</th>
                                    <th>Units</th>
                                    <th>Grade</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($student->subjects as $subject)
                                    <tr>
                                        <td>{{ $subject->code }}</td>
                                        <td>{{ $subject->name }}</td>
                                        <td>{{ $subject->units }}</td>
                                        <td>
                                            <select class="form-control @error('grades.' . $subject->id) is-invalid @enderror"
                                                    name="grades[{{ $subject->id }}]">
                                                <option value="">Select Grade</option>
                                                @php
                                                    $grades = [];
                                                    for ($i = 1; $i <= 5; $i++) {
                                                        for ($j = 0; $j <= 9; $j++) {
                                                            $grades[] = number_format($i + ($j/10), 1);
                                                        }
                                                    }
                                                @endphp
                                                @foreach($grades as $grade)
                                                    <option value="{{ $grade }}" 
                                                            {{ old('grades.' . $subject->id, $subject->pivot->grade) == $grade ? 'selected' : '' }}>
                                                        {{ $grade }}
                                                    </option>
                                                @endforeach
                                                <option value="INC" {{ old('grades.' . $subject->id, $subject->pivot->grade) == 'INC' ? 'selected' : '' }}>
                                                    INC
                                                </option>
                                            </select>
                                            @error('grades.' . $subject->id)
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </td>
                                        <td>
                                            @if($subject->pivot->grade)
                                                @if($subject->pivot->grade == 'INC')
                                                    <span class="text-warning">Incomplete</span>
                                                @elseif($subject->pivot->grade <= 3.0)
                                                    <span class="text-success">Passed</span>
                                                @else
                                                    <span class="text-danger">Failed</span>
                                                @endif
                                            @else
                                                <span class="text-secondary">Not Graded</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save Grades</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endif 