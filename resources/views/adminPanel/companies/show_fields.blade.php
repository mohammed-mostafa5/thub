<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/companies.fields.name').':') !!}
    <b>{{ $company->name }}</b>
</div>

<!-- Phone Field -->
<div class="form-group">
    {!! Form::label('phone', __('models/companies.fields.phone').':') !!}
    <b>{{ $company->phone }}</b>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', __('models/companies.fields.email').':') !!}
    <b>{{ $company->email }}</b>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', __('models/companies.fields.status').':') !!}

    @php
    $arrStatus=[
    "0" => __('lang.in_progress'),
    "1" => __('lang.pending'),
    "2" => __('lang.approved'),
    "3" => __('lang.rejected'),
    "4" => __('lang.deactivate'),
    ];
    @endphp
    <b>{{ $arrStatus[ $company->status ] }}</b>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/companies.fields.created_at').':') !!}
    <b>{{ $company->created_at }}</b>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/companies.fields.updated_at').':') !!}
    <b>{{ $company->updated_at }}</b>
</div>

<!-- Logo Field -->
<div class="form-group">
    {!! Form::label('logo', __('models/companies.fields.logo').':') !!}
    <br>
    <img onError="this.onerror=null;this.src='{{asset('uploads/images/original/default.png')}}';" src="{{ asset('uploads/images/original/' . $company->logo) }}" width="150px">
</div>

<!-- Commercial Register Field -->
<div class="form-group">
    {!! Form::label('commercial_register', __('models/companies.fields.commercial_register').':') !!}
    <br>
    <img onError="this.onerror=null;this.src='{{asset('uploads/images/original/default.png')}}';" src="{{ asset('uploads/images/original/' . $company->commercial_register) }}" width="150px">

</div>

<!-- Tax Identification Field -->
<div class="form-group">
    {!! Form::label('tax_identification', __('models/companies.fields.tax_identification').':') !!}
    <br>
    <img onError="this.onerror=null;this.src='{{asset('uploads/images/original/default.png')}}';" src="{{ asset('uploads/images/original/' . $company->tax_identification) }}" width="150px">
</div>

<!-- Identity Card Field -->
<div class="form-group">
    {!! Form::label('identity_card', __('models/companies.fields.identity_card').':') !!}
    <br>
    <img onError="this.onerror=null;this.src='{{asset('uploads/images/original/default.png')}}';" src="{{ asset('uploads/images/original/' . $company->identity_card) }}" width="150px">
</div>

<div class="form-group">

    @switch($company->status)
    @case(1)
    {!! Form::open(['route' => ['adminPanel.companies.approve', $company->id], 'method' => 'PATCH', 'class' => 'd-inline']) !!}
    {!! Form::submit('Approve', ['class' => 'btn btn-sm btn-success btn-sm']) !!}
    {!! Form::close() !!}

    {!! Form::open(['route' => ['adminPanel.companies.reject', $company->id], 'method' => 'PATCH', 'class' => 'd-inline']) !!}
    {!! Form::submit('Reject', ['class' => 'btn btn-sm btn-danger btn-sm']) !!}
    {!! Form::close() !!}
    @break

    @case(2)
    {!! Form::open(['route' => ['adminPanel.companies.deactivate', $company->id], 'method' => 'PATCH', 'class' => 'd-inline']) !!}
    {!! Form::submit('Deactivate', ['class' => 'btn btn-sm btn-danger btn-sm']) !!}
    {!! Form::close() !!}
    @break

    @case(3)
    {!! Form::open(['route' => ['adminPanel.companies.approve', $company->id], 'method' => 'PATCH', 'class' => 'd-inline']) !!}
    {!! Form::submit('Approve', ['class' => 'btn btn-sm btn-success btn-sm']) !!}
    {!! Form::close() !!}
    @break

    @case(4)
    {!! Form::open(['route' => ['adminPanel.companies.approve', $company->id], 'method' => 'PATCH', 'class' => 'd-inline']) !!}
    {!! Form::submit('Return working', ['class' => 'btn btn-sm btn-success btn-sm']) !!}
    {!! Form::close() !!}
    @break

    @default

    @endswitch


</div>
