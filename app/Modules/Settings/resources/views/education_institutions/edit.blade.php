@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.settings.education_institutions.edit_details')}}</div>
            {!! Form::model($educationInstitution, ['method' => 'PUT', 'route' => ['settings.education_institutions.update', $educationInstitution->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                @include('settings::education_institutions._form', ['submitName' => trans('app.submit')])
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection