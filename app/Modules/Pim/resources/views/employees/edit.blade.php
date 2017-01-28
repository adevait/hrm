@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.pim.employees.edit_details')}}</div>
            {!! Form::model($employee, ['method' => 'PUT', 'route' => ['pim.employees.update', $employee->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                @include('pim::employees._form', ['submitName' => trans('app.submit')])
            {!! Form::close() !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.pim.employees.additional')}}</div>
            <div class="clearfix">
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="nav-box">
                        <h2><a href="{{route('pim.employees.social_media.index', $employee->id)}}">{{trans('app.pim.employees.external_accounts.main')}}</a></h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque vel temporibus sapiente enim tempora dolores excepturi maxime, repellendus, et tenetur fuga eaque nemo, mollitia adipisci veritatis praesentium nisi neque in.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="nav-box">
                        <h2><a href="{{route('pim.employees.contact_details.index', $employee->id)}}">{{trans('app.pim.employees.contact_details.main')}}</a></h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque vel temporibus sapiente enim tempora dolores excepturi maxime, repellendus, et tenetur fuga eaque nemo, mollitia adipisci veritatis praesentium nisi neque in.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="nav-box">
                        <h2><a href="{{route('pim.employees.qualifications.index', $employee->id)}}">{{trans('app.pim.employees.qualifications.main')}}</a></h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque vel temporibus sapiente enim tempora dolores excepturi maxime, repellendus, et tenetur fuga eaque nemo, mollitia adipisci veritatis praesentium nisi neque in.</p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <div class="nav-box">
                        <h2><a href="{{route('pim.employees.salaries.index', $employee->id)}}">{{trans('app.pim.employees.salaries.main')}}</a></h2>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque vel temporibus sapiente enim tempora dolores excepturi maxime, repellendus, et tenetur fuga eaque nemo, mollitia adipisci veritatis praesentium nisi neque in.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection