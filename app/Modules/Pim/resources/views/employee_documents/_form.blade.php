<div class="form-group">
    {!! Form::label('name', trans('app.pim.employees.documents.name').':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('description', trans('app.pim.employees.documents.description').':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('attachment', trans('app.pim.employees.documents.attachment'), ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::input('file', 'attachment', null, ['class' => 'form-control']) !!}
    </div>
</div>
@if(@$document->attachment)
<div class="form-group">
    <div class="col-sm-6 col-sm-offset-3">
        <a href="{{route('storage',$document->attachment)}}">{{trans('app.pim.employees.salaries.attachment')}}</a>
    </div>
</div>
@endif
@include('errors._form-errors')
<hr>
<div class="form-group">
    <div class="col-sm-6 col-sm-offset-3">
        <a href="{{route('pim.employees.documents.index', Route::input('employeeId'))}}" class="btn btn-default">{{trans('app.cancel')}}</a>
        {!! Form::submit($submitName, ['class' => 'btn btn-primary']) !!}
    </div>
</div>