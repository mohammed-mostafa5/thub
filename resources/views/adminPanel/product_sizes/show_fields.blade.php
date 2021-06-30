<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/productSizes.fields.id').':') !!}
    <b>{{ $productSize->id }}</b>
</div>


<!-- Product Id Field -->
<div class="form-group">
    {!! Form::label('product_id', __('models/productSizes.fields.product_id').':') !!}
    <b>{{ $productSize->product_id }}</b>
</div>


<!-- Size Field -->
<div class="form-group">
    {!! Form::label('size', __('models/productSizes.fields.size').':') !!}
    <b>{{ $productSize->size }}</b>
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/productSizes.fields.created_at').':') !!}
    <b>{{ $productSize->created_at }}</b>
</div>


<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/productSizes.fields.updated_at').':') !!}
    <b>{{ $productSize->updated_at }}</b>
</div>


