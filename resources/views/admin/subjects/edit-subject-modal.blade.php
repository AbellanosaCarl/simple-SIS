<div class="modal fade" id="editSubjectModal{{ $subject->id }}" tabindex="-1" role="dialog" aria-labelledby="editSubjectModalLabel{{ $subject->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editSubjectModalLabel{{ $subject->id }}">Edit Subject</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="{{ route('subjects.update', $subject) }}">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="code{{ $subject->id }}">Subject Code <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="code{{ $subject->id }}" 
                               name="code" value="{{ old('code', $subject->code) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="name{{ $subject->id }}">Subject Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="name{{ $subject->id }}" 
                               name="name" value="{{ old('name', $subject->name) }}" required>
                    </div>

                    <div class="form-group">
                        <label for="units{{ $subject->id }}">Units <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" id="units{{ $subject->id }}" 
                               name="units" value="{{ old('units', $subject->units) }}" required min="1" max="6">
                    </div>

                    <div class="form-group">
                        <label for="description{{ $subject->id }}">Description</label>
                        <textarea class="form-control" id="description{{ $subject->id }}" 
                                  name="description" rows="3">{{ old('description', $subject->description) }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Update Subject</button>
                </div>
            </form>
        </div>
    </div>
</div> 