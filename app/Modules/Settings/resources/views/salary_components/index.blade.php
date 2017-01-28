@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <a href="{{route('settings.salary_components.create')}}" class="btn btn-primary pull-right">{{trans('app.settings.salary_components.add_new')}}</a>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.settings.salary_components.main')}}</div>
            <table class="table table-bordered table-hover" id="positionsTable">
                <thead>
                    <th>{{trans('app.id')}}</th>
                    <th>{{trans('app.settings.salary_components.name')}}</th>
                    <th>{{trans('app.settings.salary_components.contract_type')}}</th>
                    <th>{{trans('app.settings.salary_components.type')}}</th>
                    <th>{{trans('app.settings.salary_components.is_cost')}}</th>
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
        $('#positionsTable').DataTable({
                "bServerSide": true,
                "bProcessing": true,
                "sAjaxSource": '{{ route("settings.salary_components.datatable")}}',
                "aoColumns": [
                    { "aaData": "id" },
                    { "aaData": "name" },
                    { "aaData": "contract_type" },
                    { "aaData": "type" },
                    { "aaData": "is_cost" },
                    { "aaData": "actions"}
                ]
        });
    });
</script>
@endsection