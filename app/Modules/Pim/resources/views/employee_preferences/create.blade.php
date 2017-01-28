@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.pim.candidates.preferences.add_new')}}</div>
            {!! Form::open(['route' => ['pim.employees.preferences.store', Route::input('employeeId')], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                @include('pim::employee_preferences._form', ['submitName' => trans('app.submit')])
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection