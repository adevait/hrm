@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.leave.employee_leaves.edit_details')}}</div>
            <div class="row">
                @if(!$employeeLeave->approved)
                <form action="{{route('leave.employee_leaves.approve', $employeeLeave->id)}}" method="POST" class="col-md-6 col-md-offset-3">
                    {{ Form::token() }} 
                    <button type="submit" class="btn btn-success pull-right">{{trans('app.approve')}}</button>
                </form>
                @endif
            </div>
            {!! Form::model($employeeLeave, ['method' => 'PUT', 'route' => ['leave.employee_leaves.update', $employeeLeave->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                @include('leave::employee_leaves._form', ['submitName' => trans('app.submit')])
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection