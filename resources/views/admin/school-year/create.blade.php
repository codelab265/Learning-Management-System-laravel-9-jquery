<div class="modal fade" id="create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
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
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="school_year">School Year</label>
                                    <select class="form-control" name="school_year" id="school_year">
                                        <option value="">Select</option>
                                        @for ($i = 2018; $i <= date('Y'); $i++)
                                            <option>
                                                {{ $i }}-{{ $i + 1 }}
                                            </option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="status" id="status"
                                            value="1">
                                        Make it default
                                    </label>
                                </div>
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
