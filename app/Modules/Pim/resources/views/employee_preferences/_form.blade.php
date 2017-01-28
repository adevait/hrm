<div class="form-group">
    {!! Form::label('salary', trans('app.pim.candidates.preferences.salary').':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::number('salary', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('contract_type_id', trans('app.pim.candidates.preferences.contract_type').':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::select('contract_type_id', $contractTypes , null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('location', trans('app.pim.candidates.preferences.location.main').':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::select('location', locations(), null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('comments', trans('app.pim.candidates.preferences.comments').':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::textarea('comments', null, ['class' => 'form-control']) !!}
    </div>
</div>
@include('errors._form-errors')
<hr>
<div class="form-group">
    <div class="col-sm-6 col-sm-offset-3">
        <a href="{{route('pim.candidates.edit', Route::input('employeeId'))}}" class="btn btn-default">{{trans('app.cancel')}}</a>
        {!! Form::submit($submitName, ['class' => 'btn btn-primary']) !!}
    </div>
</div>