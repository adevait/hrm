@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-lg-3 col-md-4 col-sm-6">
        <a class="nav-box" href="{{route('time.clients.index')}}">
            <h2>{{trans('app.time.clients.main')}}</h2>
        </a>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6">
        <a class="nav-box" href="{{route('time.projects.index')}}">
            <h2>{{trans('app.time.projects.main')}}</h2>
        </a>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6">
        <a class="nav-box" href="{{route('time.time_logs.index')}}">
            <h2>{{trans('app.time.time_logs.main')}}</h2>
        </a>
    </div>
</div>
@endsection