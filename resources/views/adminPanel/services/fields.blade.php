<div class="row">
    <div class="col nav-tabs-boxed">

        <ul class="nav nav-light-success nav-pills" id="myTab" role="tablist">

            @foreach ( config('langs') as $locale => $name)

            <li class="nav-item">
                <a class="nav-link {{request('languages') == $locale ?'active':''}}" id="{{$name}}-tab" data-toggle="pill" href="#{{$name}}" role="tab" aria-controls="{{$name}}" aria-selected="{{ request('languages') == $locale  ? 'true' : 'false'}}">{{$name}}</a>
            </li>
            @endforeach
        </ul>

        <div class="tab-content mt-5" id="myTabContent">

            @foreach ( config('langs') as $locale => $name)

            <div class="tab-pane fade {{request('languages') == $locale ?'show active':''}}" id="{{$name}}" role="tabpanel" aria-labelledby="{{$name}}-tab">
                <!-- name Field -->
                <div class="form-group col-sm-12">
                    {!! Form::label('text', __('models/services.fields.text').':') !!}
                    {!! Form::text($locale . '[text]', isset($service)? $service->translateOrNew($locale)->text : '' , ['class' => 'form-control', 'placeholder' => $name . ' text']) !!}
                </div>
                <!-- name Field -->
                <div class="form-group col-sm-12">
                    {!! Form::label('description', __('models/services.fields.description').':') !!}
                    {!! Form::text($locale . '[description]', isset($service)? $service->translateOrNew($locale)->description : '' , ['class' => 'form-control', 'placeholder' => $name . ' description']) !!}
                </div>

            </div>

            @endforeach

            <!-- Photo Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('photo', __('models/services.fields.photo').':') !!}

                <br>
                <div class="image-input image-input-outline" id="kt_image_4" style="background-image: url({{asset('uploads/images/original/default.png')}})">
                    <div class="image-input-wrapper" style="background-image: url({{$service->photo_original_path ?? ''}})"></div>

                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change photo">
                        <i class="fa fa-pen icon-sm text-muted"></i>
                        <input type="file" name="photo" accept=".png, .jpg, .jpeg" />
                        <input type="hidden" name="photo_remove" />
                    </label>

                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel photo">
                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                    </span>

                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove photo">
                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                    </span>
                </div>

            </div>

            <!-- Parent Id Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('parent_id', __('models/services.fields.parent_id').':') !!}
                {!! Form::select('parent_id', $parentServices, null, ['class' => 'form-control', 'placeholder' => __('lang.select') . ' ' . __('models/services.singular')]) !!}
            </div>

            <!-- has_children Field -->
            <div class="form-group col-sm-12">
                {!! Form::label('has_children', __('models/services.fields.has_children').':') !!}
                <div class="radio-inline">
                    <label class="radio">
                        {!! Form::radio('has_children', "1", 'Active') !!}
                        <span></span>
                        @lang('lang.yes')
                    </label>

                    <label class="radio">
                        {!! Form::radio('has_children', " 0", null) !!}
                        <span></span>
                        @lang('lang.no')
                    </label>
                </div>
            </div>

            <!-- Status Field -->
            <div class="form-group col-sm-12">
                {!! Form::label('status', __('models/services.fields.status').':') !!}
                <div class="radio-inline">
                    <label class="radio">
                        {!! Form::radio('status', "1", 'Active') !!}
                        <span></span>
                        @lang('lang.active')
                    </label>

                    <label class="radio">
                        {!! Form::radio('status', " 0", null) !!}
                        <span></span>
                        @lang('lang.inactive')
                    </label>
                </div>
            </div>

            <!-- Submit Field -->
            <div class="form-group col-sm-12">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-sm btn-primary']) !!}
                <a href="{{ route('adminPanel.services.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
            </div>

        </div>
    </div>
</div>
