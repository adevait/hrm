<div class="form-group">
    {!! Form::label('user_id', trans('app.leave.employee_leaves.employee'), ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::select('user_id', [], null, ['class' => 'form-control json-select']) !!}
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
    function formatEmployee (employee) {
        if (employee.loading) return employee.text;
        var markup = "<div class='clearfix'>" +
            "<h4>" + employee.first_name+' '+employee.last_name + "</h4>"+
            "<p>"+ employee.email+"</p>";
        return markup;
    }

    function formatEmployeeSelection (employee) {
      return employee.first_name+' '+employee.last_name;
    }

    $(".json-select").select2({
        ajax: {
            url: "{{route('pim.employees.select_json')}}",
            dataType: 'json',
            delay: 250,
            data: function (params) {
              return {
                q: params.term, 
                page: params.page
              };
            },
            processResults: function (data, params) {
              params.page = params.page || 0;

              return {
                results: data.items,
                pagination: {
                  more: (params.page * 30) < data.total_count
                }
              };
            },
            cache: true
        },
        escapeMarkup: function (markup) { return markup; },
        minimumInputLength: 0,
        templateResult: formatEmployee, 
        templateSelection: formatEmployeeSelection
    });
</script>
@endsection