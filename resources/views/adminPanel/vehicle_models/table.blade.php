<!--begin: Datatable-->
<table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
    <thead>
        <tr>
            <th>@lang('models/vehicleModels.fields.id')</th>
            <th>@lang('models/vehicleModels.fields.name')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($vehicleModels as $vehicleModel)
        <tr>
            <td>{{ $vehicleModel->id }}</td>
            <td>{{ $vehicleModel->text }}</td>
            <td nowrap>
                {!! Form::open(['route' => ['adminPanel.vehicleModels.destroy', $vehicleModel->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    @can('vehicleModels view')
                    <a href="{{ route('adminPanel.vehicleModels.show', [$vehicleModel->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                    @endcan
                    @can('vehicleModels edit')
                    <a href="{{ route('adminPanel.vehicleModels.edit', [$vehicleModel->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                    @endcan
                    @can('vehicleModels destroy')
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-ghost-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                    @endcan
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!--end: Datatable-->
