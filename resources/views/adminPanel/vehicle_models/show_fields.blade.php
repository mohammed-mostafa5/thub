<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/vehicleModels.fields.id').':') !!}
    <b>{{ $vehicleModel->id }}</b>
</div>


<!-- Brand Id Field -->
<div class="form-group">
    {!! Form::label('brand_id', __('models/vehicleModels.fields.brand_id').':') !!}
    <b>{{ $vehicleModel->brand->text }}</b>
</div>


<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/vehicleModels.fields.name').':') !!}
    <b>{{ $vehicleModel->text }}</b>
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/vehicleModels.fields.created_at').':') !!}
    <b>{{ $vehicleModel->created_at }}</b>
</div>


<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/vehicleModels.fields.updated_at').':') !!}
    <b>{{ $vehicleModel->updated_at }}</b>
</div>


@foreach (config('langs') as $locale => $name)

<code><h4>{{$name}}</h4></code>
<!-- Text Field -->
<div class="form-group show col-sm-12">
    {!! Form::label('text',$name . ' ' . __('models/vehicleModels.fields.name').':') !!}
    <b>{!! $vehicleModel->translateOrNew($locale)->text !!}</b>
</div>

<div class="clearfix"></div>
<br>
<hr>
<br>
@endforeach
