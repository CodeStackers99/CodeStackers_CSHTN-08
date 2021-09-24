<div class="modal fade" id="enrollModalForm" tabindex="-1" role="dialog" aria-labelledby="enrollModalFormLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="enrollModalFormLabel">Enroll Playlist</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="POST" id="enrollCourseForm">
            @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="published_at" class=" text-capitalize">Select Playlist Completion deadline date</label>
                        <input type="text"
                                class="form-control"
                                name="completion_deadline"
                                placeholder="Select Date and Time"
                                id="completion_deadline"
                                value="{{ old('completion_deadline') }}">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
