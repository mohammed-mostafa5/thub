<!-- Garage Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('garage_name', __('models/garages.fields.garage_name').':') !!}
    {!! Form::text('garage_name', null, ['class' => 'form-control','maxlength' => 191]) !!}
</div>

<!-- Owner Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('owner_name', __('models/garages.fields.owner_name').':') !!}
    {!! Form::text('owner_name', null, ['class' => 'form-control','maxlength' => 191]) !!}
</div>

<!-- Mobile Field -->
<div class="form-group col-sm-6">
    {!! Form::label('mobile', __('models/garages.fields.mobile').':') !!}
    {!! Form::text('mobile', null, ['class' => 'form-control','maxlength' => 191]) !!}
</div>

<!-- Commercial Registration Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('commercial_registration_number', __('models/garages.fields.commercial_registration_number').':') !!}
    {!! Form::text('commercial_registration_number', null, ['class' => 'form-control','maxlength' => 191]) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', __('models/garages.fields.address').':') !!}
    {!! Form::text('address', null, ['class' => 'form-control','maxlength' => 191]) !!}
</div>

<!-- Location Field -->
<div class="form-group col-sm-6">
    {!! Form::label('location', __('models/garages.fields.location').':') !!}
    {!! Form::text('location', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', __('models/garages.fields.status').':') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('adminPanel.garages.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
