<ul class="nav nav-light-success nav-pills" id="myTab" role="tablist">

    @foreach ( config('langs') as $locale => $name)

    <li class="nav-item">
        <a class="nav-link {{request('languages') == $locale ?'active':''}}" id="{{$name}}-tab" data-toggle="pill" href="#{{$name}}" role="tab" aria-controls="{{$name}}" aria-selected="{{ request('languages') == $locale  ? 'true' : 'false'}}">{{$name}}</a>
    </li>

    @endforeach
</ul>
<div class="tab-content mt-5" id="myTabContent">
    @foreach ( config('langs') as $locale => $name)
    <div class="tab-pane fade {{request('languages') == $locale?'show active':''}}" id="{{$name}}" role="tabpanel" aria-labelledby="{{$name}}-tab">

        <!-- Name Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('text', __('models/categories.fields.text').':') !!}
            {!! Form::text($locale . '[text]', isset($category)? $category->translate($locale)->text : '' , ['class' => 'form-control', 'placeholder' => $name . ' text']) !!}
        </div>

        <!-- brief Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('brief', __('models/categories.fields.brief').':') !!}
            {!! Form::text($locale . '[brief]', isset($category)? $category->translate($locale)->brief : '' , ['class' => 'form-control', 'placeholder' => $name . ' brief']) !!}
        </div>

    </div>
    @endforeach
</div>
<!-- Service Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('service_id', __('models/categories.fields.service_id').':') !!}

    <select name="service_id" id="service_id" class="form-control">
        @foreach ($services as $service)
            <option value="{{ $service->id }}" {{isset($category) ? $category->service_id == $service->id?'selected':'':'' }}>{{ $service->text }}</option>
            @foreach ($service->children as $item)
                <option value="{{ $item->id }}" {{isset($category) ? $category->service_id == $item->id?'selected':'':'' }}>{{ $item->text }}</option>
            @endforeach
        @endforeach
    </select>

</div>

<!-- Status Field -->
<div class="form-group col-sm-12">
    {!! Form::label('status', __('models/categories.fields.status').':') !!}
    <label class="radio">
        {!! Form::radio('status', "1",  "Active") !!}
        <span></span>
        @lang('lang.active')
    </label>
    <label class="radio">
        {!! Form::radio('status', "0", null) !!}
        <span></span>
        @lang('lang.inactive')
    </label>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('adminPanel.categories.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>
