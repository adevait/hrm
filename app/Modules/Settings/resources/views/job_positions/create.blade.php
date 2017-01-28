@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.settings.job_positions.add_new')}}</div>
            {!! Form::open(['route' => 'settings.job_positions.store', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                @include('settings::job_positions._form', ['submitName' => trans('app.submit')])
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection