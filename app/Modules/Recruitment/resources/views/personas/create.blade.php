@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.recruitment.personas.add_new')}}</div>
            {!! Form::open(['route' => 'recruitment.personas.store', 'class' => 'form-horizontal']) !!}
                @include('recruitment::personas._form', ['submitName' => trans('app.submit')])
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection