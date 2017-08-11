<div class="form-group">
    {!! Form::label('user_id', trans('app.leave.employee_leaves.employee'), ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::select('user_id', $employees, null, ['class' => 'form-control employees']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('leave_type_id', trans('app.leave.employee_leaves.leave'), ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::select('leave_type_id', $leaveTypes, null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('start_date', trans('app.leave.employee_leaves.start_date').':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::input('date', 'start_date', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('end_date', trans('app.leave.employee_leaves.end_date').':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::input('date', 'end_date', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('attachment', trans('app.leave.employee_leaves.attachment'), ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::input('file', 'attachment', null, ['class' => 'form-control']) !!}
    </div>
</div>
@if(@$employeeLeave->attachment)
<div class="form-group">
    <div class="col-sm-6 col-sm-offset-3">
        <a href="{{route('storage',$employeeLeave->attachment)}}">{{trans('app.leave.employee_leaves.attachment')}}</a>
    </div>
</div>
@endif
@include('errors._form-errors')
<hr>
<div class="form-group">
    <div class="col-sm-6 col-sm-offset-3">
        <a href="{{route('leave.employee_leaves.index')}}" class="btn btn-default">{{trans('app.cancel')}}</a>
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
</script>
@endsection