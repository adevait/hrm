<div class="form-group">
    {!! Form::label('task_name', trans('app.time.time_logs.task_name').':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::text('task_name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('task_description', trans('app.time.time_logs.task_description').':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::textarea('task_description', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('project_id', trans('app.time.time_logs.project'), ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::select('project_id', $projects, null, ['class' => 'form-control projects']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('user_id', trans('app.time.time_logs.employee'), ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::select('user_id', $employees, null, ['class' => 'form-control employees']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('time', trans('app.time.time_logs.time').':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::text('time', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('date', trans('app.time.time_logs.date').':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::input('date', 'date', $defaultDate, ['class' => 'form-control']) !!}
    </div>
</div>
@include('errors._form-errors')
<hr>
<div class="form-group">
    <div class="col-sm-6 col-sm-offset-3">
        <a href="{{route('time.time_logs.index')}}" class="btn btn-default">{{trans('app.cancel')}}</a>
        {!! Form::submit($submitName, ['class' => 'btn btn-primary']) !!}
    </div>
</div>
@section('additionalCSS')
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection
@section('additionalJS')
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>
    $(".employees").select2();
    $(".projects").select2();
</script>
@endsection