@extends('layouts.main_employee')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.leave.employee_leaves.edit_details')}}</div>
            {!! Form::model($employeeLeave, ['method' => 'PUT', 'route' => ['employee.leaves.update', $employeeLeave->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                @include('employee.leaves::_form', ['submitName' => trans('app.submit')])
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection