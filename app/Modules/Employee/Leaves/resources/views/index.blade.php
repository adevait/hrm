@extends('layouts.main_employee')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <a href="{{route('employee.leaves.create')}}" class="btn btn-primary pull-right">{{trans('app.employee.leaves.request')}}</a>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.leave.employee_leaves.main')}}</div>
            <table class="table table-bordered table-hover" id="employeeLeavesTable">
                <thead>
                    <th>{{trans('app.id')}}</th>
                    <th>{{trans('app.leave.employee_leaves.leave')}}</th>
                    <th>{{trans('app.leave.employee_leaves.start_date')}}</th>
                    <th>{{trans('app.leave.employee_leaves.end_date')}}</th>
                    <th>{{trans('app.status')}}</th>
                    <th></th>
                </thead>
                <tfoot>
                    <th>
                        <input type="text" placeholder="{{trans('app.id')}}"/>
                    </th>
                    <th>
                        {!! Form::select('leave_type_id', $leaveTypes, null, ['placeholder' => trans('app.leave.employee_leaves.leave')]) !!}
                    </th>
                    <th>
                        <input type="date" placeholder="{{trans('app.leave.employee_leaves.start_date')}}"/>
                    </th>
                    <th>
                        <input type="date" placeholder="{{trans('app.leave.employee_leaves.end_date')}}"/>
                    </th>
                    <th></th>
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
        var table = $('#employeeLeavesTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("employee.leaves.datatable")}}',
            columns: [
                {data: 0, name: 'id'},
                {data: 1, name: 'leave_type_id'},
                {data: 2, name: 'start_date'},
                {data: 3, name: 'end_date'},
                {data: 4, name: 'approved'},
                {data: 5, name: 'actions', sortable: false, searchable: false}
            ]
        });
        table.columns().every(function () {
            var that = this;
            $('input', this.footer()).on( 'keyup change', function () {
                if (that.search() !== this.value) {
                    that.search(this.value).draw();
                }
            });
            $('select', this.footer()).on( 'change', function () {
                if (that.search() !== this.value) {
                    that.search(this.value).draw();
                }
            });
        });
    });
</script>
@endsection