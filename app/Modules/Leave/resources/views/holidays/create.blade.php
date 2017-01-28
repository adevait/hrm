@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.leave.holidays.add_new')}}</div>
            {!! Form::open(['route' => 'leave.holidays.store', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                @include('leave::holidays._form', ['submitName' => trans('app.submit')])
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection