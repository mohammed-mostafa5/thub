<!--begin: Datatable-->
<table class="datatable datatable-bordered datatable-head-custom table-hover" id="kt_datatable">
    <thead>
        <tr>
            <th>@lang('models/reasons.fields.id')</th>
            <th>@lang('models/reasons.fields.title')</th>
            <th>@lang('models/reasons.fields.status')</th>
            {{-- <th>@lang('models/reasons.fields.type')</th> --}}
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($reasons as $reason)
        <tr>
            <td>{{ $reason->id }}</td>
            <td>{{ $reason->title }}</td>
            <td>{{ $reason->status }}</td>
            {{-- <td>{{ config("customestatus.reason_type.$reason->type") }}</td> --}}
            <td>
                {!! Form::open(['route' => ['adminPanel.reasons.destroy', $reason->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    @can('reasons view')
                    <a href="{{ route('adminPanel.reasons.show', [$reason->id]) }}" class='btn btn-sm btn-success'><i class="fa fa-eye"></i></a>
                    @endcan
                    @can('reasons edit')
                    <a href="{{ route('adminPanel.reasons.edit', [$reason->id]) . '?languages=' . App::getlocale() }}" class='btn btn-sm btn-primary'><i class="fa fa-edit"></i></a>
                    @endcan
                    @can('reasons destroy')
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                    @endcan
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!--end: Datatable-->
