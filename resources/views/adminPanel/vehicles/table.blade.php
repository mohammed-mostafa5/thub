<!--begin::Search Form-->
<div class="mb-7">
    <div class="row align-items-center">
        <div class="col-lg-9 col-xl-8">
            <div class="row align-items-center">
                <div class="col-md-4 my-2 my-md-0">
                    <div class="input-icon">
                        <input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
                        <span><i class="flaticon2-search-1 text-muted"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Search Form-->
<!--begin: Datatable-->
<table class="datatable datatable-bordered datatable-head-custom table-hover" id="kt_datatable">
    <thead>
        <tr>
            <th>@lang('models/vehicles.fields.company_id')</th>
            <th>@lang('models/vehicles.fields.brand')</th>
            <th>@lang('models/vehicles.fields.model')</th>
            <th>@lang('models/vehicles.fields.category_id')</th>
            {{-- <th>@lang('models/vehicles.fields.vehicle_license')</th> --}}
            <th>@lang('models/vehicles.fields.license_plate')</th>
            <th>@lang('models/vehicles.fields.status')</th>
            {{-- <th>@lang('models/vehicles.fields.technical_report')</th> --}}
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($vehicles as $vehicle)
        <tr>
            <td>{{ $vehicle->company->name ?? '' }}</td>
            <td>{{ $vehicle->brand->text ?? '' }}</td>
            <td>{{ $vehicle->model->text ?? ''  }}</td>
            <td>{{ $vehicle->category->text??'' }}</td>
            {{-- <td>{{ $vehicle->vehicle_license }}</td> --}}
            <td>{{ $vehicle->license_plate }}</td>
            <td>{{ $vehicle->status }}</td>
            {{-- <td>{{ $vehicle->technical_report }}</td> --}}
            <td nowrap>
                {!! Form::open(['route' => ['adminPanel.vehicles.destroy', $vehicle->id], 'method' => 'delete', 'class' => 'd-inline']) !!}
                <div class='btn btn-sm-group'>
                    @can('vehicles view')
                    <a href="{{ route('adminPanel.vehicles.show', [$vehicle->id]) }}" class='btn btn-sm btn-success'><i class="fa fa-eye"></i></a>
                    @endcan
                    {{-- @can('vehicles edit')
                    <a href="{{ route('adminPanel.vehicles.edit', [$vehicle->id]) }}" class='btn btn-sm btn-primary'><i class="fa fa-edit"></i></a>
                    @endcan
                    @can('vehicles destroy')
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                    @endcan --}}
                </div>
                {!! Form::close() !!}


                @if ($vehicle->status == 2)
                {!! Form::open(['route' => ['adminPanel.drivers.approve', $vehicle->id], 'method' => 'PATCH', 'class' => 'd-inline']) !!}
                {!! Form::submit('Approve', ['class' => 'btn btn-sm btn-success btn-sm']) !!}
                {!! Form::close() !!}
                @endif

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!--end: Datatable-->
