<div class="card">
    <div class="card-body">
        {!! Form::open(['id' => 'userEditForm', 'class' => 'ajax-form', 'method' => 'POST']) !!}
        @method('patch')
        <input type="hidden" name="id" value="{{ $user->id }}">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder=""
                        aria-describedby="helpId" value="{{ $user->name }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" id="email"
                        aria-describedby="emailHelpId" placeholder="" value="{{ $user->email }}">

                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="phone_number">Phone number</label>
                    <input type="number" name="phone_number" id="phone_number" class="form-control" placeholder=""
                        aria-describedby="helpId" value="{{ $user->phone_number }}">
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" class="form-control" placeholder=""
                        aria-describedby="helpId">
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="form-check form-switch mb-2">
                    <input type="checkbox" name="is_active" class="form-check-input" id="formSwitch1"
                        value="{{ $user->is_active }}" @if ($user->is_active) checked @endif>
                    <label class="form-check-label" for="formSwitch1">
                        @if ($user->is_active)
                            Deactivate
                        @else
                            Activate
                        @endif
                    </label>
                </div>
            </div>
        </div>

        {!! Form::close() !!}
    </div>
</div>
