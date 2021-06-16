<!-- photo Field -->
<div class="form-group">
    {!! Form::label('photo', __('models/services.fields.photo').':') !!}
    <img onError="this.onerror=null;this.src='{{asset('uploads/images/original/default.png')}}';" src="{{$service->photo_original_path}}" alt="{{$service->text}}" style="max-width: 100%">
</div>

<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/services.fields.id').':') !!}
    <b>{{ $service->id }}</b>
</div>


<!-- Parent Id Field -->
<div class="form-group">
    {!! Form::label('parent_id', __('models/services.fields.parent_id').':') !!}
    <b>{{ $service->mainService->text ?? '' }}</b>
</div>

<!-- Has Children Field -->
<div class="form-group">
    {!! Form::label('has_children', __('models/services.fields.has_children').':') !!}
    <b>{{ $service->has_children }}</b>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', __('models/services.fields.status').':') !!}
    <b>{{ $service->status_name }}</b>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/services.fields.created_at').':') !!}
    <b>{{ $service->created_at }}</b>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/services.fields.updated_at').':') !!}
    <b>{{ $service->updated_at }}</b>
</div>

<hr>
<br>
@foreach ( config('langs') as $locale => $name)
<h3>
    <code> {{ $name }} </code>
</h3>
<br>
<div class="form-group">
    {!! Form::label('text', __('models/services.fields.text').':') !!}
    <b>{{ $service->translateOrNew($locale)->text }}</b>
</div>
<div class="form-group">
    {!! Form::label('description', __('models/services.fields.description').':') !!}
    <b>{{ $service->translateOrNew($locale)->description }}</b>
</div>
@endforeach