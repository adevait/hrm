@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <a href="{{route('pim.employees.create')}}" class="btn btn-primary pull-right">{{trans('app.pim.employees.add_new')}}</a>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.pim.employees.main')}}</div>
            <table class="table table-bordered table-hover" id="employeesTable">
                <thead>
                    <th>{{trans('app.id')}}</th>
                    <th>{{trans('app.pim.employees.first_name')}}</th>
                    <th>{{trans('app.pim.employees.last_name')}}</th>
                    <th>{{trans('app.pim.employees.email')}}</th>
                    <th>{{trans('app.pim.employees.job_title')}}</th>
                    <th>{{trans('app.pim.employees.contract_type')}}</th>
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
        
        var table = $('#employeesTable').DataTable({
                "bServerSide": true,
                "bProcessing": true,
                "sAjaxSource": '{{ route("pim.employees.datatable")}}',
                "aoColumns": [
                    { "aaData": "id" },
                    { "aaData": "first_name" },
                    { "aaData": "last_name" },
                    { "aaData": "email" },
                    { "aaData": "job_title" },
                    { "aaData": "employment_status" },
                    { "aaData": "actions"}
                ]
        });
    });
</script>
@endsection