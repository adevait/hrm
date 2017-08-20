@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <a href="{{route('settings.email_templates.create')}}" class="btn btn-primary pull-right">{{trans('app.settings.email_templates.add_new')}}</a>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="form-group col-sm-2 pull-right">
              <select class="form-control">
                <option></option>
                <option value="email">Send email</option>
              </select>
            </div>
            <div class="custom-panel-heading">{{trans('app.settings.email_templates.main')}}</div>
            <table class="table table-bordered table-hover" id="documentsTable">
                <thead>
                    <th>{{trans('app.id')}}</th>
                    <th>{{trans('app.settings.email_templates.name')}}</th>
                    <th></th>
                    <th></th>
                </thead>
                <tfoot>
                    <th>
                        <input type="text" placeholder="{{trans('app.id')}}"/>
                    </th>
                    <th>
                        <input type="text" placeholder="{{trans('app.settings.email_templates.name')}}"/>
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
            ajax: '{{ route("settings.email_templates.datatable")}}',
            columns: [
                {data: 0, name: 'id'},
                {data: 1, name: 'name'},
                {data: 2, name: 'actions', sortable: false, searchable: false},
                {data: 3, name: 'send_email'}
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