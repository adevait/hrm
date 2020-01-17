<div class="form-group">
    {!! Form::label('task_name', trans('app.pim.candidates.tasks.name').':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::text('task_name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('task_description', trans('app.pim.candidates.tasks.description').':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::text('task_description', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('assigned_to', trans('app.pim.candidates.tasks.assigned_to').':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::select('assigned_to', $admins, null, ['class' => 'form-control admins']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('due_date', trans('app.pim.candidates.tasks.due_date').':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::date('due_date', null, ['class' => 'form-control']) !!}
    </div>
</div>
@include('errors._form-errors')
<hr>
<div class="form-group">
    <div class="col-sm-6 col-sm-offset-3">
        <a href="{{route('pim.employees.tasks.index', Route::input('employeeId'))}}" class="btn btn-default">{{trans('app.cancel')}}</a>
        {!! Form::submit($submitName, ['class' => 'btn btn-primary']) !!}
    </div>
</div>
@section('additionalCSS')
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection
@section('additionalJS')
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>
    $(".admins").select2();
</script>
@endsection