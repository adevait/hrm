<div class="form-group">
    {!! Form::label('language_id', trans('app.pim.employees.qualifications.languages.language').': ', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::select('language_id', $languages, null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('skill', trans('app.pim.employees.qualifications.languages.skill').': ', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::select('skill', language_skills(), null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('level', trans('app.pim.employees.qualifications.languages.level').': ', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::select('level', language_levels(), null, ['class' => 'form-control']) !!}
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