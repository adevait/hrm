@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.time.time_logs.main')}}</div>
            <div class="form-group clearfix">
            <form method="get" id="date_filter" action="">
                <div class="col-md-3">
                    <input type="date" class="form-control" name="date_start" placeholder="{{trans('app.time.time_logs.start_date')}}" value="{{$request->date_start}}" required/>
                </div>
                <div class="col-md-3">
                    <input type="date" class="form-control col-md-3" name="date_end" placeholder="{{trans('app.time.time_logs.end_date')}}" value="{{$request->date_end}}" required/>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary">{{trans('app.filter')}}</button>
                </div>
            </form>
            </div>
            <h3>{{trans('app.pim.employees.salaries.salary_report')}}</h3>
            <ol>
                @foreach($employees as $employee)
                <li>
                    <p>
                        <b>{{$employee->first_name.' '.$employee->last_name}}: </b>
                        @if($report[$employee->id]['salary'])
                        {{$report[$employee->id]['salary']['amount']}}
                        @endif
                    </p>
                </li>
                @endforeach
            </ol>
        </div>
    </div>
</div>
@endsection
@section('additionalJS')
<script>
    $(document).ready(function() {
        $('.nested-accordion .accordion-title').click(function(e) {
            e.preventDefault();
            $(this).toggleClass('expanded');
        })
    });
</script>
@endsection
@section('additionalCSS')
<link rel="stylesheet" href="/css/lib/custom-nested-accordion.css">
@endsection