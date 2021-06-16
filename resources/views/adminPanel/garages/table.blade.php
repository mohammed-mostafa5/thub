<!--begin: Datatable-->
<table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
    <thead>
        <tr>
            <th>@lang('models/garages.fields.garage_name')</th>
        <th>@lang('models/garages.fields.owner_name')</th>
        <th>@lang('models/garages.fields.mobile')</th>
        <th>@lang('models/garages.fields.commercial_registration_number')</th>
        <th>@lang('models/garages.fields.address')</th>
        <th>@lang('models/garages.fields.location')</th>
        <th>@lang('models/garages.fields.status')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($garages as $garage)
            <tr>
                <td>{{ $garage->garage_name }}</td>
            <td>{{ $garage->owner_name }}</td>
            <td>{{ $garage->mobile }}</td>
            <td>{{ $garage->commercial_registration_number }}</td>
            <td>{{ $garage->address }}</td>
            <td>{{ $garage->location }}</td>
            <td>{{ $garage->status }}</td>
                <td nowrap>
                    {!! Form::open(['route' => ['adminPanel.garages.destroy', $garage->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                    @can('garages view')
                        <a href="{{ route('adminPanel.garages.show', [$garage->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                    @endcan
                    @can('garages edit')
                        <a href="{{ route('adminPanel.garages.edit', [$garage->id]) }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                    @endcan
                    @can('garages destroy')
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
