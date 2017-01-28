@foreach($salaryComponents as $component)
<div class="form-group">
    {!! Form::label('components['.$component->id.']', $component->name.':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::text('components['.$component->id.']', null, ['class' => 'form-control']) !!}
    </div>
</div>
@endforeach
<div class="form-group">
    {!! Form::label('payment_date', trans('app.pim.employees.salaries.payment_date').':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::input('date','payment_date', null, ['class' => 'form-control']) !!}
    </div>
</div>
@include('errors._form-errors')
<hr>
<div class="form-group">
    <div class="col-sm-6 col-sm-offset-3">
        <a href="{{route('pim.employees.salaries.index', Route::input('employeeId'))}}" class="btn btn-default">{{trans('app.cancel')}}</a>
        {!! Form::submit($submitName, ['class' => 'btn btn-primary']) !!}
    </div>
</div>