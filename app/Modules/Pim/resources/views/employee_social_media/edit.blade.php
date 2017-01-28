@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.pim.employees.external_accounts.edit_details')}}</div>
            {!! Form::model($account, ['method' => 'PUT', 'route' => ['pim.employees.social_media.update', Route::input('employeeId'), $account->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                @include('pim::employee_social_media._form', ['submitName' => trans('app.submit')])
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection