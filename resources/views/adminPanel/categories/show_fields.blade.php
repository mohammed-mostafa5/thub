<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/categories.fields.id').':') !!}
    <b>{{ $category->id }}</b>
</div>


<!-- Service Id Field -->
<div class="form-group">
    {!! Form::label('service_id', __('models/categories.fields.service_id').':') !!}
    <b>{{ $category->service_id }}</b>
</div>


<!-- Text Field -->
<div class="form-group">
    {!! Form::label('text', __('models/categories.fields.text').':') !!}
    <b>{{ $category->text }}</b>
</div>


<!-- Brief Field -->
<div class="form-group">
    {!! Form::label('brief', __('models/categories.fields.brief').':') !!}
    <b>{{ $category->brief }}</b>
</div>


<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', __('models/categories.fields.status').':') !!}
    <b>{{ $category->status }}</b>
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/categories.fields.created_at').':') !!}
    <b>{{ $category->created_at }}</b>
</div>


<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/categories.fields.updated_at').':') !!}
    <b>{{ $category->updated_at }}</b>
</div>


