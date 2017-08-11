@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.pim.employees.qualifications.education.edit_details')}}</div>
            {!! Form::model($education, ['method' => 'PUT', 'route' => ['pim.employees.qualifications.education.update', Route::input('employeeId'), $education->id], 'class' => 'form-horizontal']) !!}
                @include('pim::employee_qualifications.education._form', ['submitName' => trans('app.submit')])
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection