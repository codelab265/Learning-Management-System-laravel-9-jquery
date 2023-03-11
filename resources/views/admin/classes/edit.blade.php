<div class="card">
    <div class="card-body">
        {!! Form::open(['id' => 'editForm', 'class' => 'ajax-form', 'method' => 'POST']) !!}
        @method('patch')
        <input type="hidden" name="id" value="{{ $class->id }}" id="class-id">
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="form-group">
                    <label for="name">Class Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder=""
                        aria-describedby="helpId" value="{{ $class->name }}">

                </div>
            </div>

        </div>

        {!! Form::close() !!}
    </div>
</div>
