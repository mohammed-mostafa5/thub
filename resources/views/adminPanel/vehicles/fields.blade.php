<!-- Brand Field -->
<div class="form-group col-sm-6">
    {!! Form::label('brand', __('models/vehicles.fields.brand').':') !!}
    {!! Form::text('brand', null, ['class' => 'form-control','maxlength' => 191]) !!}
</div>

<!-- Model Field -->
<div class="form-group col-sm-6">
    {!! Form::label('model', __('models/vehicles.fields.model').':') !!}
    {!! Form::text('model', null, ['class' => 'form-control','maxlength' => 191]) !!}
</div>

<!-- vehicle License Field -->
<div class="form-group col-sm-6">
    {!! Form::label('vehicle_license', __('models/vehicles.fields.vehicle_license').':') !!}
    {!! Form::file('vehicle_license') !!}
</div>
<div class="clearfix"></div>

<!-- License Plate Field -->
<div class="form-group col-sm-6">
    {!! Form::label('license_plate', __('models/vehicles.fields.license_plate').':') !!}
    {!! Form::file('license_plate') !!}
</div>
<div class="clearfix"></div>

<!-- Technical Report Field -->
<div class="form-group col-sm-6">
    {!! Form::label('technical_report', __('models/vehicles.fields.technical_report').':') !!}
    {!! Form::file('technical_report') !!}
</div>
<div class="clearfix"></div>

<!-- Company Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('company_id', __('models/vehicles.fields.company_id').':') !!}
    {!! Form::text('company_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-sm btn-primary']) !!}
    <a href="{{ route('adminPanel.vehicles.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
