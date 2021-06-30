<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/products.fields.id').':') !!}
    <b>{{ $product->id }}</b>
</div>


<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', __('models/products.fields.title').':') !!}
    <b>{{ $product->title }}</b>
</div>


<!-- Brief Field -->
<div class="form-group">
    {!! Form::label('brief', __('models/products.fields.brief').':') !!}
    <b>{{ $product->brief }}</b>
</div>


<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', __('models/products.fields.description').':') !!}
    <b>{{ $product->description }}</b>
</div>


<!-- Old Price Field -->
<div class="form-group">
    {!! Form::label('old_price', __('models/products.fields.old_price').':') !!}
    <b>{{ $product->old_price }}</b>
</div>


<!-- Price Field -->
<div class="form-group">
    {!! Form::label('price', __('models/products.fields.price').':') !!}
    <b>{{ $product->price }}</b>
</div>


<!-- Stock Field -->
<div class="form-group">
    {!! Form::label('stock', __('models/products.fields.stock').':') !!}
    <b>{{ $product->stock }}</b>
</div>


<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', __('models/products.fields.status').':') !!}
    <b>{{ $product->status }}</b>
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/products.fields.created_at').':') !!}
    <b>{{ $product->created_at }}</b>
</div>


<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/products.fields.updated_at').':') !!}
    <b>{{ $product->updated_at }}</b>
</div>


