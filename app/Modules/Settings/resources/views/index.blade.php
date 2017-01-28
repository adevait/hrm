@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="nav-box">
            <h2><a href="{{route('settings.companies.index')}}">{{trans('app.settings.companies.main')}}</a></h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque vel temporibus sapiente enim tempora dolores excepturi maxime, repellendus, et tenetur fuga eaque nemo, mollitia adipisci veritatis praesentium nisi neque in.</p>
        </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="nav-box">
            <h2><a href="{{route('settings.contract_types.index')}}">{{trans('app.settings.contract_types.main')}}</a></h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque vel temporibus sapiente enim tempora dolores excepturi maxime, repellendus, et tenetur fuga eaque nemo, mollitia adipisci veritatis praesentium nisi neque in.</p>
        </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="nav-box">
            <h2><a href="{{route('settings.education_institutions.index')}}">{{trans('app.settings.education_institutions.main')}}</a></h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque vel temporibus sapiente enim tempora dolores excepturi maxime, repellendus, et tenetur fuga eaque nemo, mollitia adipisci veritatis praesentium nisi neque in.</p>
        </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="nav-box">
            <h2><a href="{{route('settings.job_positions.index')}}">{{trans('app.settings.job_positions.main')}}</a></h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque vel temporibus sapiente enim tempora dolores excepturi maxime, repellendus, et tenetur fuga eaque nemo, mollitia adipisci veritatis praesentium nisi neque in.</p>
        </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="nav-box">
            <h2><a href="{{route('settings.languages.index')}}">{{trans('app.settings.languages.main')}}</a></h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque vel temporibus sapiente enim tempora dolores excepturi maxime, repellendus, et tenetur fuga eaque nemo, mollitia adipisci veritatis praesentium nisi neque in.</p>
        </div>
    </div>
    <div class="col-lg-3 col-md-4 col-sm-6">
        <div class="nav-box">
            <h2><a href="{{route('settings.salary_components.index')}}">{{trans('app.settings.salary_components.main')}}</a></h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque vel temporibus sapiente enim tempora dolores excepturi maxime, repellendus, et tenetur fuga eaque nemo, mollitia adipisci veritatis praesentium nisi neque in.</p>
        </div>
    </div>
</div>
@endsection