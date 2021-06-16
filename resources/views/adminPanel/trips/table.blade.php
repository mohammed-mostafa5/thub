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
            <th>@lang('models/trips.fields.id')</th>
            <th>@lang('models/trips.fields.customer_id')</th>
            <th>@lang('models/trips.fields.driver_id')</th>
            <th>@lang('models/trips.fields.from_location')</th>
            <th>@lang('models/trips.fields.to_location')</th>
            <th>@lang('models/trips.fields.price')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($trips as $trip)
        <tr>
            <td>{{ $trip->id }}</td>
            <td>{{ $trip->customer->name ?? '' }}</td>
            <td>{{ $trip->driver->name ?? '' }}</td>
            <td>{{ $trip->from_location }}</td>
            <td>{{ $trip->to_location }}</td>
            <td>{{ $trip->price }}</td>
            <td>
                {!! Form::open(['route' => ['adminPanel.trips.destroy', $trip->id], 'method' => 'delete']) !!}
                <div class='btn btn-sm-group'>
                    @can('trips view')
                    <a href="{{ route('adminPanel.trips.show', [$trip->id]) }}" class='btn btn-sm btn-success'><i class="fa fa-eye"></i></a>
                    @endcan
                    {{-- @can('trips edit')
                    <a href="{{ route('adminPanel.trips.edit', [$trip->id]) }}" class='btn btn-sm btn-primary'><i class="fa fa-edit"></i></a>
                    @endcan
                    @can('trips destroy')
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                    @endcan --}}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!--end: Datatable-->














{{-- @section('scripts')
<script src="{{asset('metronic/assets/js/pages/crud/datatables/search-options/advanced-search.min.js?v=7.0.6')}}"></script>
@endsection --}}
