<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/garages.fields.id').':') !!}
    <b>{{ $garage->id }}</b>
</div>


<!-- Garage Name Field -->
<div class="form-group">
    {!! Form::label('garage_name', __('models/garages.fields.garage_name').':') !!}
    <b>{{ $garage->garage_name }}</b>
</div>


<!-- Owner Name Field -->
<div class="form-group">
    {!! Form::label('owner_name', __('models/garages.fields.owner_name').':') !!}
    <b>{{ $garage->owner_name }}</b>
</div>


<!-- Mobile Field -->
<div class="form-group">
    {!! Form::label('mobile', __('models/garages.fields.mobile').':') !!}
    <b>{{ $garage->mobile }}</b>
</div>


<!-- Commercial Registration Number Field -->
<div class="form-group">
    {!! Form::label('commercial_registration_number', __('models/garages.fields.commercial_registration_number').':') !!}
    <b>{{ $garage->commercial_registration_number }}</b>
</div>


<!-- Address Field -->
<div class="form-group">
    {!! Form::label('address', __('models/garages.fields.address').':') !!}
    <b>{{ $garage->address }}</b>
</div>


<!-- Location Field -->
<div class="form-group">
    {!! Form::label('location', __('models/garages.fields.location').':') !!}
    <b>{{ $garage->location }}</b>
</div>


<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', __('models/garages.fields.status').':') !!}
    <b>{{ $garage->status }}</b>
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/garages.fields.created_at').':') !!}
    <b>{{ $garage->created_at }}</b>
</div>


<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/garages.fields.updated_at').':') !!}
    <b>{{ $garage->updated_at }}</b>
</div>


