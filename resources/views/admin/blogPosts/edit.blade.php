@extends('admin.include.layout')
@section('content')

<div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="panel-body form">
                <div class="panel panel-grey">
                    <div class="panel-heading">{{$title}}</div>
                    <div class="panel-body">
                        {!! Form::model($post , array('route' => ['admin.blogPosts.update' , $post ], 'method' => 'POST' , 'files' => true , 'id' => 'PostEditForm')) !!}

                        <ul class="nav nav-tabs">
                            <li class="active" data-event-tab data-tab-data="active">
                                <a href="#active" data-toggle="tab" aria-expanded="true"> Main </a>
                            </li>
                            <li class="" data-event-tab data-tab-data="picture">
                                <a href="#picture" data-toggle="tab" aria-expanded="false"> Picture </a>
                            </li>
                        </ul>

                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="active">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-4 col-xs-12">
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
                                        <div class="col-md-3 col-xs-12">
                                            <div class="form-group {{ $errors->has('slug') ? 'has-error' : '' }}">
                                                <label class="control-label">
                                                    <span>Slug</span>
                                                </label>
                                                <div class="input-icon right">
                                                    @if($errors->has('slug'))
                                                        <i class="fa fa-exclamation tooltips" data-container="body"></i>
                                                    @endif
                                                    {!! Form::text('slug' , null , ['class' => 'form-control' , 'placeholder' => 'Slug (User friendly url)']) !!}
                                                    <span class="validation-message-block">{{ $errors->first('slug', ':message') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3 col-xs-12">
                                            <div class="form-group {{ $errors->has('categories') ? 'has-error' : '' }}">
                                                <label class="control-label"><span>Categories</span></label>
                                                <div class="input-icon right">
                                                    @if($errors->has('categories'))
                                                        <i class="fa fa-exclamation tooltips" data-container="body"></i>
                                                    @endif
                                                    {!! Form::select('categories[]' , $categories , $selectedCategory , ['class' => 'form-control input-sm select2', 'multiple' , 'size' => '1' , 'style' => 'width: 100%' , 'id' => 'cat_list' ]) !!}
                                                    <span class="validation-message-block">{{ $errors->first('categories', ':message') }}</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 col-xs-12">
                                            <div class="md-checkbox" style="margin-top: 30px;">
                                                <input name="is_published" type="checkbox" id="checkbox2" class="md-check" {{$post->is_published == 'Y' ? 'checked' : ''}}>
                                                <label for="checkbox2">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span> Publish Status</label>
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
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="picture">
                                <div class="col-md-5 col-xs-12">
                                    {!! Form::file('image' , array('class' => 'form-control'))!!}
                                    <span class="validation-message-block ">{{ $errors->first('image', ':message') }}</span>
                                    @if($post->img)
                                        <div class="space-15"></div>
                                        <div class="image-container">
                                            <img src="{{asset('uploads/admins/blogPosts-pictures/'.$post->img)}}">
                                            <span class="image-container-btn">
                                              <a href="{{route('admin.blogPosts.image.delete' , $post)}}" class="btn btn-xs red confirmation-remove">Remove</a>
                                            </span>
                                        </div>
                                        <div class="small-grey-text">
                                            <p>Upload a new photo and it will be replaced with the old one.</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-12 col-xs-12">
                            <hr/>
                            <div class="">
                                <div class="pull-right">
                                    <a href="{{route('admin.blogPosts.list')}}" class="btn btn-danger">Cancel</a>
                                    <button type="submit" class="btn btn-success" id="btn_post">Update</button>
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
<link href="{{asset('global/plugins/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('global/plugins/select2/css/select2-bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
@stop

@section('footer')
<script src="{{asset('global/plugins/select2/js/select2.full.min.js')}}" type="text/javascript"></script>
<script src="{{asset('global/plugins/tinymce/tinymce.min.js')}}" type="text/javascript"></script>
<script>
$("#cat_list").select2({
        placeholder: 'Select Categories' ,
        maximumSelectionLength: 2
});
M6.initTinyMCE();
M6.tabInitialize();
</script>
@stop


