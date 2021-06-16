<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/drivers.fields.name').':') !!}
    <b>{{ $driver->name }}</b>
</div>

<!-- Phone Field -->
<div class="form-group">
    {!! Form::label('phone', __('models/drivers.fields.phone').':') !!}
    <b>{{ $driver->phone }}</b>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', __('models/drivers.fields.email').':') !!}
    <b>{{ $driver->email }}</b>
</div>

@if ($driver->company_id != null)
<!-- Company Id Field -->
<div class="form-group">
    {!! Form::label('company_id', __('models/drivers.fields.company_id').':') !!}
    <b>
        <a href="{{ route('adminPanel.companies.show', [$driver->company_id]) }}">
            {{ $driver->company->company_name }}
        </a>
    </b>
</div>
@endif

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', __('models/drivers.fields.status').':') !!}
    @php
    $arrStatus=[
    "0" => __('lang.in_progress'),
    "1" => __('lang.pending'),
    "2" => __('lang.approved'),
    "3" => __('lang.rejected'),
    "4" => __('lang.deactivate'),
    ];

    @endphp
    <b>{{ $arrStatus[ $driver->status ] }}</b>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/drivers.fields.created_at').':') !!}
    <b>{{ $driver->created_at }}</b>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/drivers.fields.updated_at').':') !!}
    <b>{{ $driver->updated_at }}</b>
</div>


<!-- Medical Report Field -->
<div class="form-group">
    {!! Form::label('medical_report', __('models/drivers.fields.medical_report').':') !!}
    <br>
    <img onError="this.onerror=null;this.src='{{asset('uploads/images/original/default.png')}}';" src="{{ asset('uploads/images/original/' . $driver->medical_report) }}" width="150px">
</div>

<!-- Identity Card Field -->
<div class="form-group">
    {!! Form::label('identity_card', __('models/drivers.fields.identity_card').':') !!}
    <br>
    <img onError="this.onerror=null;this.src='{{asset('uploads/images/original/default.png')}}';" src="{{ asset('uploads/images/original/' . $driver->identity_card) }}" width="150px">
</div>

<!-- Certificate Police Field -->
<div class="form-group">
    {!! Form::label('police_clearance_certificate', __('models/drivers.fields.police_clearance_certificate').':') !!}
    <br>
    <img onError="this.onerror=null;this.src='{{asset('uploads/images/original/default.png')}}';" src="{{ asset('uploads/images/original/' . $driver->police_clearance_certificate) }}" width="150px">
</div>

<!-- Driver Licence Field -->
<div class="form-group">
    {!! Form::label('driver_licence', __('models/drivers.fields.driver_licence').':') !!}
    <br>
    <img onError="this.onerror=null;this.src='{{asset('uploads/images/original/default.png')}}';" src="{{ asset('uploads/images/original/' . $driver->driver_licence) }}" width="150px">
</div>
<!-- Driver Licence Field -->
<div class="form-group">
    @switch($driver->status)
        @case(1)
            {!! Form::open(['route' => ['adminPanel.drivers.approve', $driver->id], 'method' => 'PATCH', 'class' => 'd-inline']) !!}
                {!! Form::submit('Approve', ['class' => 'btn btn-sm btn-success btn-sm']) !!}
            {!! Form::close() !!}

            {!! Form::open(['route' => ['adminPanel.drivers.reject', $driver->id], 'method' => 'PATCH', 'class' => 'd-inline']) !!}
                {!! Form::submit('Reject', ['class' => 'btn btn-sm btn-danger btn-sm']) !!}
            {!! Form::close() !!}
        @break

        @case(2)
            {!! Form::open(['route' => ['adminPanel.drivers.deactivate', $driver->id], 'method' => 'PATCH', 'class' => 'd-inline']) !!}
                {!! Form::submit('Deactivate', ['class' => 'btn btn-sm btn-danger btn-sm']) !!}
            {!! Form::close() !!}
        @break

        @case(3)
            {!! Form::open(['route' => ['adminPanel.drivers.approve', $driver->id], 'method' => 'PATCH', 'class' => 'd-inline']) !!}
                {!! Form::submit('Approve', ['class' => 'btn btn-sm btn-success btn-sm']) !!}
            {!! Form::close() !!}
        @break

        @case(4)
            {!! Form::open(['route' => ['adminPanel.drivers.approve', $driver->id], 'method' => 'PATCH', 'class' => 'd-inline']) !!}
                {!! Form::submit('Return working', ['class' => 'btn btn-sm btn-success btn-sm']) !!}
            {!! Form::close() !!}
        @break

        @default

    @endswitch

</div>
