@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <a href="{{route('pim.candidates.create')}}" class="btn btn-primary pull-right">{{trans('app.pim.candidates.add_new')}}</a>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.pim.candidates.main')}}</div>
            <table class="table table-bordered table-hover" id="employeesTable">
                <thead>
                    <th>{{trans('app.id')}}</th>
                    <th>{{trans('app.pim.employees.first_name')}}</th>
                    <th>{{trans('app.pim.employees.last_name')}}</th>
                    <th>{{trans('app.pim.employees.email')}}</th>
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
                "sAjaxSource": '{{ route("pim.candidates.datatable")}}',
                "aoColumns": [
                    { "aaData": "id" },
                    { "aaData": "first_name" },
                    { "aaData": "last_name" },
                    { "aaData": "email" },
                    { "aaData": "actions"}
                ]
        });
    });
</script>
@endsection