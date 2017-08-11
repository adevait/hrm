@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.settings.salary_components.edit_details')}}</div>
            {!! Form::model($salaryComponent, ['method' => 'PUT', 'route' => ['settings.salary_components.update', $salaryComponent->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                @include('settings::salary_components._form', ['submitName' => trans('app.submit')])
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection