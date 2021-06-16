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
                <!-- title Field -->
                <div class="form-group col-sm-12">
                    {!! Form::label('title', __('models/rewards.fields.title').':') !!}
                    {!! Form::text($locale . '[title]', isset($reward)? $reward->translateOrNew($locale)->title : '' , ['class' => 'form-control', 'placeholder' => $name . ' title']) !!}
                </div>

                <!-- brief Field -->
                <div class="form-group col-sm-12">
                    {!! Form::label('brief', __('models/rewards.fields.brief').':') !!}
                    {!! Form::text($locale . '[brief]', isset($reward)? $reward->translateOrNew($locale)->brief : '' , ['class' => 'form-control', 'placeholder' => $name . ' brief']) !!}
                </div>

                <!-- description Field -->
                <div class="form-group col-sm-12">
                    {!! Form::label('description', __('models/rewards.fields.description').':') !!}
                    {!! Form::textarea($locale . '[description]', isset($reward)? $reward->translateOrNew($locale)->description : '' , ['class' => 'form-control', 'placeholder' => $name . ' description']) !!}
                </div>

            </div>

            @endforeach

            <div class="clearfix"></div>


            <!-- Discount Type Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('discount_type', __('models/rewards.fields.discount_type').':') !!}
                {!! Form::select('discount_type', config('customestatus.discount_type'), null, ['class' => 'form-control']) !!}
            </div>

            <!-- Discount Value Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('discount_value', __('models/rewards.fields.discount_value').':') !!}
                {!! Form::number('discount_value', null, ['class' => 'form-control','maxlength' => 191]) !!}
            </div>

            <!-- Discount To Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('discount_to', __('models/rewards.fields.discount_to').':') !!}
                {!! Form::select('discount_to', config('customestatus.discount_to'), null, ['class' => 'form-control']) !!}
            </div>

            <!-- Trip Count Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('trip_count', __('models/rewards.fields.trip_count').':') !!}
                {!! Form::number('trip_count', null, ['class' => 'form-control']) !!}
            </div>


            <!-- Start At Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('start_at', __('models/rewards.fields.start_at').':') !!}
                {!! Form::date('start_at', null, ['class' => 'form-control','id'=>'start_at']) !!}
            </div>

            <!-- End At Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('end_at', __('models/rewards.fields.end_at').':') !!}
                {!! Form::date('end_at', null, ['class' => 'form-control','id'=>'end_at']) !!}
            </div>

            <!-- photo Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('photo', __('models/rewards.fields.photo').':') !!}

                <br>

                <div class="image-input image-input-outline" id="kt_image_4" style="background-image: url({{asset('uploads/images/original/default.png')}})">
                    <div class="image-input-wrapper" style="background-image: url({{$reward->photo_original_path ?? ''}})"></div>

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
            <div class="clearfix"></div>

            <!-- Logo Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('logo', __('models/rewards.fields.logo').':') !!}

                <br>

                <div class="image-input image-input-outline" id="kt_image_5" style="background-image: url({{asset('uploads/images/original/default.png')}})">
                    <div class="image-input-wrapper" style="background-image: url({{$reward->logo_original_path ?? ''}})"></div>

                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change logo">
                        <i class="fa fa-pen icon-sm text-muted"></i>
                        <input type="file" name="logo" accept=".png, .jpg, .jpeg" />
                        <input type="hidden" name="logo_remove" />
                    </label>

                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel logo">
                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                    </span>

                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove logo">
                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                    </span>
                </div>
            </div>
            <div class="clearfix"></div>


            <!-- Code Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('code', __('models/rewards.fields.code').':') !!}
                {!! Form::text('code', null, ['class' => 'form-control']) !!}
            </div>

            <!-- Submit Field -->
            <div class="form-group col-sm-12">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('adminPanel.rewards.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
            </div>


        </div>
    </div>
</div>
