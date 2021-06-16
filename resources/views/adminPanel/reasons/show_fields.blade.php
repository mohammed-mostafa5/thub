<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/reasons.fields.id').':') !!}
    <b>{{ $reason->id }}</b>
</div>


<!-- Type Field -->
<div class="form-group">
    {!! Form::label('type', __('models/reasons.fields.type').':') !!}
    <b>{{ config("customestatus.reason_type.$reason->type") }}</b>
</div>


<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', __('models/reasons.fields.status').':') !!}
    <b>{{ $reason->status ? __('lang.active'): __('lang.inactive') }}</b>
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/reasons.fields.created_at').':') !!}
    <b>{{ $reason->created_at }}</b>
</div>


<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/reasons.fields.updated_at').':') !!}
    <b>{{ $reason->updated_at }}</b>
</div>



@foreach (config('langs') as $locale => $name)

<h3>
    <code> {{ $name }} </code>
</h3>
<br>
<!-- Title Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/reasons.fields.title').':') !!}
    <b>{{ $reason->translateOrNew($locale)->title }}</b>
</div>
@endforeach
