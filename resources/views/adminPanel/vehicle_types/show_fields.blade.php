<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/vehicleTypes.fields.id').':') !!}
    <b>{{ $vehicleType->id }}</b>
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/vehicleTypes.fields.created_at').':') !!}
    <b>{{ $vehicleType->created_at }}</b>
</div>


<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/vehicleTypes.fields.updated_at').':') !!}
    <b>{{ $vehicleType->updated_at }}</b>
</div>



@foreach (config('langs') as $locale => $name)

<code><h4>{{$name}}</h4></code>
<!-- Text Field -->
<div class="form-group show col-sm-12">
    {!! Form::label('text',$name . ' ' . __('models/vehicleTypes.fields.text').':') !!}
    <b>{!! $vehicleType->translateOrNew($locale)->text !!}</b>
</div>

<div class="clearfix"></div>
<br>
<hr>
<br>
@endforeach
