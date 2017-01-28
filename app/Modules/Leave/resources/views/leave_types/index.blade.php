@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <a href="{{route('leave.leave_types.create')}}" class="btn btn-primary pull-right">{{trans('app.leave.leave_types.add_new')}}</a>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.leave.leave_types.main')}}</div>
            <table class="table table-bordered table-hover" id="leaveTypesTable">
                <thead>
                    <th>{{trans('app.id')}}</th>
                    <th>{{trans('app.leave.leave_types.name')}}</th>
                    <th>{{trans('app.leave.leave_types.available_days')}}</th>
                    <th>{{trans('app.leave.leave_types.start_date')}}</th>
                    <th>{{trans('app.leave.leave_types.end_date')}}</th>
                    <th></th>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
@section('additionalCSS')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
@endsection
@section('additionalJS')
<script src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function(){
        $('#leaveTypesTable').DataTable({
                "bServerSide": true,
                "bProcessing": true,
                "sAjaxSource": '{{ route("leave.leave_types.datatable")}}',
                "aoColumns": [
                    { "aaData": "id" },
                    { "aaData": "name" },
                    { "aaData": "available_days" },
                    { "aaData": "start_date" },
                    { "aaData": "end_date" },
                    { "aaData": "actions"}
                ]
        });
    });
</script>
@endsection