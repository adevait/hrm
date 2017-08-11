<div class="form-group">
    {!! Form::label('type', trans('app.pim.employees.qualifications.education.type').': ', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::select('type', education_types(), null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('education_institution_id', trans('app.pim.employees.qualifications.education.institution').': ', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::select('education_institution_id', $institutions, null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('major', trans('app.pim.employees.qualifications.education.major').': ', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::text('major', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('year', trans('app.pim.employees.qualifications.education.year').': ', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::input('number', 'year', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('grade', trans('app.pim.employees.qualifications.education.grade').': ', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::input('number', 'grade', null, ['class' => 'form-control', 'min' => 1.0, 'max' => 10.0, 'step' => '0.1']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('start_date', trans('app.pim.employees.qualifications.education.start_date').': ', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::input('date', 'start_date', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('end_date', trans('app.pim.employees.qualifications.education.end_date').': ', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::input('date', 'end_date', null, ['class' => 'form-control']) !!}
    </div>
</div>
@include('errors._form-errors')
<hr>
<div class="form-group">
    <div class="col-sm-6 col-sm-offset-3">
        <a href="{{route('pim.employees.qualifications.index', Route::input('employeeId'))}}" class="btn btn-default">{{trans('app.cancel')}}</a>
        {!! Form::submit($submitName, ['class' => 'btn btn-primary']) !!}
    </div>
</div>