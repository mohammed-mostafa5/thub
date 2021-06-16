<div class="row">
    <div class="col nav-tabs-boxed">

        <ul class="nav nav-light-success nav-pills" id="myTab" role="tablist">
            @php $i = 1; @endphp
            @foreach ( config('langs') as $locale => $name)

            <li class="nav-item">
                <a class="nav-link {{request()->filled('lang')? request('lang') == $name ?'show active':'' : $i?'active':''}}" id="{{$name}}-tab" data-toggle="pill" href="#{{$name}}" role="tab" aria-controls="{{$name}}" aria-selected="{{request()->filled('lang')? request('lang') == $name ?'show active':'' : $i ? 'true' : 'false'}}">{{$name}}</a>
            </li>

            @php $i = 0; @endphp
            @endforeach
        </ul>

        <div class="tab-content mt-5" id="myTabContent">

            @php $i = 1; @endphp
            @foreach ( config('langs') as $locale => $name)

            <div class="tab-pane fade {{request()->filled('lang')? request('lang') == $name ?'show active':'' : $i?'show active':''}}" id="{{$name}}" role="tabpanel" aria-labelledby="{{$name}}-tab">
                <!-- Text Field -->
                <div class="form-group col-sm-12">
                    {!! Form::label('text', __('models/vehicleModels.fields.name').':') !!}
                    {!! Form::text($locale . '[text]', isset($vehicleModel)? $vehicleModel->translateOrNew($locale)->text : '' ,
                    ['class' =>
                    'form-control', 'placeholder' => $name . ' name']) !!}
                </div>
            </div>

            @php $i = 0; @endphp
            @endforeach

            <!-- Submit Field -->
            <div class="form-group col-sm-12">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('adminPanel.brands.vehicleModels.index',isset($vehicleModel) ? $vehicleModel->brand_id : $brand->id ) }}" class="btn btn-default">@lang('crud.cancel')</a>
            </div>

        </div>
    </div>
</div>
