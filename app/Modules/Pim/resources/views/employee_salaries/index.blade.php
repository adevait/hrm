@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <a href="{{route('pim.employees.salaries.create', Route::input('employeeId'))}}" class="btn btn-primary pull-right">{{trans('app.pim.employees.salaries.add_new')}}</a>
        <a href="#salaryConfig" data-toggle="modal" data-target="#salaryConfig" class="btn btn-default pull-right">{{trans('app.pim.employees.salaries.salary_setup')}}</a>
    </div>
</div>
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
<div id="salaryConfig" class="modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            {!! Form::model($currentSalary, ['method' => 'POST', 'route' => ['pim.employees.salaries.config_salary', Route::input('employeeId')], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{trans('app.pim.employees.salaries.salary_setup')}}</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        {!! Form::label('bank_account', trans('app.pim.employees.salaries.config.bank_account'), ['class' => 'col-sm-3']) !!}
                        <div class="col-sm-6">
                            {!! Form::text('bank_account', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('id_number', trans('app.pim.employees.salaries.config.id_number'), ['class' => 'col-sm-3']) !!}
                        <div class="col-sm-6">
                            {!! Form::text('id_number', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('amount', trans('app.pim.employees.salaries.config.amount'), ['class' => 'col-sm-3']) !!}
                        <div class="col-sm-6">
                            {!! Form::text('amount', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('currency_id', trans('app.pim.employees.salaries.config.currency'), ['class' => 'col-sm-3']) !!}
                        <div class="col-sm-6">
                            {!! Form::select('currency_id', $currencies, null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="form-group">
                        {!! Form::label('type', trans('app.pim.employees.salaries.config.type'), ['class' => 'col-sm-3']) !!}
                        <div class="col-sm-6">
                            {!! Form::select('type', $types, null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">{{trans('app.save')}}</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('app.close')}}</button>
                </div>
            {!! Form::close() !!}
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
            ajax: '{{ route("pim.employees.salaries.datatable", Route::input("employeeId"))}}',
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