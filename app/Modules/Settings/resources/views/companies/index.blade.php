@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <a href="{{route('settings.companies.create')}}" class="btn btn-primary pull-right">{{trans('app.settings.companies.add_new')}}</a>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.settings.companies.main')}}</div>
            <table class="table table-bordered table-hover" id="companiesTable">
                <thead>
                    <th>{{trans('app.id')}}</th>
                    <th>{{trans('app.settings.companies.name')}}</th>
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
        $('#companiesTable').DataTable({
                "bServerSide": true,
                "bProcessing": true,
                "sAjaxSource": '{{ route("settings.companies.datatable")}}',
                "aoColumns": [
                    { "aaData": "id" },
                    { "aaData": "name" },
                    { "aaData": "actions"}
                ]
        });
    });
</script>
@endsection