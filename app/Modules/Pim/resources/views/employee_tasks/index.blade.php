@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <a href="{{route('pim.employees.tasks.create', Route::input('employeeId'))}}" class="btn btn-primary pull-right">{{trans('app.pim.candidates.tasks.add_new')}}</a>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.pim.candidates.tasks.main')}}</div>
            <table class="table table-bordered table-hover" id="employeesTasksTable">
                <thead>
                    <th>{{trans('app.id')}}</th>
                    <th>{{trans('app.pim.candidates.tasks.name')}}</th>
                    <th>{{trans('app.pim.candidates.tasks.description')}}</th>
                    <th>{{trans('app.pim.candidates.tasks.assigned_to')}}</th>
                    <th>{{trans('app.pim.candidates.tasks.creator')}}</th>
                    <th>{{trans('app.pim.candidates.tasks.due_date')}}</th>
                    <th></th>
                </thead>
                <tfoot>
                    <th>
                        <input type="text" placeholder="{{trans('app.id')}}"/>
                    </th>
                    <th>
                        <input type="text" placeholder="{{trans('app.pim.candidates.tasks.name')}}"/>
                    </th>
                    <th>
                        <input type="text" placeholder="{{trans('app.pim.candidates.tasks.description')}}"/>
                    </th>
                    <th></th>
                    <th></th>
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
        var table = $('#employeesTasksTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("pim.employees.tasks.datatable", Route::input("employeeId"))}}',
            columns: [
                {data: 0, name: 'id'},
                {data: 1, name: 'task_name'},
                {data: 2, name: 'task_description'},
                {data: 3, name: 'assigned_to'},
                {data: 4, name: 'creator_id'},
                {data: 5, name: 'due_date'},
                {data: 6, name: 'actions', sortable: false, searchable: false}
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