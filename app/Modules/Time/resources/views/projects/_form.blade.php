<div class="form-group">
    {!! Form::label('name', trans('app.time.projects.name').':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('description', trans('app.time.projects.description').':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('client_id', trans('app.time.projects.client'), ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::select('client_id', $clients, null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('assignees', trans('app.time.projects.assignees'), ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::select('assignees[]', $employees, null, ['class' => 'form-control', 'multiple' => 'multiple']) !!}
    </div>
</div>
@include('errors._form-errors')
<hr>
<div class="form-group">
    <div class="col-sm-6 col-sm-offset-3">
        <a href="{{route('time.projects.index')}}" class="btn btn-default">{{trans('app.cancel')}}</a>
        {!! Form::submit($submitName, ['class' => 'btn btn-primary']) !!}
    </div>
</div>
@section('additionalCSS')
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection
@section('additionalJS')
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>
    $(document).ready(function(){
        
        $('[name="assignees[]"]').select2({
            tags: true
        })
    });
</script>
@endsection