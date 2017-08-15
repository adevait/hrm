@extends('layouts.main_employee')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.employee.leaves.details')}}</div>
            <p>
                <b>{{trans('app.leave.employee_leaves.leave')}}:</b>
                {{$leave->leave_type->name}}
            </p>
            <p>
                <b>{{trans('app.leave.employee_leaves.start_date')}}:</b>
                {{$leave->start_date}}
            </p>
            <p>
                <b>{{trans('app.leave.employee_leaves.end_date')}}:</b>
                {{$leave->end_date}}
            </p>
            @if(@$employeeLeave->attachment)
            <p><a href="{{route('storage',$employeeLeave->attachment)}}">{{trans('app.leave.employee_leaves.attachment')}}</a></p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection