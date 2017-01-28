@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <a href="{{route('leave.employee_leaves.create')}}" class="btn btn-primary pull-right">{{trans('app.leave.employee_leaves.add_new')}}</a>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.leave.employee_leaves.main')}}</div>
            <table class="table table-bordered table-hover" id="employeeLeavesTable">
                <thead>
                    <th>{{trans('app.id')}}</th>
                    <th>{{trans('app.leave.employee_leaves.employee')}}</th>
                    <th>{{trans('app.leave.employee_leaves.leave')}}</th>
                    <th>{{trans('app.leave.employee_leaves.start_date')}}</th>
                    <th>{{trans('app.leave.employee_leaves.end_date')}}</th>
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
        $('#employeeLeavesTable').DataTable({
                "bServerSide": true,
                "bProcessing": true,
                "sAjaxSource": '{{ route("leave.employee_leaves.datatable")}}',
                "aoColumns": [
                    { "aaData": "id" },
                    { "aaData": "employee" },
                    { "aaData": "leave" },
                    { "aaData": "start_date" },
                    { "aaData": "end_date" },
                    { "aaData": "actions"}
                ]
        });
    });
</script>
@endsection