@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.settings.salary_components.add_new')}}</div>
            {!! Form::open(['route' => 'settings.salary_components.store', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                @include('settings::salary_components._form', ['submitName' => trans('app.submit')])
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection