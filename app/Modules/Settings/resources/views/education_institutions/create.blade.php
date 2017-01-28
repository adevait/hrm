@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.settings.education_institutions.add_new')}}</div>
            {!! Form::open(['route' => 'settings.education_institutions.store', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                @include('settings::education_institutions._form', ['submitName' => trans('app.submit')])
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection