@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.settings.contract_types.edit_details')}}</div>
            {!! Form::model($contractType, ['method' => 'PUT', 'route' => ['settings.contract_types.update', $contractType->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                @include('settings::contract_types._form', ['submitName' => trans('app.submit')])
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection