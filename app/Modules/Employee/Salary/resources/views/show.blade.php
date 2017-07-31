@extends('layouts.main_employee')
@section('content')
<form class="form-horizontal">
@foreach($salaryComponents as $key => $component)
<div class="form-group">
    {!! Form::label('components['.$component->id.']', $component->name.':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-5">
        {!! Form::text('components['.$component->id.']', $salary->components[$key++], ['class' => 'form-control', 'readonly']) !!}
    </div>
</div> 
@endforeach
<div class="form-group">
    {!! Form::label('payment_date', trans('app.pim.employees.salaries.payment_date').':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-5">
        {!! Form::input('date','payment_date', $salary->payment_date, ['class' => 'form-control', 'readonly']) !!}
    </div>
</div>
</form>
@endsection
@section('additionalCSS')
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection