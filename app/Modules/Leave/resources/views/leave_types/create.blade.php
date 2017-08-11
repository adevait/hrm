@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.leave.leave_types.add_new')}}</div>
            {!! Form::open(['route' => 'leave.leave_types.store', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                @include('leave::leave_types._form', ['submitName' => trans('app.submit')])
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection