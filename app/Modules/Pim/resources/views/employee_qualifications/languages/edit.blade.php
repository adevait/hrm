@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.pim.employees.qualifications.languages.edit_details')}}</div>
            {!! Form::model($language, ['method' => 'PUT', 'route' => ['pim.employees.qualifications.languages.update', Route::input('employeeId'), $language->id], 'class' => 'form-horizontal']) !!}
                @include('pim::employee_qualifications.languages._form', ['submitName' => trans('app.submit')])
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection