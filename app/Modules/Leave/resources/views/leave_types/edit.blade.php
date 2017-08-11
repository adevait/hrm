@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.leave.leave_types.edit_details')}}</div>
            {!! Form::model($leave_type, ['method' => 'PUT', 'route' => ['leave.leave_types.update', $leave_type->id], 'class' => 'form-horizontal']) !!}
                @include('leave::leave_types._form', ['submitName' => trans('app.submit')])
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection