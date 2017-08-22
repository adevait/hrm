@extends('layouts.main_employee')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.pim.employees.documents.main')}}</div>
            <table class="table table-bordered table-hover" id="documentsTable">
                <thead>
                    <th>{{trans('app.pim.employees.documents.name')}}</th>
                    <th>{{trans('app.pim.employees.documents.attachment')}}</th>
                    <th>{{trans('app.pim.employees.documents.description')}}</th>
                    <th></th>
                </thead>
                <tfoot>
                    <th>
                        <input type="text" placeholder="{{trans('app.pim.employees.documents.name')}}"/>
                    </th>
                    <th></th>
                    <th>
                        <input type="text" placeholder="{{trans('app.pim.employees.documents.description')}}"/>
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
        var table = $('#documentsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("employee.documents.datatable", Route::input("employeeId"))}}',
            columns: [
                {data: 1, name: 'name'},
                {data: 2, name: 'attachment', sortable: false, searchable: false},
                {data: 3, name: 'description', sortable: false},
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

        $('#documentsTable').removeClass('dataTable');
    });
</script>
@endsection