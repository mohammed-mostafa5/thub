<!--begin: Datatable-->
<table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
    <thead>
        <tr>

            <th>@lang('models/vehicleTypes.fields.id')</th>
            <th>@lang('models/vehicleTypes.fields.text')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($vehicleTypes as $vehicleType)
        <tr>
            <td>{{$vehicleType->id}}</td>
            <td>{{$vehicleType->text}}</td>
            <td nowrap>
                {!! Form::open(['route' => ['adminPanel.vehicleTypes.destroy', $vehicleType->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    @can('vehicleTypes view')
                    <a href="{{ route('adminPanel.vehicleTypes.show', [$vehicleType->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                    @endcan
                    @can('vehicleTypes edit')
                    <a href="{{ route('adminPanel.vehicleTypes.edit', [$vehicleType->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                    @endcan
                    @can('vehicleTypes destroy')
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
