<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/rewards.fields.id').':') !!}
    <b>{{ $reward->id }}</b>
</div>

<!-- Discount Type Field -->
<div class="form-group">
    {!! Form::label('discount_type', __('models/rewards.fields.discount_type').':') !!}
    <b>{{ config("customestatus.discount_type.$reward->discount_type")}}</b>
</div>


<!-- Discount Value Field -->
<div class="form-group">
    {!! Form::label('discount_value', __('models/rewards.fields.discount_value').':') !!}
    <b>{{ $reward->discount_value }}</b>
</div>


<!-- Discount To Field -->
<div class="form-group">
    {!! Form::label('discount_to', __('models/rewards.fields.discount_to').':') !!}
    <b>{{ config("customestatus.discount_to.$reward->discount_to") }}</b>
</div>


<!-- Trip Count Field -->
<div class="form-group">
    {!! Form::label('trip_count', __('models/rewards.fields.trip_count').':') !!}
    <b>{{ $reward->trip_count }}</b>
</div>


<!-- Start At Field -->
<div class="form-group">
    {!! Form::label('start_at', __('models/rewards.fields.start_at').':') !!}
    <b>{{ $reward->start_at }}</b>
</div>


<!-- End At Field -->
<div class="form-group">
    {!! Form::label('end_at', __('models/rewards.fields.end_at').':') !!}
    <b>{{ $reward->end_at }}</b>
</div>


<!-- Photo Field -->
<div class="form-group">
    {!! Form::label('photo', __('models/rewards.fields.photo').':') !!}
    <br>
    <img onError="this.onerror=null;this.src='{{asset('uploads/images/original/default.png')}}';" src="{{ asset('uploads/images/original/' . $reward->photo) }}" width="150px">
</div>

<!-- Logo Field -->
<div class="form-group">
    {!! Form::label('logo', __('models/rewards.fields.logo').':') !!}
    <br>
    <img onError="this.onerror=null;this.src='{{asset('uploads/images/original/default.png')}}';" src="{{ asset('uploads/images/original/' . $reward->logo) }}" width="150px">
</div>



<!-- Code Field -->
<div class="form-group">
    {!! Form::label('code', __('models/rewards.fields.code').':') !!}
    <b>{{ $reward->code }}</b>
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/rewards.fields.created_at').':') !!}
    <b>{{ $reward->created_at }}</b>
</div>


<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/rewards.fields.updated_at').':') !!}
    <b>{{ $reward->updated_at }}</b>
</div>




@foreach ( config('langs') as $locale => $name)
<h3>
    <code> {{ $name }} </code>
</h3>
<br>

<!-- Title Field -->
<div class="form-group">
    {!! Form::label('title', __('models/rewards.fields.title').':') !!}
    <b>{{ $reward->translateOrNew($locale)->title }}</b>
</div>


<!-- Brief Field -->
<div class="form-group">
    {!! Form::label('brief', __('models/rewards.fields.brief').':') !!}
    <b>{{ $reward->translateOrNew($locale)->brief }}</b>
</div>


<!-- Description Field -->
<div class="form-group">
    {!! Form::label('description', __('models/rewards.fields.description').':') !!}
    <b>{{ $reward->translateOrNew($locale)->description }}</b>
</div>

@endforeach
