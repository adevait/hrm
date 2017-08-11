@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <a href="{{route('leave.leave_types.create')}}" class="btn btn-primary pull-right">{{trans('app.leave.leave_types.add_new')}}</a>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.leave.leave_types.main')}}</div>
            <table class="table table-bordered table-hover" id="leaveTypesTable">
                <thead>
                    <th>{{trans('app.id')}}</th>
                    <th>{{trans('app.leave.leave_types.name')}}</th>
                    <th>{{trans('app.leave.leave_types.available_days')}}</th>
                    <th>{{trans('app.leave.leave_types.start_date')}}</th>
                    <th>{{trans('app.leave.leave_types.end_date')}}</th>
                    <th></th>
                </thead>
                <tfoot>
                    <th>
                        <input type="text" placeholder="{{trans('app.id')}}"/>
                    </th>
                    <th>
                        <input type="text" placeholder="{{trans('app.leave.leave_types.name')}}"/>
                    </th>
                    <th></th>
                    <th>
                        <input type="date" placeholder="{{trans('app.leave.leave_types.start_date')}}"/>
                    </th>
                    <th>
                        <input type="date" placeholder="{{trans('app.leave.leave_types.end_date')}}"/>
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
        var table = $('#leaveTypesTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("leave.leave_types.datatable")}}',
            columns: [
                {data: 0, name: 'id'},
                {data: 1, name: 'name'},
                {data: 2, name: 'available_days', sortable: false, searchable: false},
                {data: 3, name: 'start_date'},
                {data: 4, name: 'end_date'},
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
        });
    });
</script>
@endsection