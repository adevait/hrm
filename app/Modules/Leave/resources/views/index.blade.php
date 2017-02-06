@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-lg-3 col-md-4 col-sm-6">
        <a href="{{route('leave.leave_types.index')}}" class="nav-box">
            <h2>{{trans('app.leave.leave_types.main')}}</h2>
        </a>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6">
        <a href="{{route('leave.employee_leaves.index')}}" class="nav-box">
            <h2>{{trans('app.leave.employee_leaves.main')}}</h2>
        </a>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6">
        <a href="{{route('leave.holidays.index')}}" class="nav-box">
            <h2>{{trans('app.leave.holidays.main')}}</h2>
        </a>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6">
        <a href="{{route('leave.calendar.index')}}" class="nav-box">
            <h2>{{trans('app.leave.calendar.main')}}</h2>
        </a>
    </div>
</div>
@endsection
@section('additionalCSS')
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection