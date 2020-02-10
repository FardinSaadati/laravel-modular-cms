@extends('admin.include.layout')
@section('content')
<div class="row">
    <div class="col-md-12 col-xs-12">
        <div class="panel panel-grey">
            <div class="panel-heading">
                <span class="fa fa-building-o"></span>
                <span class="bold">{{!empty($title) ? $title: ''}}</span>
                <span class="pull-right">
                <a href="{{route('admin.stores.add')}}" class="btn btn-xs btn-success" style="margin-top: -2px;">+ Add Store</a>
                </span>
            </div>
            <div class="panel-body">
                <table class="table table-bordered table-responsive" id="stores-table" style="width: 100%; display: none; text-align: center; font-family: Tahoma, Helvetica, Arial;">
                    <thead>
                    <tr>
                        <th width="1"></th>
                        <th width="100">Store ID</th>
                        <th>Title</th>
                        <th>Desc</th>
                        <th width="80">Created At</th>
                        <th width="60" style="text-align: center"></th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@stop

@section('header')
<link href="{{asset('assets/plugins/datatables/datatables.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{asset('assets/plugins/datatables/Responsive-2.2.1/css/responsive.bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
@stop

@section('footer')
<script src="{{asset('assets/plugins/datatables/datatables.min.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/plugins/datatables/Responsive-2.2.1/js/responsive.bootstrap.min.js')}}" type="text/javascript"></script>
<script>
M6.storesList();
M6.ajaxStatusChange('stores/AjaxStatusUpdate');
</script>
@stop
