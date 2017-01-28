@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <a href="{{route('leave.holidays.create')}}" class="btn btn-primary pull-right">{{trans('app.leave.holidays.add_new')}}</a>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.leave.holidays.main')}}</div>
            <table class="table table-bordered table-hover" id="holidaysTable">
                <thead>
                    <th>{{trans('app.id')}}</th>
                    <th>{{trans('app.leave.holidays.name')}}</th>
                    <th>{{trans('app.leave.holidays.date')}}</th>
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
        $('#holidaysTable').DataTable({
                "bServerSide": true,
                "bProcessing": true,
                "sAjaxSource": '{{ route("leave.holidays.datatable")}}',
                "aoColumns": [
                    { "aaData": "id" },
                    { "aaData": "name" },
                    { "aaData": "date" },
                    { "aaData": "actions"}
                ]
        });
    });
</script>
@endsection