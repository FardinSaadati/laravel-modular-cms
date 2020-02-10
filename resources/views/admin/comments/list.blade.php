@extends('admin.include.layout')
@section('content')
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="panel panel-grey">
                <div class="panel-heading">
                    <span class="fa fa-users"></span>
                    <span class="bold">{{!empty($title) ? $title: ''}}</span>
                    <span class="font-normal"> ( Total : {{$comments->count()}} ) </span>
                    <span class="pull-right">
                </span>
                </div>
                <div class="panel-body">
                    @if(count($comments))
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th width="50px"></th>
                                    <th>Commenter</th>
                                    <th>Body</th>
                                    <th>Created at</th>
                                    <th class="center-text">Status</th>
                                    <th width="60px"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($comments as $comment)
                                    <tr>
                                        <td width="30px">
                                            @if($comment->user->user_image)
                                                <img class="img-circle" src="{{$comment->user->user_image}}" width="30px">
                                            @else
                                                <img  class="img-circle" width="30px" src="{{ asset('admin/auth/img/profile-placeholder.jpg') }}" />
                                            @endif
                                        </td>
                                        <td style="vertical-align: middle; width: 130px;">
                                            {{$comment->user->email}}
                                        </td>
                                        <td style="vertical-align: middle;">
                                            {{$comment->body}}
                                        </td>
                                        <td style="vertical-align: middle; width: 100px;">
                                            {{\Carbon\Carbon::parse($comment->created_at)->diffForHumans()}}
                                        </td>
                                        <td class="center-text" style="width: 100px; vertical-align: middle;">
                                            @if($comment->approved == 'N')
                                                <button class="btn btn-xs btn-default status-change" data-status="{{$comment->approved}}" data-new="{{$comment->id}}">
                                                    <i class="fa fa-ban fa-1x text-danger"></i>
                                                </button>
                                            @else
                                                <button class="btn btn-xs btn-default status-change" data-status="{{$comment->approved}}" data-new="{{$comment->id}}">
                                                    <i class="fa fa-check fa-1x text-success"></i>
                                                </button>
                                            @endif
                                        </td>
                                        <td style="vertical-align: middle; width: 3px;">
                                            <div class="btn-group btn-group-xs btn-group-solid">
                                                <a href="{{route('admin.comments.remove' , $comment)}}" class="btn red confirmation-remove"><i class="fa fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>

                            </table>
                        </div>

                        <div class="text-center">
                            {{ $comments->render() }}
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
                url: Path+'comments/AjaxStatusUpdate',
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