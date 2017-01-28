<div class="form-group">
    {!! Form::label('company_id', trans('app.pim.employees.qualifications.work_experience.company_name').': ', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::select('company_id', $companies, null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('job_title', trans('app.pim.employees.qualifications.work_experience.job_title').': ', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::text('job_title', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('start_date', trans('app.pim.employees.qualifications.work_experience.start_date').': ', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::input('date', 'start_date', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('end_date', trans('app.pim.employees.qualifications.work_experience.end_date').': ', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::input('date', 'end_date', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('comment', trans('app.pim.employees.qualifications.work_experience.comments').': ', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::textarea('comment', null, ['class' => 'form-control']) !!}
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