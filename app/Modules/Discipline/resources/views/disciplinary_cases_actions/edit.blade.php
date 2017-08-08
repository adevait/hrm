@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.discipline.disciplinary_cases.edit_details')}}</div>
            {!! Form::model($disciplinary_case_action, ['method' => 'PUT', 'route' => ['discipline.disciplinary_cases_actions.update', $disciplinary_case_action->id], 'class' => 'form-horizontal']) !!}
                @include('discipline::disciplinary_cases_actions._form', ['submitName' => trans('app.submit')])
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection