@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-lg-3 col-md-4 col-sm-6">
        <a href="{{route('recruitment.reports.index')}}" class="nav-box">
            <h2>{{trans('app.recruitment.reports.main')}}</h2>
        </a>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6">
        <a href="{{route('recruitment.job_advert.index')}}" class="nav-box">
            <h2>{{trans('app.recruitment.job_advert.main')}}</h2>
        </a>
    </div>
</div>
@endsection