@extends('layouts.main_employee')
@section('content')
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
                <tfoot>
                    <th>
                        <input type="text" placeholder="{{trans('app.id')}}"/>
                    </th>
                    <th>
                        <input type="text" placeholder="{{trans('app.pim.employees.salaries.gross_total')}}"/>
                    </th>
                    <th>
                        <input type="text" placeholder="{{trans('app.pim.employees.salaries.nett_total')}}"/>
                    </th>
                    <th>
                        <input type="date" placeholder="{{trans('app.pim.employees.salaries.payment_date')}}"/>
                    </th>
                    <th></th>
                </tfoot>
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
        var table = $('#salariesTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("employee.salary.datatable")}}',
            columns: [
                {data: 0, name: 'id'},
                {data: 1, name: 'gross_total'},
                {data: 2, name: 'nett_total'},
                {data: 3, name: 'payment_date'},
                {data: 4, name: 'actions', sortable: false, searchable: false}
            ]
        });
        table.columns().every(function () {
            var that = this;
            $('input', this.footer()).on( 'keyup change', function () {
                if (that.search() !== this.value) {
                    that.search(this.value).draw();
                }
            });
        });
    });
</script>
@endsection