@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <a href="{{route('pim.employees.salaries.create', Route::input('employeeId'))}}" class="btn btn-primary pull-right">{{trans('app.pim.employees.salaries.add_new')}}</a>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.pim.employees.salaries.salary_history')}}</div>
            <table class="table table-bordered table-hover" id="salariesTable">
                <thead>
                    <th>{{trans('app.id')}}</th>
                    <th>{{trans('app.pim.employees.salaries.gross_total')}}</th>
                    <th>{{trans('app.pim.employees.salaries.nett_total')}}</th>
                    <th>{{trans('app.pim.employees.salaries.payment_date')}}</th>
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
        $('#salariesTable').DataTable({
                "bServerSide": true,
                "bProcessing": true,
                "sAjaxSource": '{{ route("pim.employees.salaries.datatable", Route::input("employeeId"))}}',
                "aoColumns": [
                    { "aaData": "id" },
                    { "aaData": "gross_total" },
                    { "aaData": "nett_total" },
                    { "aaData": "payment_date" },
                    { "aaData": "actions"}
                ]
        });
    });
</script>
@endsection