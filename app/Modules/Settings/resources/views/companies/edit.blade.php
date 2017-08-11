@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.settings.companies.edit_details')}}</div>
            {!! Form::model($company, ['method' => 'PUT', 'route' => ['settings.companies.update', $company->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                @include('settings::companies._form', ['submitName' => trans('app.submit')])
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection