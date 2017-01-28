@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="nav-box">
            <h2><a href="{{route('leave.leave_types.index')}}">{{trans('app.leave.leave_types.main')}}</a></h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque vel temporibus sapiente enim tempora dolores excepturi maxime, repellendus, et tenetur fuga eaque nemo, mollitia adipisci veritatis praesentium nisi neque in.</p>
        </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="nav-box">
            <h2><a href="{{route('leave.employee_leaves.index')}}">{{trans('app.leave.employee_leaves.main')}}</a></h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque vel temporibus sapiente enim tempora dolores excepturi maxime, repellendus, et tenetur fuga eaque nemo, mollitia adipisci veritatis praesentium nisi neque in.</p>
        </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="nav-box">
            <h2><a href="{{route('leave.holidays.index')}}">{{trans('app.leave.holidays.main')}}</a></h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque vel temporibus sapiente enim tempora dolores excepturi maxime, repellendus, et tenetur fuga eaque nemo, mollitia adipisci veritatis praesentium nisi neque in.</p>
        </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="nav-box">
            <h2><a href="{{route('leave.calendar.index')}}">{{trans('app.leave.calendar.main')}}</a></h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque vel temporibus sapiente enim tempora dolores excepturi maxime, repellendus, et tenetur fuga eaque nemo, mollitia adipisci veritatis praesentium nisi neque in.</p>
        </div>
    </div>
</div>
@endsection