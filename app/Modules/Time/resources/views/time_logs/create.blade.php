@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.time.time_logs.add_new')}}</div>
            {!! Form::open(['route' => 'time.time_logs.store', 'class' => 'form-horizontal']) !!}
                @include('time::time_logs._form', ['submitName' => trans('app.submit')])
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection