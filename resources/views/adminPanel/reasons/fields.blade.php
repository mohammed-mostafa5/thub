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
                    {!! Form::label('title', __('models/reasons.fields.title').':') !!}
                    {!! Form::text($locale . '[title]', isset($reason)? $reason->translateOrNew($locale)->title : '' , ['class' => 'form-control', 'placeholder' => $name . ' title']) !!}
                </div>
            </div>

            @endforeach

            <div class="clearfix"></div>

            <!-- Type Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('type', __('models/reasons.fields.type').':') !!}
                {!! Form::select('type', config('customestatus.reason_type'), null, ['class' => 'form-control','placeholder' => 'Select Reason Type']) !!}
            </div>

            <!-- Status Field -->
            <div class="form-group col-sm-12">
                {!! Form::label('status', __('models/reasons.fields.status').':') !!}
                <div class="radio-inline">
                    <label class="radio">
                        {!! Form::radio('status', "1", 'Active') !!}
                        <span></span>
                        @lang('lang.active')
                    </label>

                    <label class="radio">
                        {!! Form::radio('status', "0", null) !!}
                        <span></span>
                        @lang('lang.inactive')
                    </label>
                </div>
            </div>



            <!-- Submit Field -->
            <div class="form-group col-sm-12">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('adminPanel.reasons.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
            </div>

        </div>
    </div>
</div>
