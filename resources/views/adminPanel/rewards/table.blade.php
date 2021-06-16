<!--begin: Datatable-->
<table class="datatable datatable-bordered datatable-head-custom table-hover" id="kt_datatable">
    <thead>
        <tr>
            <th>@lang('models/rewards.fields.title')</th>
            <th>@lang('models/rewards.fields.brief')</th>
            <th>@lang('models/rewards.fields.discount_type')</th>
            <th>@lang('models/rewards.fields.discount_value')</th>
            <th>@lang('models/rewards.fields.discount_to')</th>
            <th>@lang('models/rewards.fields.trip_count')</th>
            <th>@lang('models/rewards.fields.start_at')</th>
            <th>@lang('models/rewards.fields.end_at')</th>
            <th>@lang('models/rewards.fields.code')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($rewards as $reward)
        <tr>
            <td>{{ $reward->title }}</td>
            <td>{{ $reward->brief }}</td>
            <td>{{ config("customestatus.discount_type.$reward->discount_type") }}</td>
            <td>{{ $reward->discount_value }}</td>
            <td>{{ config("customestatus.discount_to.$reward->discount_to")}}</td>
            <td>{{ $reward->trip_count }}</td>
            <td>{{ $reward->start_at }}</td>
            <td>{{ $reward->end_at }}</td>
            <td>{{ $reward->code }}</td>
            <td nowrap>
                {!! Form::open(['route' => ['adminPanel.rewards.destroy', $reward->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    @can('rewards view')
                    <a href="{{ route('adminPanel.rewards.show', [$reward->id]) }}" class='btn btn-sm btn-success'><i class="fa fa-eye"></i></a>
                    @endcan
                    @can('rewards edit')
                    <a href="{{ route('adminPanel.rewards.edit', [$reward->id]) . '?languages=' . \App::getLocale()}}" class='btn btn-sm btn-primary'><i class="fa fa-edit"></i></a>
                    @endcan
                    @can('rewards destroy')
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
