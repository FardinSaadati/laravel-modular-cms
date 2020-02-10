@extends('admin.include.layout')

@section('header')
<link href="{{asset('admin/plugins/jqueryfileupload/css/jquery.fileupload.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
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
                    {!! Form::model($company , array('route' => ['admin.companies.update' , $company ], 'method' => 'POST' , 'files' => true, 'id' => 'FormCompanyEmployer')) !!}
                    <!--Company-->
                        <div class="row">
                            <div class="col-md-10 col-xs-12">

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
                                        <div class="col-md-4 col-xs-12" >
                                            <div class="form-group {{ $errors->has('p_title') ? 'has-error' : '' }}">
                                                <label class="control-label">*Company Farsi Name</label>
                                                <div class="input-icon right">
                                                    {!! Form::text('p_title' , null , ['class' => 'form-control farsiInput']) !!}
                                                    <span class="validation-message-block">{{ $errors->first('p_title', ':message') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-xs-12">
                                            <div class="form-group {{ $errors->has('national_id') ? 'has-error' : '' }}">
                                                <label class="control-label">*National ID</label>
                                                <div class="input-icon right">
                                                    {!! Form::text('national_id' , null , ['class' => 'form-control', 'data-number', 'maxlength' => 11]) !!}
                                                    <span class="validation-message-block">{{ $errors->first('national_id', ':message') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-1 col-xs-12" >
                                            <div style="margin-top: 20px;">
                                                <div id="colorSelector" class="pull-right">
                                                    <div style="background-color: #fff"></div>
                                                </div>
                                            </div>
                                            <input type="hidden" class="form-control" name="colorPicker" id="colorPicker" value="{{(empty($company->colorPicker)) ? '#019537' : $company->colorPicker }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="col-md-4 col-xs-12">
                                            <div class="form-group {{ $errors->has('company_type') ? 'has-error' : '' }}">
                                                {!! Form::label('company_type', '*Ownership') !!}
                                                {!! Form::select('company_type' , getAllCompanyTypes() , null , ['class' => 'select2 form-control' , 'id' => 'company_type' , 'style' => 'width: 100%', 'placeholder' => '']) !!}
                                                <span class="validation-message-block">{{ $errors->first('company_type', ':message') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <div class="form-group {{ $errors->has('country') ? 'has-error' : '' }}">
                                                {!! Form::label('country', '*Country') !!}
                                                {!! Form::select('country' , $countries , null , ['class' => 'select2 form-control' , 'id' => 'country_list' , 'style' => 'width: 100%', 'placeholder' => '']) !!}
                                                <span class="validation-message-block">{{ $errors->first('country', ':message') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <div class="form-group {{ $errors->has('city') ? 'has-error' : '' }}">
                                                {!! Form::label('city', '*City') !!}
                                                {!! Form::select('city' , addEmptyToFirstIndexArray($cities) , null , ['class' => 'select2 form-control city_list' , 'id' => 'city_list' , 'style' => 'width: 100%']) !!}
                                                <span class="validation-message-block">{{ $errors->first('city', ':message') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 col-xs-12">
                                        <div class="col-md-4 col-xs-12">
                                            <div class="form-group {{ $errors->has('address') ? 'has-error' : '' }}">
                                                <label class="control-label">*Address</label>
                                                {!! Form::textarea('address', null, array('id' => 'address' , 'class' => 'form-control input-sm', 'rows' => '1'
                                                        , 'maxlength' => '500', 'style' => 'height: 34px;')) !!}
                                                <span class="validation-message-block">{{ $errors->first('address', ':message') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <div class="form-group {{ $errors->has('p_address') ? 'has-error' : '' }}">
                                                <label class="control-label">Address (farsi)</label>
                                                {!! Form::textarea('p_address', null, array('id' => 'p_address' , 'class' => 'form-control farsiInput input-sm', 'rows' => '1'
                                                        , 'maxlength' => '500', 'style' => 'height: 34px;')) !!}
                                                <span class="validation-message-block">{{ $errors->first('p_address', ':message') }}</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-xs-12">
                                            <div class="form-group {{ $errors->has('employees_count') ? 'has-error' : '' }}">
                                                <label class="control-label">*Size <small>(Number of Employees)</small></label>
                                                {!! Form::select('employees_count' , sizeCompanies() , null , ['class' => 'select2 form-control', 'id' => 'employees_count' , 'placeholder' => '']) !!}
                                                <span class="validation-message-block">{{ $errors->first('employees_count', ':message') }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="col-md-6 col-xs-12">
                                            <div class="form-group {{ $errors->has('company_activity') ? 'has-error' : '' }}">
                                                <label class="control-label">*Activity</label>
                                                {!! Form::select('company_activity' , $activities  , null , ['class' => 'select2 form-control' ,'id' => 'company_activity' , 'width'=>'100%']) !!}
                                                <span class="validation-message-block" id="multi-select-error-container">{{ $errors->first('company_activity', ':message') }}</span>
                                            </div>
                                        </div>

                                        @if($subActivityFields)
                                        <div class="col-md-6 col-xs-12">
                                            <div class="form-group {{ $errors->has('subActivityFields') ? 'has-error' : '' }}">
                                                <label class="control-label">Sub-Activity / Product(s)</label>
                                                {!! Form::select('subActivityFields[]' , $subActivityFields  , $subActivityFieldsSelected , ['class' => 'select2 form-control' , !$subActivityFields ? 'disabled' : '', 'id' => 'subActivityFields' , 'width'=>'100%']) !!}
                                                <span class="validation-message-block">{{ $errors->first('subActivityFields', ':message') }}</span>
                                            </div>
                                        </div>
                                        @endif

                                        <div class="col-md-12 col-xs-12">
                                            <div class="form-group {{ $errors->has('company_fields') ? 'has-error' : '' }}">
                                                <label class="control-label">*Field of Expertise</label>
                                                {!! Form::select('company_fields[]' , $fieldsList  , $selectedFields , ['class' => 'select2 form-control' , 'multiple' ,'size' => 1, 'id' => 'company_fields' , 'width'=>'100%']) !!}
                                                <span class="validation-message-block" id="multi-select-error-container">{{ $errors->first('company_fields', ':message') }}</span>
                                            </div>
                                        </div>

                                    </div>
                                </div>


                                <div class="col-md-12 col-xs-12">
                                    <div class="form-group {{ $errors->has('desc') ? 'has-error' : '' }}">
                                        <label class="control-label">*About the Company</label>
                                        {!! Form::textarea('desc', null, array('id' => 'tm_textArea' , 'class' => 'form-control input-sm', 'rows' => '6', 'style' => 'min-height: 120px;')) !!}
                                        <span class="validation-message-block">{{ $errors->first('desc', ':message') }}</span>
                                    </div>
                                </div>

                                <div class="col-md-12 col-xs-12">
                                    <div class="form-group {{ $errors->has('p_desc') ? 'has-error' : '' }}">
                                        <label class="control-label">*About the Company Farsi</label>
                                        {!! Form::textarea('p_desc', null, array('id' => 'tm_textArea_farsi' , 'class' => 'form-control input-sm farsiInput', 'rows' => '6', 'style' => 'min-height: 120px;')) !!}
                                        <span class="validation-message-block">{{ $errors->first('p_desc', ':message') }}</span>
                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-md-12 col-xs-12">
                                        <div class="col-md-6 col-xs-12">
                                            <div class="form-group {{ $errors->has('phoneCompany') ? 'has-error' : '' }}">
                                                <label class="control-label">*Telephone</label>
                                                <div class="input-icon right">
                                                    {!! Form::text('phoneCompany' , null , ['class' => 'form-control', 'data-number']) !!}
                                                    <span class="validation-message-block">{{ $errors->first('phoneCompany', ':message') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            <div class="form-group {{ $errors->has('website') ? 'has-error' : '' }}">
                                                <label class="control-label">Website</label>
                                                <div class="input-icon right">
                                                    {!! Form::text('website' , null , ['class' => 'form-control']) !!}
                                                    <span class="validation-message-block">{{ $errors->first('website', ':message') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="col-md-2 col-xs-12">
                                <div class="col-md-12 col-xs-12">

                                    <div class="text-center companyEmployer">
                                        <label for="logoUpload">
                                        @if($company->img && $company->img != '')
                                            <img src="{{COMPANY_LOGO_MAIN_PATH.'/'.$company->img}}" class="image-company-profile" />
                                        @else
                                            @if($logoImage)
                                            <img src="{{asset('uploads/company-logos-temp/'.$logoImage)}}" class="image-company-profile" />
                                            @else
                                            <img src="{{ asset('admin/custom/company-logo-placeholder-plus.jpg')}}" class="image-company-profile" />
                                            @endif
                                        @endif



                                            @if(isset($company) &&  !isset($company->title))
                                                <input type="hidden" id="status_First_logo_company" value="0" />
                                            @endif

                                            <div  id="progress" class="progress progress-striped progress-custom active">
                                                <div id="progressBar" class="progress-bar progress-bar-success" role="progressbar">
                                                </div>
                                            </div>

                                            <div class="col-md-6 col-xs-12 hide">
                                                <!-- Company Logo Upload -->
                                                <label class="control-label">Upload Company Logo</label>
                                                <div id="upload-box" class="custom-file-input {{ Session::has('logoError') ? 'pulsate-regular' : '' }}">
                                                    <span class="fileinput-button">
                                                        <i class="font-green-turquoise icon-cloud-upload icon-upload-custom"></i>
                                                        <span>upload company logo</span>
                                                        <!-- The file input field used as target for the file upload widget -->
                                                        {!! Form::file('logo' , ['id' => 'logoUpload' , 'class' => 'disabled', 'accept' => '.jpg,.jpeg,.png']) !!}
                                                    </span>
                                                </div>
                                                <!-- The global progress bar -->
                                                <div id="progress" class="progress progress-striped progress-custom active">
                                                    <div id="progressBar" class="progress-bar progress-bar-success" role="progressbar">
                                                    </div>
                                                </div>
                                                <!-- The container for the uploaded files -->
                                                <div id="logo-thumb-container">
                                                    <img id="logo-thumb-image" src="{{ (isset($company->img) AND $company->img) ? COMPANY_LOGO_MAIN_PATH.'/'.$company->img : ''}}">
                                                </div>
                                                <div id="logo-error-reporting"></div>
                                                <br>
                                                <!-- Company Logo Upload -->
                                            </div>

                                        </label>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <div class="row" >
                            <div class="col-md-12 col-xs-12">
                                <div class="col-md-12 col-xs-12 text-left">
                                    <hr />
                                    @if(isset($ap))
                                        <a href="{{route('admin.approval.list')}}" class="btn btn-default" >Cancel</a>
                                        <button type="button" class="btn btn-success pull-right" id="btnCompanySubmit">Approve</button>
                                        <button type="button" class="btn btn-danger pull-right" id="btnCompanyReject">Reject</button>
                                    @else
                                        <a href="{{route('admin.companies.list')}}" class="btn btn-danger" >Cancel</a>
                                        <button type="button" class="btn btn-success" id="btnCompanySubmit">{{ (isset($company->title) AND $company->title) ? 'Update Company' : 'Create Company' }}</button>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @if( isset($ap) )
                            <input name="approval" type="hidden" value='true'>
                            <input name="qq" type="hidden" id="co_number" data-id="{{$company->co_number}}">
                        @endif
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
var urlGetSubActivities = '{{route('company.getAjaxSubActivities')}}';
var flagsPatch = '{{ asset('global/plugins/flags/') }}'+'/';
var rejectMessages = {!! (isset($RejectMessages)) ?  $RejectMessages  : null !!}
M6.company();
M6.countryCities();
</script>
@stop


