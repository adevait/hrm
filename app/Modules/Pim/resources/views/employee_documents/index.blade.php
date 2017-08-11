@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <a href="{{route('pim.employees.documents.generate', Route::input('employeeId'))}}" class="btn btn-default pull-left">{{trans('app.pim.employees.documents.generate')}}</a>
        <a href="{{route('pim.employees.documents.create', Route::input('employeeId'))}}" class="btn btn-primary pull-right">{{trans('app.pim.employees.documents.add_new')}}</a>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.pim.employees.documents.main')}}</div>
            <table class="table table-bordered table-hover" id="documentsTable">
                <thead>
                    <th>{{trans('app.id')}}</th>
                    <th>{{trans('app.pim.employees.documents.name')}}</th>
                    <th>{{trans('app.pim.employees.documents.attachment')}}</th>
                    <th></th>
                </thead>
                <tfoot>
                    <th>
                        <input type="text" placeholder="{{trans('app.id')}}"/>
                    </th>
                    <th>
                        <input type="text" placeholder="{{trans('app.pim.employees.documents.name')}}"/>
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
        var table = $('#documentsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("pim.employees.documents.datatable", Route::input("employeeId"))}}',
            columns: [
                {data: 0, name: 'id'},
                {data: 1, name: 'name'},
                {data: 2, name: 'attachment', sortable: false, searchable: false},
                {data: 3, name: 'actions', sortable: false, searchable: false}
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