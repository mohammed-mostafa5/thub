<!-- Product Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('product_id', __('models/productSizes.fields.product_id').':') !!}
    {!! Form::text('product_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Size Field -->
<div class="form-group col-sm-6">
    {!! Form::label('size', __('models/productSizes.fields.size').':') !!}
    {!! Form::text('size', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('adminPanel.productSizes.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
