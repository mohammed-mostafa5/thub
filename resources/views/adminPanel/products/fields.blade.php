<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', __('models/products.fields.title').':') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Brief Field -->
<div class="form-group col-sm-6">
    {!! Form::label('brief', __('models/products.fields.brief').':') !!}
    {!! Form::text('brief', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    {!! Form::label('description', __('models/products.fields.description').':') !!}
    {!! Form::text('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Old Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('old_price', __('models/products.fields.old_price').':') !!}
    {!! Form::text('old_price', null, ['class' => 'form-control']) !!}
</div>

<!-- Price Field -->
<div class="form-group col-sm-6">
    {!! Form::label('price', __('models/products.fields.price').':') !!}
    {!! Form::text('price', null, ['class' => 'form-control']) !!}
</div>

<!-- Stock Field -->
<div class="form-group col-sm-6">
    {!! Form::label('stock', __('models/products.fields.stock').':') !!}
    {!! Form::text('stock', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', __('models/products.fields.status').':') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('adminPanel.products.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
