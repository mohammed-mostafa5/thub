<!--begin: Datatable-->
<table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
    <thead>
        <tr>
            <th>@lang('models/categories.fields.service_id')</th>
            <th>@lang('models/categories.fields.text')</th>
            <th>@lang('models/categories.fields.brief')</th>
            <th>@lang('models/categories.fields.status')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($categories as $category)
            <tr>
                <td>{{ $category->service->text }}</td>
                <td>{{ $category->text }}</td>
                <td>{{ $category->brief }}</td>
                <td>{{ $category->status? __('lang.active'): __('lang.inactive') }}</td>
                <td nowrap>
                    {!! Form::open(['route' => ['adminPanel.categories.destroy', $category->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                    @can('categories view')
                        <a href="{{ route('adminPanel.categories.show', [$category->id]) }}" class='btn btn-ghost-success'><i class="fa fa-eye"></i></a>
                    @endcan
                    @can('categories edit')
                        <a href="{{ route('adminPanel.categories.edit', [$category->id]) . '?languages=' . \App::getLocale() }}" class='btn btn-ghost-info'><i class="fa fa-edit"></i></a>
                    @endcan
                    @can('categories destroy')
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
