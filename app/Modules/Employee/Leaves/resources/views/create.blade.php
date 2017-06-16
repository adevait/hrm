@extends('layouts.main_employee')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.leave.employee_leaves.add_new')}}</div>
            {!! Form::open(['route' => 'employee.leaves.store', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                @include('employee.leaves::_form', ['submitName' => trans('app.submit')])
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection