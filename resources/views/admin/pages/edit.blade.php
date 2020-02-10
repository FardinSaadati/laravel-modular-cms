@extends('admin.include.layout')
@section('content')

<div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="panel-body form">
                <div class="panel panel-grey">
                    <div class="panel-heading">{{$title}}</div>
                    <div class="panel-body">
                        {!! Form::model($page , array('route' => ['admin.pages.update' , $page ], 'method' => 'POST' , 'files' => true , 'id' => 'PostEditForm')) !!}

                            <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-6 col-xs-12">
                                            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                                <label class="control-label">
                                                    <span>Title</span>
                                                </label>
                                                <div class="input-icon right">
                                                    @if($errors->has('title'))
                                                        <i class="fa fa-exclamation tooltips" data-container="body"></i>
                                                    @endif
                                                    {!! Form::text('title' , null , ['class' => 'form-control' , 'placeholder' => 'Title'] ) !!}
                                                    <span class="validation-message-block">{{ $errors->first('title', ':message') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-xs-12">
                                            <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                                                <label class="control-label">
                                                    <span>Slug</span>
                                                </label>
                                                <div class="input-icon right">
                                                    @if($errors->has('slug'))
                                                        <i class="fa fa-exclamation tooltips" data-container="body"></i>
                                                    @endif
                                                    {!! Form::text('slug' , null , ['class' => 'form-control' , 'placeholder' => 'Slug (User friendly URL)']) !!}
                                                    <span class="validation-message-block">{{ $errors->first('slug', ':message') }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-xs-12">
                                            <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                                                <label class="control-label">
                                                    <span>Body</span>
                                                </label>
                                                <div class="input-icon right">
                                                    @if($errors->has('body'))
                                                        <i class="fa fa-exclamation tooltips" data-container="body"></i>
                                                    @endif
                                                    {!! Form::textarea('body' , null , ['class' => 'form-control mce' , 'placeholder' => 'Body of the news']) !!}
                                                    <span class="validation-message-block">{{ $errors->first('body', ':message') }}</span>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 col-xs-12">
                                            <div class="form-group {{ $errors->has('body') ? 'has-error' : '' }}">
                                                <label class="control-label">
                                                    <span>Persian Body</span>
                                                </label>
                                                <div class="input-icon right">
                                                    @if($errors->has('p_body'))
                                                        <i class="fa fa-exclamation tooltips" data-container="body"></i>
                                                    @endif
                                                    {!! Form::textarea('p_body' , null , ['class' => 'form-control mce' , 'placeholder' => 'Persian Body']) !!}
                                                    <span class="validation-message-block">{{ $errors->first('p_body', ':message') }}</span>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            <div class="col-md-12 col-xs-12">

                            <hr/>
                            <div class="">
                                <div class="pull-right">
                                    <a href="{{route('admin.pages.list')}}" class="btn btn-danger">Cancel</a>
                                    <button type="submit" class="btn btn-success" id="btn_page">Update</button>
                                </div>
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

@section('header')
<link href="{{asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
@stop

@section('footer')
<script src="{{asset('assets/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/tinymce/tinymce.min.js')}}" type="text/javascript"></script>
<script>
$("#cat_list").select2({
    placeholder: 'Select Categories' ,
    maximumSelectionLength: 2
});
M6.initTinyMCE();
M6.tabInitialize();
</script>
@stop


