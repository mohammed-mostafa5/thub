<!-- Min Model Year Field -->
<div class="form-group col-sm-6">
    {!! Form::label('min_model_year', __('models/options.fields.min_model_year').':') !!}
    {!! Form::number('min_model_year', null, ['class' => 'form-control']) !!}
</div>
<!-- cap_max_free_cancellation Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cap_max_free_cancellation', __('models/options.fields.cap_max_free_cancellation').':') !!}
    {!! Form::number('cap_max_free_cancellation', null, ['class' => 'form-control']) !!}
</div>
<!-- towing_max_free_cancellation Field -->
<div class="form-group col-sm-6">
    {!! Form::label('towing_max_free_cancellation', __('models/options.fields.towing_max_free_cancellation').':') !!}
    {!! Form::number('towing_max_free_cancellation', null, ['class' => 'form-control']) !!}
</div>
<!-- cap_request_fees Field -->
<div class="form-group col-sm-6">
    {!! Form::label('cap_request_fees', __('models/options.fields.cap_request_fees').':') !!}
    {!! Form::number('cap_request_fees', null, ['class' => 'form-control']) !!}
</div>
<!-- towing_request_fees Field -->
<div class="form-group col-sm-6">
    {!! Form::label('towing_request_fees', __('models/options.fields.towing_request_fees').':') !!}
    {!! Form::number('towing_request_fees', null, ['class' => 'form-control']) !!}
</div>
<!-- towing_min_balance Field -->
<div class="form-group col-sm-6">
    {!! Form::label('towing_min_balance', __('models/options.fields.towing_min_balance').':') !!}
    {!! Form::number('towing_min_balance', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('adminPanel.options.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
