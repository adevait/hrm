@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-lg-3 col-md-4 col-sm-6">
        <a class="nav-box" href="{{route('settings.companies.index')}}">
            <h2>{{trans('app.settings.companies.main')}}</h2>
        </a>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6">
        <a class="nav-box" href="{{route('settings.contract_types.index')}}">
            <h2>{{trans('app.settings.contract_types.main')}}</h2>
        </a>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6">
        <a class="nav-box" href="{{route('settings.document_templates.index')}}">
            <h2>{{trans('app.settings.document_templates.main')}}</h2>
        </a>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6">
        <a class="nav-box" href="{{route('settings.education_institutions.index')}}">
            <h2>{{trans('app.settings.education_institutions.main')}}</h2>
        </a>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6">
        <a class="nav-box" href="{{route('settings.job_positions.index')}}">
            <h2>{{trans('app.settings.job_positions.main')}}</h2>
        </a>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6">
        <a class="nav-box" href="{{route('settings.languages.index')}}">
            <h2>{{trans('app.settings.languages.main')}}</h2>
        </a>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6">
        <a class="nav-box" href="{{route('settings.salary_components.index')}}">
            <h2>{{trans('app.settings.salary_components.main')}}</h2>
        </a>
    </div>
</div>
@endsection