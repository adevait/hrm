@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.discipline.disciplinary_cases.add_new')}}</div>
            {!! Form::open(['route' => 'discipline.disciplinary_cases.store', 'class' => 'form-horizontal']) !!}
                @include('discipline::disciplinary_cases._form', ['submitName' => trans('app.submit')])
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection