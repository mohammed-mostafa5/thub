@extends('adminPanel.layouts.app')
@section('breadcrumb')
<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
    <li class="breadcrumb-item">
        <a href="{!! route('adminPanel.services.index') !!}">@lang('models/services.singular')</a>
    </li>
    <li class="breadcrumb-item active">@lang('crud.add_new')</li>
</ul>
@endsection
@section('content')

<div class="container-fluid">
    <div class="animated fadeIn">
        @include('coreui-templates::common.errors')
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <strong>@lang('crud.detail')</strong>
                        <a href="{{ route('adminPanel.services.index') }}" class="btn btn-ghost-light">Back</a>
                    </div>
                    <div class="card-body">
                        @include('adminPanel.services.show_fields')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
