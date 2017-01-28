<div class="form-group">
    {!! Form::label('type', trans('app.pim.employees.external_accounts.account_type').':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::select('type', account_types(), null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('url', trans('app.pim.employees.external_accounts.url').':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::text('url', null, ['class' => 'form-control']) !!}
    </div>
</div>
@include('errors._form-errors')
<hr>
<div class="form-group">
    <div class="col-sm-6 col-sm-offset-3">
        <a href="{{route('pim.employees.social_media.index', Route::input('employeeId'))}}" class="btn btn-default">{{trans('app.cancel')}}</a>
        {!! Form::submit($submitName, ['class' => 'btn btn-primary']) !!}
    </div>
</div>