<div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">CREATE</h5>
                <button type="button" class="btn text-danger" data-bs-dismiss="modal" aria-label="btn-close">
                    <i data-feather="x-circle"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="card">
                    <div class="card-body">
                        {!! Form::open(['id' => 'createForm', 'class' => 'ajax-form', 'method' => 'POST']) !!}
                        <div class="row mt-4">
                            <div class="form-group">
                                <label for="class_id">Class</label>
                                <select class="form-control" name="class_id" id="class_id">
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="subject_code">Subject Code</label>
                                        <input type="text" name="subject_code" id="subject_code" class="form-control"
                                            placeholder="" aria-describedby="helpId">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="subject_name">Subject Name</label>
                                        <input type="text" name="subject_name" id="subject_name" class="form-control"
                                            placeholder="" aria-describedby="helpId">
                                    </div>
                                </div>
                            </div>

                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="units">Number of units</label>
                                        <input type="text" name="units" id="units" class="form-control"
                                            placeholder="" aria-describedby="helpId">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="semester">Semester</label>
                                        <select class="form-control" name="semester" id="semester">
                                            <option></option>
                                            <option>1st semester</option>
                                            <option>2nd semester</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-4">
                                <label for="description">Description</label>
                                <textarea class="form-control" name="description" id="description" rows="3"></textarea>
                            </div>

                        </div>

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="createSaveButton">Save</button>
            </div>
        </div>
    </div>
</div>
