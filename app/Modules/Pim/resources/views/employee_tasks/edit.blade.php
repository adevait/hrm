@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.pim.candidates.tasks.main')}}</div>
            {!! Form::model($task, ['method' => 'PUT', 'route' => ['pim.employees.tasks.update', Route::input('employeeId'), $task->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                @include('pim::employee_tasks._form', ['submitName' => trans('app.submit')])
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection