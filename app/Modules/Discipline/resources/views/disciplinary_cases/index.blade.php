@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <a href="{{route('discipline.disciplinary_cases.create')}}" class="btn btn-primary pull-right">{{trans('app.discipline.disciplinary_cases.add_new')}}</a>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.discipline.disciplinary_cases.main')}}</div>
            <table class="table table-bordered table-hover" id="disciplinaryCasesTable">
                <thead>
                    <th>{{trans('app.id')}}</th>
                    <th>{{trans('app.discipline.disciplinary_cases.employee')}}</th>
                    <th>{{trans('app.discipline.disciplinary_cases.name')}}</th>
                    <th>{{trans('app.discipline.disciplinary_cases.description')}}</th>
                    <th></th>
                </thead>
                <tfoot>
                    <th>
                        <input type="text" placeholder="{{trans('app.id')}}"/>
                    </th>
                    <th>
                        {{Form::select('user_id', $employees, null, ['placeholder' => trans('app.discipline.disciplinary_cases.employee')])}}
                    </th>
                    <th>
                        <input type="text" placeholder="{{trans('app.discipline.disciplinary_cases.name')}}"/>
                    </th>
                    <th>
                        <input type="text" placeholder="{{trans('app.discipline.disciplinary_cases.description')}}"/>
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

        var table = $('#disciplinaryCasesTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("discipline.disciplinary_cases.datatable")}}',
            columns: [
                {data: 0, name: 'id'},
                {data: 1, name: 'user_id'},
                {data: 2, name: 'name'},
                {data: 3, name: 'description'},
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
            $('select', this.footer()).on( 'change', function () {
                if (that.search() !== this.value) {
                    that.search(this.value).draw();
                }
            });
        });
    });
</script>
@endsection