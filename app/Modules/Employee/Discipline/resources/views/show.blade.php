@extends('layouts.main_employee')
@section('content')
<form class="form-horizontal">
<div class="form-group">
    {!! Form::label('name', trans('app.discipline.disciplinary_cases.name'), ['class' => 'col-sm-3']) !!}
    <div class="col-sm-5">
        {!! Form::text($disciplinaryCase->id, $disciplinaryCase->name, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div> 
<div class="form-group">
    {!! Form::label('description', trans('app.discipline.disciplinary_cases.description'), ['class' => 'col-sm-3']) !!}
    <div class="col-sm-5">
        {!! Form::textarea($disciplinaryCase->id, $disciplinaryCase->description, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>
</form>
@endsection
@section('additionalCSS')
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection