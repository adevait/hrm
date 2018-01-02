@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.pim.candidates.edit_details')}}
                <a href="{{route('pim.candidates.feature', $employee->id)}}" title="{{trans('app.pim.candidates.mark_featured_title')}}" class="btn btn-default pull-right"><i style="{{$employee->featured ? 'color: orange' : ''}}" class="glyphicon glyphicon-star" aria-hidden="true"></i></a>
            </div>
            {!! Form::model($employee, ['method' => 'PUT', 'route' => ['pim.candidates.update', $employee->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                @include('pim::candidates._form', ['submitName' => trans('app.submit')])
            {!! Form::close() !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.pim.candidates.additional')}}</div>
            <div class="clearfix">
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a class="nav-box" href="{{route('pim.employees.social_media.index', $employee->id)}}">
                        <h2>{{trans('app.pim.employees.external_accounts.main')}}</h2>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a class="nav-box" href="{{route('pim.employees.documents.index', $employee->id)}}">
                        <h2>{{trans('app.pim.employees.documents.main')}}</h2>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a class="nav-box" href="{{route('pim.employees.contact_details.index', $employee->id)}}">
                        <h2>{{trans('app.pim.employees.contact_details.main')}}</h2>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a class="nav-box" href="{{route('pim.employees.qualifications.index', $employee->id)}}">
                        <h2>{{trans('app.pim.employees.qualifications.main')}}</h2>
                    </a>
                </div>
                <div class="col-lg-3 col-md-4 col-sm-6">
                    <a class="nav-box" href="{{route('pim.employees.preferences.index', $employee->id)}}">
                        <h2>{{trans('app.pim.candidates.preferences.main')}}</h2>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection