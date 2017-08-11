@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.leave.employee_leaves.add_new')}}</div>
            {!! Form::open(['route' => 'leave.employee_leaves.store', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                @include('leave::employee_leaves._form', ['submitName' => trans('app.submit')])
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection