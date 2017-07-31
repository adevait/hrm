@extends('layouts.main_employee')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.time.time_logs.add_new')}}</div>
            {!! Form::open(['route' => 'employee.time.store', 'class' => 'form-horizontal']) !!}
                @include('employee.time::_form', ['submitName' => trans('app.submit')])
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection