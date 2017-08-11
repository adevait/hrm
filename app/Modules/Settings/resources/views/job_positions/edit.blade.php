@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.settings.job_positions.edit_details')}}</div>
            {!! Form::model($jobPosition, ['method' => 'PUT', 'route' => ['settings.job_positions.update', $jobPosition->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                @include('settings::job_positions._form', ['submitName' => trans('app.submit')])
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection