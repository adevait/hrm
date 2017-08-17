@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.settings.email_templates.add_new')}}</div>
            {!! Form::open(['route' => 'settings.email_templates.store', 'class' => 'form-horizontal']) !!}
                @include('settings::email_templates._form', ['submitName' => trans('app.submit')])
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection