<div class="card">
    <div class="card-body">
        {!! Form::open(['id' => 'editForm', 'class' => 'ajax-form', 'method' => 'POST']) !!}
        @method('patch')
        <input type="hidden" name="id" value="{{ $subject->id }}" id="subject-id">
        <div class="row mt-4">
            <div class="form-group">
                <label for="class_id">Class</label>
                <select class="form-control" name="class_id" id="class_id">
                    <option value="{{ $subject->class_id }}">
                        {{ $subject->class->name }}
                    </option>
                    @foreach ($classes as $class)
                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="subject_code">Subject Code</label>
                        <input type="text" name="subject_code" id="subject_code" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $subject->subject_code }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="subject_name">Subject Name</label>
                        <input type="text" name="subject_name" id="subject_name" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $subject->subject_name }}">
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="units">Number of units</label>
                        <input type="text" name="units" id="units" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $subject->units }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="semester">Semester</label>
                        <select class="form-control" name="semester" id="semester">
                            <option>{{ $subject->semester }}</option>
                            <option>1st semester</option>
                            <option>2nd semester</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="form-group mt-4">
                <label for="description">Description</label>
                <textarea class="form-control" name="description" id="description" rows="3">{{ $subject->description }}</textarea>
            </div>

        </div>

        {!! Form::close() !!}
    </div>
</div>
