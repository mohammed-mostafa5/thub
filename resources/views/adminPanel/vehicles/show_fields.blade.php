<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/vehicles.fields.id').':') !!}
    <b>{{ $vehicle->id }}</b>
</div>


<!-- Company Id Field -->
<div class="form-group">
    {!! Form::label('company_id', __('models/vehicles.fields.company_id').':') !!}
    <b>{{ $vehicle->company->name ?? '' }}</b>
</div>


<!-- Brand Field -->
<div class="form-group">
    {!! Form::label('brand', __('models/vehicles.fields.brand').':') !!}
    <b>{{ $vehicle->brand->text ?? '' }}</b>
</div>


<!-- Model Field -->
<div class="form-group">
    {!! Form::label('model', __('models/vehicles.fields.model').':') !!}
    <b>{{ $vehicle->model->text ?? ''}}</b>
</div>

<!-- License Plate Field -->
<div class="form-group">
    {!! Form::label('license_plate', __('models/vehicles.fields.license_plate').':') !!}
    <b>{{ $vehicle->license_plate }}</b>
</div>


<!-- vehicle License Field -->
<div class="form-group">
    {!! Form::label('front_vehicle_license', __('models/vehicles.fields.vehicle_license').':') !!}
    <img src="{{$vehicle->front_vehicle_license}}" alt="{{$vehicle->brand->text ?? 'vehicle'}}" class="image-thumbnail p-2" width="300">
</div>

<!-- vehicle License Field -->
<div class="form-group">
    {!! Form::label('back_vehicle_license', __('models/vehicles.fields.vehicle_license').':') !!}
    <img src="{{$vehicle->back_vehicle_license}}" alt="{{$vehicle->brand->text ?? 'vehicle'}}" class="image-thumbnail p-2" width="300">
</div>



<!-- Technical Report Field -->
<div class="form-group">
    {!! Form::label('technical_report', __('models/vehicles.fields.technical_report').':') !!}
    <img src="{{$vehicle->technical_report}}" alt="{{$vehicle->brand->text ?? 'vehicle'}}" class="image-thumbnail p-2" width="300">
</div>



<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/vehicles.fields.created_at').':') !!}
    <b>{{ $vehicle->created_at }}</b>
</div>


<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/vehicles.fields.updated_at').':') !!}
    <b>{{ $vehicle->updated_at }}</b>
</div>

@if (isset($vehicle->photos))
<hr>
<div class="images">
    <h3>Photos</h3>
    <div class="row">
        @foreach ($vehicle->photos as $photo)
        <div class="col-4">
            <div class="image">
                <img src="{{$photo->photo}}" alt="{{$photo->key}}" class="image-thumbnail p-2" width="300">
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif

{!! Form::model($vehicle, ['route' => ['adminPanel.vehicles.update', $vehicle->id], 'method' => 'patch']) !!}

    <!-- Category Field -->
    <div class="form-group col-sm-6">
        {!! Form::label('category_id', __('models/vehicles.fields.category_id').':') !!}

        <select name="category_id" id="category_id" class="form-control">
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{isset($category) ? $vehicle->category_id == $category->id ? 'selected' : '' : '' }}>{{ $category->text }}</option>
            @endforeach
        </select>

    </div>

    <!-- Submit Field -->
    <div class="form-group col-sm-12">
        {!! Form::submit(__('crud.save'), ['class' => 'btn btn-sm btn-primary']) !!}
    </div>

{!! Form::close() !!}
