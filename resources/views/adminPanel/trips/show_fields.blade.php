<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/trips.fields.id').':') !!}
    <b>{{ $trip->id }}</b>
</div>


<!-- Customer Id Field -->
<div class="form-group">
    {!! Form::label('customer_id', __('models/trips.fields.customer_id').':') !!}
    <b>{{ $trip->customer->name ?? '' }}</b>
</div>


<!-- Driver Id Field -->
<div class="form-group">
    {!! Form::label('driver_id', __('models/trips.fields.driver_id').':') !!}
    <b>{{ $trip->driver->name ?? '' }}</b>
</div>


<!-- From Location Field -->
<div class="form-group">
    {!! Form::label('from_location', __('models/trips.fields.from_location').':') !!}
    <b>{{ $trip->from_location }}</b>
</div>


<!-- To Location Field -->
<div class="form-group">
    {!! Form::label('to_location', __('models/trips.fields.to_location').':') !!}
    <b>{{ $trip->to_location }}</b>
</div>


<!-- From Time Field -->
<div class="form-group">
    {!! Form::label('from_time', __('models/trips.fields.from_time').':') !!}
    <b>{{ $trip->from_time }}</b>
</div>


<!-- To Time Field -->
<div class="form-group">
    {!! Form::label('to_time', __('models/trips.fields.to_time').':') !!}
    <b>{{ $trip->to_time }}</b>
</div>


<!-- Rate Field -->
<div class="form-group">
    {!! Form::label('rate', __('models/trips.fields.rate').':') !!}
    <b>{{ $trip->rate }}</b>
</div>


<!-- Duration Field -->
<div class="form-group">
    {!! Form::label('duration', __('models/trips.fields.duration').':') !!}
    <b>{{ $trip->duration }}</b>
</div>


<!-- Distance Field -->
<div class="form-group">
    {!! Form::label('distance', __('models/trips.fields.distance').':') !!}
    <b>{{ $trip->distance }}</b>
</div>


<!-- Customer Name Field -->
<div class="form-group">
    {!! Form::label('customer_name', __('models/trips.fields.customer_name').':') !!}
    <b>{{ $trip->customer_name }}</b>
</div>


<!-- Customer Phone Field -->
<div class="form-group">
    {!! Form::label('customer_phone', __('models/trips.fields.customer_phone').':') !!}
    <b>{{ $trip->customer_phone }}</b>
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/trips.fields.created_at').':') !!}
    <b>{{ $trip->created_at }}</b>
</div>


<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/trips.fields.updated_at').':') !!}
    <b>{{ $trip->updated_at }}</b>
</div>
