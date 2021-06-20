<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/states.fields.id').':') !!}
    <b>{{ $state->id }}</b>
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/states.fields.created_at').':') !!}
    <b>{{ $state->created_at }}</b>
</div>


<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/states.fields.updated_at').':') !!}
    <b>{{ $state->updated_at }}</b>
</div>


