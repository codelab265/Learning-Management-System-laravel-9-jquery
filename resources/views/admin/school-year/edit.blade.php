<div class="card">
    <div class="card-body">
        {!! Form::open(['id' => 'editForm', 'class' => 'ajax-form', 'method' => 'POST']) !!}
        @method('patch')
        <input type="hidden" name="id" value="{{ $schoolYear->id }}" id="school-year-id">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="form-check">
                    <label class="form-check-label">
                        <input type="radio" class="form-check-input" name="status" id="status"
                            value="{{ $schoolYear->status }}" @if ($schoolYear->status) checked @endif>
                        Make it default
                    </label>
                </div>
            </div>

        </div>

        {!! Form::close() !!}
    </div>
</div>
