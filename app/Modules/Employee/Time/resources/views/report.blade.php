@extends('layouts.main_employee')
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
            <h3>{{trans('app.time.time_logs.total_time')}}: {{format_hours($totalHours)}}</h3>
            <ul class="list-group nested-accordion">
                @foreach($clientLogs as $clientLog)
                <li class="list-group-item">
                    <a class="accordion-title" href="#">{{$clientLog->client}}: <b>{{format_hours($clientLog->time)}}</b></a>
                    <ul>
                        @foreach($clientLog->projectLogs as $projectLog)
                        <li>
                            <a class="accordion-title" href="#">{{$projectLog->project}}: <b>{{format_hours($projectLog->time)}}</b></a>
                            <ul>
                                @foreach($projectLog->taskLogs as $taskLog)
                                <li>
                                    <a class="accordion-title" href="#">{{$taskLog->task_name}}: <b>{{format_hours($taskLog->time)}}</b></a>
                                    <ul>
                                        <li>{{$taskLog->task_description}} <a href="{{route('employee.time.edit', $taskLog->log_id)}}" class="btn btn-default btn-xs">{{trans('app.edit')}}</a></li>
                                    </ul>
                                </li>
                                @endforeach
                            </ul>
                        </li>
                        @endforeach
                    </ul>
                </li>
                @endforeach
            </ul>
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