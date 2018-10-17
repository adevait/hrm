@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.time.time_logs.edit_details')}}</div>
            {!! Form::model($timeLog, ['method' => 'PUT', 'route' => ['time.time_logs.update', $timeLog->id], 'class' => 'form-horizontal']) !!}
                @include('time::time_logs._form', ['submitName' => trans('app.submit'), 'defaultDate' => null])
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection