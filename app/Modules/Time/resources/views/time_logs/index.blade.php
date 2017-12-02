@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <a href="{{route('time.time_logs.create')}}" class="btn btn-primary pull-right">{{trans('app.time.time_logs.add_new')}}</a>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.time.time_logs.main')}}</div>
            <div class="form-group clearfix">
                <form id="date_filter" action="">
                    <div class="col-md-3">
                        <input type="date" class="form-control" id="date_start" placeholder="{{trans('app.time.time_logs.start_date')}}" required/>
                    </div>
                    <div class="col-md-3">
                        <input type="date" class="form-control col-md-3" id="date_end" placeholder="{{trans('app.time.time_logs.end_date')}}" required/>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary">{{trans('app.filter')}}</button>
                    </div>
                </form>
            </div>
            <hr>
            <table class="table table-bordered table-hover" id="timeLogTable">
                <thead>
                    <th>
                        <input type="text" placeholder="{{trans('app.id')}}"/>
                    </th>
                    <th>
                        <input type="text" placeholder="{{trans('app.time.time_logs.task_name')}}"/>
                    </th>
                    <th>
                        {!! Form::select('projects_id', $projects, null, ['placeholder' => trans('app.time.time_logs.project')]) !!}
                    </th>
                    <th>
                        {!! Form::select('user_id', $employees, null, ['placeholder' => trans('app.time.time_logs.employee')]) !!}
                    </th>
                    <th>{{trans('app.time.time_logs.time')}}</th>
                    <th>{{trans('app.time.time_logs.date')}}</th>
                    <th></th>
                </thead>
            </table>
            <hr>
            <h3>{{trans('app.time.time_logs.monthly_summary')}}</h3>
            <table class="monthly-table table-bordered table-hover" id="monthlyLogTable">
                <thead>
                    <th>
                        {!! Form::select('projects_id', $projects, null, ['placeholder' => trans('app.time.time_logs.project')]) !!}
                    </th>
                    <th>
                        {!! Form::select('user_id', $employees, null, ['placeholder' => trans('app.time.time_logs.employee')]) !!}
                    </th>
                    <th>{{trans('app.time.time_logs.time')}}</th>
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
        var table = $('#timeLogTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("time.time_logs.datatable")}}',
            columns: [
                {data: 0, name: 'id'},
                {data: 1, name: 'task_name'},
                {data: 2, name: 'project_id'},
                {data: 3, name: 'user_id'},
                {data: 4, name: 'time', sortable: true, searchable: false},
                {data: 5, name: 'date'},
                {data: 6, name: 'actions', sortable: false, searchable: false}
            ]
        });

        var monthlyTable = $('#monthlyLogTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("time.time_logs.monthly_datatable")}}',
            columns: [
                {data: 0, name: 'project_id'},
                {data: 1, name: 'user_id'},
                {data: 2, name: 'time', sortable: true, searchable: false},
            ]
        });

        var tables = [table, monthlyTable];

        for (var i = 0; i < 2; i++) {
            tables[i].columns().every(function () {
                var that = this;
                $('input', this.header()).on( 'keyup change', function () {
                    if (that.search() !== this.value) {
                        that.search(this.value).draw();
                    }
                });
                $('select', this.header()).on( 'change', function () {
                    if (that.search() !== this.value) {
                        that.search(this.value).draw();
                    }
                });
            });
        };

        $('#date_filter').submit(function() {
            var url = '{{ route("time.time_logs.datatable")}}?date_from='+$('#date_start').val()+'&date_to='+$('#date_end').val();
            table.ajax.url(url);
            table.draw();
            var monthly_url = '{{ route("time.time_logs.monthly_datatable")}}?date_from='+$('#date_start').val()+'&date_to='+$('#date_end').val();
            monthlyTable.ajax.url(monthly_url);
            monthlyTable.draw();
            return false;
        });
    });
</script>
@endsection