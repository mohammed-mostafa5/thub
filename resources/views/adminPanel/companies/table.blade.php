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
                            <option value="0">@lang('lang.in_progress')</option>
                            <option value="1">@lang('lang.pending')</option>
                            <option value="2">@lang('lang.approved')</option>
                            <option value="3">@lang('lang.rejected')</option>
                            <option value="4">@lang('lang.deactivate')</option>
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
            <th>@lang('models/companies.fields.name')</th>
            <th>@lang('models/companies.fields.phone')</th>
            <th>@lang('models/companies.fields.email')</th>
            <th>@lang('models/companies.fields.status')</th>
            <th nowrap>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($companies as $company)
        <tr>
            <td>{{ $company->name }}</td>
            <td>{{ $company->phone }}</td>
            <td>{{ $company->email }}</td>
            <td>{{ $company->status }}</td>
            <td>
                <div class='btn btn-sm-group'>
                    <a href="{{ route('adminPanel.companies.show', [$company->id]) }}" class='btn btn-sm btn-success'><i class="fa fa-eye"></i></a>
                </div>

                {{-- if pending --}}

            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!--end: Datatable-->
