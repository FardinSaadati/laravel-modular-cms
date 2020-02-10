@extends('admin.include.layout')

@section('header')
<link href="{{asset('admin/plugins/jqueryfileupload/css/jquery.fileupload.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
{{--<link href="{{asset('employer/global/plugins/jquery-multi-select/css/multi-select.css')}}" rel="stylesheet" type="text/css" />--}}
<link href="{{asset('admin/plugins/colorpicker/css/colorpicker.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('admin/plugins/colorpicker/css/layout.css')}}" rel="stylesheet" type="text/css" media="screen"/>
<style type="text/css">
    .custom-form-block
    {
        padding-right: 0;
        padding-left: 0;
    }
    .companyEmployer img
    {
        width: 108px;
        margin: 0 auto;
        margin-top: 22px;
        cursor: pointer;
        border: 1px solid #8e8e8e;
        border-radius: 4px !important;
        opacity: 0.5;
    }
    .companyEmployer img:hover
    {
        border: 1px solid #6e6e6e;
        opacity: 1;
    }
</style>
@stop

@section('content')
<div class="row">
    <div class="col-md-12 col-xs-12">
        <div class="panel-body form">
            <div class="panel panel-grey">
                <div class="panel-heading">{{$title}}</div>
                <div class="panel-body">
                    {!! Form::open( array('route' => 'admin.stores.save', 'method' => 'POST' , 'id' => 'FormStore')) !!}
                    <div class="row">

                        <div class="col-md-12 col-xs-12">

                                    <div class="col-md-4 col-xs-12">
                                        <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                            <label class="control-label">*Company Name</label>
                                            <div class="input-icon right">
                                                {!! Form::text('title' , null , ['class' => 'form-control']) !!}
                                                <span class="validation-message-block">{{ $errors->first('title', ':message') }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-xs-12">
                                        <div class="form-group {{ $errors->has('type') ? 'has-error' : '' }}">
                                            {!! Form::label('type', '*Type') !!}
                                            {!! Form::select('type' , getStoreTypes() , null , ['class' => 'select2 form-control' , 'id' => 'store_type']) !!}
                                            <span class="validation-message-block">{{ $errors->first('type', ':message') }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-4 col-xs-12">
                                        <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                                            {!! Form::label('city', '*City') !!}
                                            {!! Form::select('city' , addEmptyToFirstIndexArray($cities) , null , ['class' => 'select2 form-control city_list' , 'id' => 'city_list' , 'style' => 'width: 100%']) !!}
                                            <span class="validation-message-block">{{ $errors->first('city', ':message') }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-xs-12">
                                        <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                            <label class="control-label">*Address</label>
                                            {!! Form::textarea('address', null, array('id' => 'address' , 'class' => 'form-control input-sm', 'rows' => '2'
                                                    , 'maxlength' => '500')) !!}
                                            <span class="validation-message-block">{{ $errors->first('address', ':message') }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-xs-12">
                                        <div class="form-group {{ $errors->has('desc') ? 'has-error' : '' }}">
                                            <label class="control-label">*About the Company</label>
                                            {!! Form::textarea('desc', null, array('id' => 'tm_textArea' , 'class' => 'form-control input-sm', 'rows' => '2')) !!}
                                            <span class="validation-message-block">{{ $errors->first('desc', ':message') }}</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6 col-xs-12">
                                        <div class="form-group {{ $errors->has('phoneCompany') ? 'has-error' : '' }}">
                                            <label class="control-label">*Telephone</label>
                                            <div class="input-icon right">
                                                {!! Form::text('phoneCompany' , null , ['class' => 'form-control', 'data-number']) !!}
                                                <span class="validation-message-block">{{ $errors->first('phoneCompany', ':message') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                    </div>
                    <div class="row" >
                        <div class="col-md-12 col-xs-12">
                            <div class="col-md-12 col-xs-12 text-left">
                                <hr />
                                <a href="{{route('admin.stores.list')}}" class="btn btn-danger" >Cancel</a>
                                <button type="button" class="btn btn-success" id="btnCompanyCreate">{{ (isset($store->title) AND $store->title) ? 'Update Store' : 'Create Store' }}</button>
                            </div>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@stop

@section('footer')
<script src="{{asset('admin/plugins/jqueryfileupload/vendor/jquery.ui.widget.js')}}" type="text/javascript"></script>
<script src="{{asset('admin/plugins/jqueryfileupload/jquery.fileupload.js')}}" type="text/javascript"></script>
<script src="{{asset('admin/plugins/jquery.pulsate.min.js')}}" type="text/javascript"></script>
<script src="{{asset('global/plugins/select2/js/select2.min.js')}}" type="text/javascript"></script>
<script src="{{asset('admin/plugins/jquery-multi-select/js/jquery.multi-select.js')}}" type="text/javascript"></script>
<script src="{{asset('admin/plugins/colorpicker/js/colorpicker.js')}}" type="text/javascript"></script>
<script src="{{asset('admin/plugins/colorpicker/js/eye.js')}}" type="text/javascript"></script>
<script src="{{asset('admin/plugins/colorpicker/js/utils.js')}}" type="text/javascript"></script>
<script src="{{asset('admin/plugins/companiyPlugs/companyNew.js')}}" type="text/javascript"></script>
<script type="text/javascript">
var flagsPatch = '{{ asset('global/plugins/flags/') }}'+'/';
M6.company();
M6.countryCities();
</script>
@stop


