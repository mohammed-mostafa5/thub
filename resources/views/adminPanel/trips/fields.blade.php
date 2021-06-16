<!-- Customer Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('customer_id', __('models/trips.fields.customer_id').':') !!}
    {!! Form::text('customer_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Driver Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('driver_id', __('models/trips.fields.driver_id').':') !!}
    {!! Form::text('driver_id', null, ['class' => 'form-control']) !!}
</div>

<!-- From Location Field -->
<div class="form-group col-sm-6">
    {!! Form::label('from_location', __('models/trips.fields.from_location').':') !!}
    {!! Form::text('from_location', null, ['class' => 'form-control']) !!}
</div>

<!-- To Location Field -->
<div class="form-group col-sm-6">
    {!! Form::label('to_location', __('models/trips.fields.to_location').':') !!}
    {!! Form::text('to_location', null, ['class' => 'form-control']) !!}
</div>

<!-- From Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('from_time', __('models/trips.fields.from_time').':') !!}
    {!! Form::text('from_time', null, ['class' => 'form-control']) !!}
</div>

<!-- To Time Field -->
<div class="form-group col-sm-6">
    {!! Form::label('to_time', __('models/trips.fields.to_time').':') !!}
    {!! Form::text('to_time', null, ['class' => 'form-control']) !!}
</div>

<!-- Rate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rate', __('models/trips.fields.rate').':') !!}
    {!! Form::text('rate', null, ['class' => 'form-control','maxlength' => 191]) !!}
</div>

<!-- Duration Field -->
<div class="form-group col-sm-6">
    {!! Form::label('duration', __('models/trips.fields.duration').':') !!}
    {!! Form::text('duration', null, ['class' => 'form-control','maxlength' => 191]) !!}
</div>

<!-- Distance Field -->
<div class="form-group col-sm-6">
    {!! Form::label('distance', __('models/trips.fields.distance').':') !!}
    {!! Form::text('distance', null, ['class' => 'form-control','maxlength' => 191]) !!}
</div>

<!-- Customer Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('customer_name', __('models/trips.fields.customer_name').':') !!}
    {!! Form::text('customer_name', null, ['class' => 'form-control','maxlength' => 191]) !!}
</div>

<!-- Customer Phone Field -->
<div class="form-group col-sm-6">
    {!! Form::label('customer_phone', __('models/trips.fields.customer_phone').':') !!}
    {!! Form::text('customer_phone', null, ['class' => 'form-control','maxlength' => 191]) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-sm btn-primary']) !!}
    <a href="{{ route('adminPanel.trips.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
