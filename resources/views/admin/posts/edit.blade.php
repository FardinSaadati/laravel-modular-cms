@extends('admin.include.layout')
@section('content')

{!! Form::model($post , array('route' => ['admin.approval.postUpdate', $post], 'method' => 'POST', 'id' => 'EditPostCompany')) !!}
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="panel panel-grey">
                <div class="panel-heading">
                    <span class="fa fa-users"></span>
                    <span class="bold">{{!empty($title) ? $title: ''}}</span>
                </div>
                <div class="panel-body">
                    @php
                        $effective_timeStatus   = false;
                        $effective_time         = $post->effective_time;
                        $time_now               = date('Y-m-d');

                        if($time_now >= $effective_time)
                            $effective_timeStatus = true;
                    @endphp

                    <div class="row">
                        <div class="">
                            <div class="form" id="ajaxContainer">

                                <input type="hidden" id="checkSwall" data-type="1" />

                                <div class="col-md-12">

                                    <div class="row margin-top-15">
                                        <div class="col-md-6 col-xs-12">
                                            <div class="form-group {{ $errors->has('position') ? 'has-error' : '' }}">
                                                <label class="control-label">
                                                    <span class="bold">*Job Title</span>
                                                </label>
                                                <div class="">
                                                    {!! Form::text('position' , null , ['class' => 'form-control' , 'placeholder' => 'position']) !!}
                                                    <span class="validation-message-block">{{ $errors->first('position', ':message') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            <div class="form-group {{ $errors->has('p_position') ? 'has-error' : '' }}">
                                                <label class="control-label">
                                                    <span class="bold">Job Title (Persian)</span>
                                                </label>
                                                <div class="">
                                                    {!! Form::text('p_position' , null , ['class' => 'form-control text-right' , 'placeholder' => '']) !!}
                                                    <span class="validation-message-block">{{ $errors->first('p_position', ':message') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-3 col-xs-12">
                                            <div class="form-group {{ $errors->has('country') ? 'has-error' : '' }}">
                                                {!! Form::label('country', '*Country', ['class' => 'control-label']) !!}
                                                {!! Form::select('country' , $countries , null , ['class' => 'select2 form-control' , 'id' => 'country_list' , 'style' => 'width: 100%']) !!}
                                                <span class="validation-message-block">{{ $errors->first('country', ':message') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-xs-12">
                                            <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                                                {!! Form::label('city', '*City', ['class' => 'control-label']) !!}
                                                {!! Form::select('city' , $FinalCities , null , ['class' => 'select2 form-control city_list' , 'id' => 'city_list' , 'style' => 'width: 100%']) !!}
                                                <span class="validation-message-block">{{ $errors->first('city', ':message') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-xs-12">
                                            <div class="form-group {{ $errors->has('job_type') ? 'has-error' : '' }}">
                                                {!! Form::label('job_type', '*Job Type' , ['class' => 'control-label']) !!}
                                                {!! Form::select('job_type' , getJobType1() , null , ['class' => 'select2 form-control' , 'id' => 'job_type' , 'placeholder' => 'Select job type*']) !!}
                                                <span class="validation-message-block">{{ $errors->first('job_type', ':message') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-xs-12">
                                            <div class="form-group {{ $errors->has('job_type_2') ? 'has-error' : '' }}">
                                                {!! Form::label('job_type_2', '*Job Type 2' , ['class' => 'control-label']) !!}
                                                {!! Form::select('job_type_2' , getJobType2() , null , ['class' => 'select2 form-control' , 'id' => 'job_type' , 'placeholder' => 'Select job type*']) !!}
                                                <span class="validation-message-block">{{ $errors->first('job_type_2', ':message') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-xs-12">
                                            <div class="form-group {{ $errors->has('seniority_level') ? 'has-error' : '' }}">
                                                {!! Form::label('seniority_level', '*Seniority Level' , ['class' => 'control-label']) !!}
                                                {!! Form::select('seniority_level' , getSeniorityLevel() , null , ['class' => 'select2 form-control' , 'id' => 'seniority_level' , 'placeholder' => 'select level']) !!}
                                                <span class="validation-message-block">{{ $errors->first('seniority_level', ':message') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 col-xs-12">
                                            <div class="form-group {{ $errors->has('job_category') ? 'has-error' : '' }}">
                                                {!! Form::label('job_category', '*Job Category' , ['class' => 'control-label']) !!}
                                                {!! Form::select('job_category[]' , $categories , old('job_category') , ['class' => 'form-control' , 'id' => 'job_category']) !!}
                                                <span class="validation-message-block">{{ $errors->first('job_category', ':message') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 col-xs-12">
                                            <div class="bold" style="margin-top: 15px;margin-bottom: 5px;">*Description of the job</div>
                                            <div id="textarea_feedback"> </div>
                                            <div class="form-group {{ $errors->has('desc') ? 'has-error' : '' }}">
                                                {!! Form::textarea('desc', null, array('id' => 'tm_textAreaDesc' , 'class' => 'form-control input-sm tmc-textarea mce' , 'placeholder' => '' , 'rows' => '4')) !!}
                                                <span class="validation-message-block">{{ $errors->first('desc', ':message') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-xs-12">
                                            <div class="bold" style="margin-top: 15px;margin-bottom: 5px;">Description of the job (Persian)</div>
                                            <div id="textarea_feedback"> </div>
                                            <div class="form-group {{ $errors->has('p_desc') ? 'has-error' : '' }}">
                                                {!! Form::textarea('p_desc', null, array('id' => 'tm_textAreaPDesc' , 'class' => 'form-control input-sm tmc-textarea text-right mce' , 'placeholder' => '' , 'rows' => '4')) !!}
                                                <span class="validation-message-block">{{ $errors->first('p_desc', ':message') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="bold" style="margin-top: 15px;margin-bottom: 15px;">Job Requirements</div>
                                    <div class="row">
                                        <div class="col-md-12 col-xs-12 optionRequirements">
                                            <div class="col-md-2 col-xs-12">
                                                <div class="form-group {{ $errors->has('gender') ? 'has-error' : '' }}">
                                                    {!! Form::label('gender', 'Gender' , ['class' => 'control-label']) !!}
                                                    {!! Form::select('gender' , removePlaceHolder(['m' => 'Male', 'f' => 'Female']) , null , ['class' => 'select2 form-control' , 'id' => 'gender']) !!}
                                                    <span class="validation-message-block">{{ $errors->first('gender', ':message') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-1 col-xs-12">
                                                <div class="form-group {{ $errors->has('age_from') ? 'has-error' : '' }}">
                                                    <label for="age_from" class="control-label">Age <span class="small">(From)</span></label>
                                                    {!! Form::select('age_from' , removePlaceHolder(ageFrom()) , null , ['class' => 'select2 form-control' , 'id' => 'age_from' ]) !!}
                                                    <span class="validation-message-block">{{ $errors->first('age_from', ':message') }}</span>
                                                </div>
                                            </div>

                                            @php
                                                $isDisabled = 'disabled';
                                                $ageForm = intval($post->age_from) > 0 ? intval($post->age_from) : array_first(ageFrom());
                                                if($ageForm)
                                                    $isDisabled = null;
                                            @endphp
                                            <div class="col-md-1 col-xs-12">
                                                <div class="form-group {{ $errors->has('age_to') ? 'has-error' : '' }}">
                                                    <label for="age_from" class="control-label"><span class="small">(To)</span></label>
                                                    {!! Form::select('age_to' , removePlaceHolder(ageTo($ageForm)) , null , ['class' => 'select2 form-control' , 'id' => 'age_to' , $isDisabled ]) !!}
                                                    <span class="validation-message-block">{{ $errors->first('age_to', ':message') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-xs-12">
                                                <div class="form-group {{ $errors->has('criteria_city') ? 'has-error' : '' }}">
                                                    <label for="age_from" class="control-label">
                                                        <span>Applicant's Location</span>
                                                    </label>
                                                    {!! Form::select('criteria_city' , removePlaceHolder($FinalCities) , null , ['class' => 'select2 form-control city_list' , 'id' => 'city_list' , 'style' => 'width: 100%']) !!}
                                                    <span class="validation-message-block">{{ $errors->first('criteria_city', ':message') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-2 col-xs-12">
                                                <div class="form-group {{ $errors->has('experience_years') ? 'has-error' : '' }}">
                                                    {!! Form::label('experience_years', 'Min. Experience (Years)' , ['class' => 'control-label']) !!}
                                                    {!! Form::select('experience_years' , removePlaceHolder(ExperienceYearsList()) , null , ['class' => 'select2 form-control experience' , 'id' => 'experience_list' , 'style' => 'width: 100%']) !!}
                                                    <span class="validation-message-block">{{ $errors->first('experience_years', ':message') }}</span>
                                                </div>
                                            </div>
                                            <div class="col-md-3 col-xs-12">
                                                <div class="form-group {{ $errors->has('english_ability') ? 'has-error' : '' }}">
                                                    <label for="age_from" class="control-label">
                                                        <span>English Languages Ability</span>
                                                    </label>
                                                    {!! Form::select('english_ability' , removePlaceHolder(SelectEvaluateEnglishList()) , null , ['class' => 'select2 form-control' , 'id' => 'english_ability']) !!}
                                                    <span class="validation-message-block">{{ $errors->first('english_ability', ':message') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <style>
                                        .optionRequirements [class*="col-md-"] {
                                            padding: 0px;
                                            padding-left: 2px;
                                            padding-right: 2px;
                                        }
                                    </style>
                                    <div class="row">
                                        <div class="col-md-12 col-xs-12">
                                            <div id="textarea_feedback"> </div>
                                            <div class="form-group {{ $errors->has('requirements') ? 'has-error' : '' }}">
                                                {!! Form::textarea('requirements', null, array('id' => 'tm_textAreaRequirements' , 'class' => 'form-control input-sm tmc-textarea mce' , 'placeholder' => '' , 'rows' => '4')) !!}
                                                <span class="validation-message-block">{{ $errors->first('requirements', ':message') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-xs-12">
                                            <div class="bold" style="margin-top: 15px;margin-bottom: 5px;">Job Requirements (Persian)</div>
                                            <div id="textarea_feedback"> </div>
                                            <div class="form-group {{ $errors->has('p_requirements') ? 'has-error' : '' }}">
                                                {!! Form::textarea('p_requirements', null, array('id' => 'tm_textAreaPRequirements' , 'class' => 'form-control input-sm tmc-textarea mce text-right' , 'placeholder' => '' , 'rows' => '4')) !!}
                                                <span class="validation-message-block">{{ $errors->first('p_requirements', ':message') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <h4 class="bold" style="margin-top: 25px">Keyword</h4>
                                    <div class="row">
                                        <div class="col-md-12 col-xs-12">
                                            <div class="form-group {{ $errors->has('keyword') ? 'has-error' : '' }}">
                                                {!! Form::select('keyword[]' , $keywords , $keywords , ['class' => 'form-control' , 'id' => 'keyword', 'multiple' => '']) !!}
                                                <span class="validation-message-block">{{ $errors->first('keyword', ':message') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="questionHere"></div>
                                    <div class="row" style="margin-top: 25px">
                                        <div class="col-md-12 col-xs-12">
                                            <div class="form-group {{ $errors->has('has_q') ? 'has-error' : '' }}">
                                                {{--<label class="control-label">Questionnaire</label>--}}
                                                <div class="bold" style="margin-bottom: 15px">Questionnaire</div>
                                                <div class="">
                                                    <span>Do you want the applicants to answer some specific questions (<span class="noteBlink">up to 10 questions</span>)?</span>
                                                    <span class="md-radio-inline">
                                        <span class="md-radio" style="margin-left: 10px;">
                                            <input type="radio" value="n" id="radio3" name="has_q" data-value="no" class="md-radiobtn questionHas" {{ $post->has_q ? 'checked' : null }} />
                                            <label for="radio3">
                                                <span class="inc"></span>
                                                <span class="check"></span>
                                                <span class="box"></span>No </label>
                                        </span>
                                        <span class="md-radio">
                                            <input type="radio" value="y" id="radio2" name="has_q" data-value="yes" class="md-radiobtn questionHas" {{ ( $post->has_q == 'y' OR $post->has_q == null ) ? 'checked' : null }} />
                                            <label for="radio2">
                                                <span class="inc"></span>
                                                <span class="check"></span>
                                                <span class="box"></span>Yes </label>
                                        </span>
                                    </span>
                                                </div>
                                                <span class="validation-message-block">{{ $errors->first('has_q', ':message') }}</span>
                                            </div>


                                            <div class="BoxError"></div>
                                        </div>
                                        <div class="questionHasBox" style="{{$post->has_q == 'n' ? 'display: none;' : null}}">

                                            <div class="col-md-12 col-xs-12">
                                                <div id="questions">


                                                    @php
                                                        $questions = (isset($post->questions) AND is_array($post->questions->toArray())) ? $post->questions->toArray() : old('question');
                                                    @endphp

                                                    @if(isset($questions) AND is_array($questions) AND count($questions))
                                                        @foreach($questions as $questionKey => $question)
                                                            <div class="question">
                                                                <div class="row">
                                                                    <div style="margin-bottom: 5px;">

                                                                        <div class="questionBox col-md-12">
                                                                            {{--<span class="questionClose">x</span>--}}

                                                                            <div class="col-md-5 col-md-5-5">
                                                                                <div class="input-group input-group-sm">
                                                                                    <span class="input-group-addon" id="sizing-addon1">Q<span class="questionNumber">{{$questionKey+1}}</span></span>
                                                                                    <input type="text" name="question[question][{{$question['id']}}]" value="{{$question['question']}}" class="form-control" placeholder="Question" aria-describedby="sizing-addon1">
                                                                                </div>
                                                                            </div>

                                                                            <div class="col-md-2">
                                                                                <div class="input-group input-group-sm">
                                                                                    <span class="input-group-addon" id="sizing-addon1">Type</span>
                                                                                    <select class="form-control questionEdit" name="question[type][{{$question['id']}}]">
                                                                                        <option value="0" {{$question['type'] == 0 ? 'selected' : null}}>Yes/No</option>
                                                                                        <option value="1" {{$question['type'] == 1 ? 'selected' : null}}>Descriptive</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>

                                                                            {{--<div class="col-md-2">--}}
                                                                            {{--<div class="input-group input-group-sm">--}}
                                                                            {{--<span class="input-group-addon" id="sizing-addon1">Is Required?</span>--}}
                                                                            {{--<select class="form-control" name="question[is_required][{{$question['id']}}]">--}}
                                                                            {{--<option value="0" {{$question['is_required'] == 0 ? 'selected' : null}}>No</option>--}}
                                                                            {{--<option value="1" {{$question['is_required'] == 1 ? 'selected' : null}}>Yes</option>--}}
                                                                            {{--</select>--}}
                                                                            {{--</div>--}}
                                                                            {{--</div>--}}

                                                                            <div class="col-md-3 rejectIf" style="{{$question['type'] == 1 ? 'display: none;' : null}}">
                                                                                <div class="input-group input-group-sm">
                                                                                    <span class="input-group-addon" id="sizing-addon1">Reject Applicant if</span>
                                                                                    <select class="form-control" name="question[reject_if][{{$question['id']}}]">
                                                                                        <option value="0" {{$question['reject_if'] == 0 ? 'selected' : null}}>No</option>
                                                                                        <option value="1" {{$question['reject_if'] == 1 ? 'selected' : null}}>Yes</option>
                                                                                    </select>
                                                                                </div>
                                                                            </div>

                                                                            <div class="pull-left">
                                                                                <label class="questionClose text-center">X</label>
                                                                            </div>

                                                                        </div><!--questionBox-->

                                                                        <div class="clearfix"></div>
                                                                    </div>
                                                                </div>
                                                                <div class="questionShowError"></div>
                                                            </div>
                                                        @endforeach
                                                    @endif


                                                </div>
                                            </div>

                                            <div class="col-md-12 col-xs-12 margin-top-15" style="margin-bottom: 10px;">
                                                <input type="button" class="btn btn-success btn-circle btn-xs bold" id="btnQuestionAdd" value="+ Add another" />
                                            </div>

                                            <input type="hidden" id="questionTotal" data-total="10" data-value="0" />
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>

                                </div>

                            </div>
                        </div>
                        <input name="identifier" type="hidden" id="ad_number" data-id="{{$post->ad_number}}">
                    </div>

                    <div class="row">
                        <hr>
                        <div class="col-md-12">
                            <a href="{{route('admin.approval.list')}}" class="btn btn-default" >Cancel</a>
                            <button type="button" class="btn btn-success pull-right" id="btnSubmitPageEdit">Approved</button>
                            <button type="button" class="btn btn-danger pull-right" id="btnPostReject">Reject</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
{!! Form::close() !!}



@stop


@section('header')
    <link href="{{asset('global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <style type="text/css">
        .select2-container--default .select2-selection--multiple,
        .select2-container--default .select2-selection--single
        {
            border: 1px solid #c2cad8 !important;
            outline: none !important;
        }
        .list-group.hover .list-group-item:hover
        {
            background-color: #e7ecf1;
        }
        .list-group .list-group-item .list-group .list-group-item
        {
            padding: 2px;
        }
        .list-group .list-group-item .list-group .list-group-item:hover
        {
            background-color: #e1eefa;
        }
        div.price
        {
            /*padding: 5px;*/
            font-size: 20px;
            margin-bottom: 14px;
            /*margin-top: 2px;*/
            color: #26c700;
        }
        .price.free
        {
            color: #c7ac00;
        }
        div.levelTowPrice
        {
            /*padding: 5px;*/
            font-size: 20px;
            margin-bottom: 4px;
            margin-top: 2px;
            color: #26c700;
        }
        .md-checkbox label>.box
        {
            top: 4px !important;
        }
        .md-checkbox label>.check
        {
            top: 0px !important;
        }
        .md-checkbox label
        {
            padding:0 !important;
        }
        .md-radio
        {
            /*margin-left: 42% !important;*/
            /*margin-bottom: 10px !important;*/
            /*margin-top: 10px !important;*/
        }
        .pointer *
        {
            cursor: pointer !important;
        }
        .pointer .offTop , .price .offTop
        {
            background: #006400;
            color: #fff;
            padding-left: 4px;
            padding-right: 5px;
            position: absolute;
            margin-top: -5px;
            margin-left: -11px;
            font-size: 12px;
            border-radius: 15px !important;
        }
        .price .offTop
        {
            margin-top: -35px;
            margin-left: 17px;
        }
        .questionBox [class*=col-md-]
        {
            padding-left: 0px;
            padding-right: 5px;
        }
        .questionClose
        {
            /*z-index: 1;*/
            /*position: absolute;*/
            background: #f00;
            color: #fff;
            margin-top: 1px;
            /*margin-left: 7px;*/
            padding: 8px;
            padding-top: 4px;
            padding-bottom: 4px;
            opacity: 0.1;
            cursor: pointer;
            -o-transition: opacity 300ms;
            -moz-transition: opacity 300ms;
            -webkit-transition: opacity 300ms;
            transition: opacity 300ms;
            border-radius: 3px !important;

        }
        .question:hover .questionClose
        {
            opacity: 1;
            -o-transition: opacity 300ms;
            -moz-transition: opacity 300ms;
            -webkit-transition: opacity 300ms;
            transition: opacity 300ms;
        }
        .question .error , .BoxError
        {
            color: #f00;
            padding-bottom: 5px;
        }
        body.modal-open , html .modal-open
        {
            overflow: hidden !important;
        }

        @media(min-width: 990px)
        {
            .col-md-5-5
            {
                width: 55.5%;
            }
        }
    </style>
@stop

@section('footer')
    <script src="{{asset('global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('global/plugins/tinymce/tinymce.min.js')}}" type="text/javascript"></script>
    <script type="text/javascript">
        var questionIndex = 0;
        var flagsPatch = '{{ asset('global/plugins/flags/') }}'+'/';
        var postKeyword = '{{route('post.employer.getAjaxKeyword')}}';
        var rejectMessages = {!! (isset($RejectMessages)) ?  $RejectMessages  : null !!}
        M6.post();
        M6.countryCities();
        M6.initTinyMCE();
    </script>
@stop