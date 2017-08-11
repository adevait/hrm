@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.leave.holidays.edit_details')}}</div>
            {!! Form::model($holiday, ['method' => 'PUT', 'route' => ['leave.holidays.update', $holiday->id], 'class' => 'form-horizontal']) !!}
                @include('leave::holidays._form', ['submitName' => trans('app.submit')])
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection