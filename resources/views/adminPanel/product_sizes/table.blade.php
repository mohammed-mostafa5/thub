<!--begin: Datatable-->
<table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
    <thead>
        <tr>
            <th>@lang('models/productSizes.fields.product_id')</th>
            <th>@lang('models/productSizes.fields.size')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($productSizes as $productSize)
        <tr>
            <td>{{ $productSize->product_id }}</td>
            <td>{{ $productSize->size }}</td>
            <td nowrap>
                {!! Form::open(['route' => ['adminPanel.productSizes.destroy', $productSize->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    @can('productSizes view')
                    <a href="{{ route('adminPanel.productSizes.show', [$productSize->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-success'><i class="fa fa-eye"></i></a>
                    @endcan
                    @can('productSizes edit')
                    <a href="{{ route('adminPanel.productSizes.edit', [$productSize->id]) . '?languages=' . \App::getLocale() }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-primary'><i class="fa fa-edit"></i></a>
                    @endcan
                    @can('productSizes destroy')
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-shadow mx-1 btn-transparent-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                    @endcan
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!--end: Datatable-->
