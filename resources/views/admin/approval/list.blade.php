@extends('admin.include.layout')
@section('content')
    <div class="row">
        <div class="col-md-12 col-xs-12">
            <div class="panel panel-grey">
                <div class="panel-heading">
                    <span class="fa fa-users"></span>
                    <span class="bold">{{!empty($title) ? $title: ''}}</span>
                </div>
                <div class="panel-body">
                    <table class="table table-bordered table-responsive" id="approval-table" style="width: 100%; display: none;">
                        <thead>
                        <tr>
                            <th>Type</th>
                            <th>Text</th>
                            <th width="50">Image</th>
                            <th width="50"></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $d)
                        <tr id="TR-{{$d->identifier}}">
                            <td>{{$d->type}}</td>
                            <td>{{$d->text}}</td>
                            <td class="center-text">
                            @php
                                switch ($d->type) {
                                case TASKS_TYPE_PROFILE_IMAGE:
                                echo
                                "<a href=". USER_PROFILE_IMAGE_MAIN_PATH.'/'.$d->id ." data-lightbox='profile-image-".$d->id."'>
                                 <img class='img-thumbnail sidebar-logo image-dataTable' src='". USER_PROFILE_IMAGE_MAIN_PATH.'/'.$d->id ."'/>
                                </a>";
                                break;

                                case TASKS_TYPE_COMPANY_LOGO:
                                echo
                                "<a href=". COMPANY_LOGO_MAIN_PATH.'/'.$d->id ." data-lightbox='company-logo-".$d->id."'>
                                 <img class='img-thumbnail sidebar-logo image-dataTable' src='". COMPANY_LOGO_MAIN_PATH.'/'.$d->id ."'/>
                                </a>";
                                break;

                                case TASKS_TYPE_COMPANY_COVER:
                                echo
                                "<a href=". COMPANY_COVER_MAIN_PATH.'/'.$d->id ." data-lightbox='company-logo-".$d->id."'>
                                 <img class='img-thumbnail sidebar-logo image-dataTable' src='". COMPANY_COVER_MAIN_PATH.'/'.$d->id ."'/>
                                </a>";
                                break;
                            }
                            @endphp
                            </td>
                        <td class="center-text">
                            @php
                                switch ($d->type) {
                                case TASKS_TYPE_PROFILE_IMAGE:
                                    echo "<button class='btn btn-xs btn-success approve-profile-image' data-id='".$d->identifier."'>Decide</button></td>";;
                                    break;
                                case TASKS_TYPE_COMPANY_LOGO:
                                    echo "<button class='btn btn-xs btn-success approve-company-logo' data-id='".$d->identifier."'>Decide</button></td>";
                                    break;
                                 case TASKS_TYPE_COMPANY_COVER:
                                    echo "<button class='btn btn-xs btn-success approve-company-cover' data-id='".$d->identifier."'>Decide</button></td>";
                                    break;
                                 case TASKS_TYPE_COMPANY:
                                    echo '<a class="btn btn-xs green-turquoise" href="'.route('admin.approval.companyEdit' , [$d->identifier , 'approval=yes']).'">Decide</a>';
                                    break;
                                 case TASKS_TYPE_POST:
                                    echo '<a class="btn btn-xs blue" href="'.route('admin.approval.postEdit' , [$d->identifier , 'approval=yes']).'">Decide</a>';
                                }
                                @endphp
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop
@section('header')
<style>
.image-dataTable{
    width: 30px;
    border-radius: 10px !important;
    box-shadow: 0px 0px 35px #eee;
    opacity: 0.8;
}
.lb-close{
    display: none !important;
}
</style>
<link href="{{asset('global/plugins/lightbox/css/lightbox.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('admin/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('admin/plugins/datatables/Responsive-2.2.1/css/responsive.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
@stop

@section('footer')
<script src="{{asset('global/plugins/lightbox/js/lightbox.js')}}" type="text/javascript"></script>
<script src="{{asset('admin/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('admin/plugins/datatables/Responsive-2.2.1/js/responsive.bootstrap.min.js')}}" type="text/javascript"></script>
<script>
M6.approvalList();
</script>
@stop