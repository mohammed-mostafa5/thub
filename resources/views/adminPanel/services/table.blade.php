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
                <div class="col-md-4 my-2 my-md-0">
                    <div class="d-flex align-items-center">
                        <label class="mr-3 mb-0 d-none d-md-block">@lang('lang.status'):</label>
                        <select class="form-control" id="kt_datatable_search_status">
                            <option value="">@lang('lang.all')</option>
                            <option value="1">@lang('lang.active')</option>
                            <option value="0">@lang('lang.inactive')</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Search Form-->
<!--end: Search Form-->
<!--begin: Datatable-->
<table class="datatable datatable-bordered datatable-head-custom table-hover" id="kt_datatable">
    <thead>
        <tr>
            <th>@lang('models/services.fields.parent_id')</th>
            <th>@lang('models/services.fields.text')</th>
            <th>@lang('models/services.fields.has_children')</th>
            <th>@lang('models/services.fields.status')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($services as $service)
        <tr>
            <td>{{ $service->mainService->text ?? '' }}</td>
            <td>{{ $service->text }}</td>
            <td>{{ $service->has_children ? __('lang.yes') : __('lang.no') }}</td>
            <td>{{ $service->status }}</td>
            <td>
                {!! Form::open(['route' => ['adminPanel.services.destroy', $service->id], 'method' => 'delete']) !!}
                <div class='btn btn-sm-group'>
                    @can('services view')
                    <a href="{{ route('adminPanel.services.show', [$service->id]) }}" class='btn btn-sm btn-success'><i class="fa fa-eye"></i></a>
                    @endcan
                    @can('services edit')
                    <a href="{{ route('adminPanel.services.edit', [$service->id]) . '?languages=' . \App::getLocale() }}" class='btn btn-sm btn-primary'><i class="fa fa-edit"></i></a>
                    @endcan
                    @can('services destroy')
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                    @endcan
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
