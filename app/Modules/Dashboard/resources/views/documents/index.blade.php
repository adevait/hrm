@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <a href="{{route('dashboard.documents.create')}}" class="btn btn-primary pull-right">{{trans('app.dashboard.documents.add_new')}}</a>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.dashboard.documents.main')}}</div>
            <table class="table table-bordered table-hover" id="dashboardDocumentsTable">
                <thead>
                    <th>{{trans('app.id')}}</th>
                    <th>{{trans('app.dashboard.documents.name')}}</th>
                    <th></th>
                </thead>
                <tfoot>
                    <th>
                        <input type="text" placeholder="{{trans('app.id')}}"/>
                    </th>
                    <th>
                        <input type="text" placeholder="{{trans('app.dashboard.documents.name')}}"/>
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

        var table = $('#dashboardDocumentsTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("dashboard.documents.datatable")}}',
            columns: [
                {data: 0, name: 'id'},
                {data: 1, name: 'name'},
                {data: 2, name: 'actions', sortable: false, searchable: false}
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

        $('#dashboardDocumentsTable').removeClass('dataTable');
    });
</script>
@endsection