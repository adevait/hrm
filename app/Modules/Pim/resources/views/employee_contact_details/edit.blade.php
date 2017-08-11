@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.pim.employees.contact_details.edit_details')}}</div>
            {!! Form::model($contactDetails, ['method' => 'PUT', 'route' => ['pim.employees.contact_details.update', Route::input('employeeId'), $contactDetails->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                @include('pim::employee_contact_details._form', ['submitName' => trans('app.submit')])
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection