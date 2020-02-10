@extends('admin.include.layout')
@section('content')
<div class="row">
    <div class="col-md-12 col-xs-12">
        <div class="panel panel-grey">
                <div class="panel-heading">
                    <span class="fa fa-users"></span>
                    <span class="bold">{{!empty($title) ? $title: ''}}</span>
                    <span class="font-normal"> ( Total : {{$posts->count()}} ) </span>
                    <span class="pull-right">
                    <a href="{{route('admin.blogPosts.add')}}" class="btn btn-xs btn-success" style="margin-top: -2px;">+ Add New</a>
                </span>
                </div>
                <div class="panel-body">
                    @if(count($posts))
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Created at</th>
                                    <th>Last Update</th>
                                    <th class="center-text">Status</th>
                                    <th class="center-text">Views</th>
                                    <th width="60px"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($posts as $post)
                                    <tr>
                                        <td>
                                            {{$post->title}}
                                        </td>
                                        <td>
                                            {{$post->slug}}
                                        </td>
                                        <td>
                                            {{\Carbon\Carbon::parse($post->created_at)->format('Y-m-d H:m')}}
                                        </td>
                                        <td>
                                            {{\Carbon\Carbon::parse($post->updated_at)->diffForHumans()}}
                                        </td>
                                        <td class="center-text">
                                            @if($post->is_published == 'N')
                                                <button class="btn btn-xs btn-default status-change" data-status="{{$post->is_published}}" data-new="{{$post->id}}">
                                                    <i class="fa fa-ban fa-1x text-danger"></i>
                                                </button>
                                            @else
                                                <button class="btn btn-xs btn-default status-change" data-status="{{$post->is_published}}" data-new="{{$post->id}}">
                                                    <i class="fa fa-check fa-1x text-success"></i>
                                                </button>
                                            @endif
                                        </td>
                                        <td class="center-text">
                                            <span class="badge badge-success"> {{$post->views}} </span>
                                        </td>
                                        <td style="width: 3px;">
                                            <div class="btn-group btn-group-xs btn-group-solid">
                                                <a href="{{route('admin.blogPosts.edit' , $post)}}"  class="btn blue"><i class="fa fa-edit"></i></a>
                                                <a href="{{route('admin.blogPosts.delete' , $post)}}" class="btn red confirmation-remove"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>

                        <div class="text-center">
                            {{ $posts->render() }}
                        </div>
                    @else
                        <div class="text-center" style="padding: 50px;">
                            <img width="100px" src="{{asset('assets/admin/images/icons/sad.png')}}">
                            <p>No data found to view</p>
                        </div>
                    @endif
                </div>
            </div>
    </div>
</div>
@stop

@section('footer')
<script>
    $(document).on('click' , '.status-change' , function () {
        var element = $(this);
        var status = $(this).data('status');
        var userId = $(this).data('new');
        var datasending = {status: (status == 'Y' ? 'N' : 'Y') , user_id: userId};
        $.ajax({
            type: 'post',
            headers: {'X-CSRF-TOKEN': _csrf_token},
            url: Path+'blogPosts/AjaxStatusUpdate',
            data: JSON.stringify(datasending),
            contentType: "application/json; charset=utf-8",
            traditional: true,
            success: function (data) {
                if(data.status == 'error'){
                    console.log(data.message);
                }else {

                    $(element).hide();

                    if(data.newStatus == 'Y'){
                        $(element).parent('td:first').append('<button class="btn btn-xs btn-default status-change" data-status="Y" data-new="'+ userId+'">' +
                            '<i class="fa fa-check fa-1x text-success"></i>' +
                            '</button>');
                    } else {
                        $(element).parent('td:first').append('<button class="btn btn-xs btn-default status-change" data-status="N" data-new="'+ userId+'">' +
                            '<i class="fa fa-ban fa-1x text-danger"></i>' +
                            '</button>');
                    }
                }

            }
        });
    });

    $(document).ajaxStart(function() {
        $(document).find('body').append('<div class="ajax-wrapper"></div>');
    });
    $(document).ajaxStop(function() {
        $(document).find('.ajax-wrapper').hide();
    });
</script>
@stop