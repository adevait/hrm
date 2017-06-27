@extends ('layouts.main_employee')

@section('content')
<div class="row">
    <div class="col-sm-6">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.leave.weekly_summary')}}</div>
            <table class="table table-stripped table-hover">
                <thead>
                    <th>{{trans('app.time.time_logs.employee')}}</th>
                    <th>{{trans('app.time.time_logs.project')}}</th>
                    <th>{{trans('app.time.time_logs.time')}}</th>
                </thead>
                <tbody>
                    @forelse($weekly_summary as $key => $value)
                    <tr>
                        <td>{{$value->employee->first_name.' '.$value->employee->last_name}}</td>
                        <td>{{$value->project->name}}</td>
                        <td>{{$value->time}}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="text-centered">{{trans('app.no_data')}}</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('additionalCSS')
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.css">
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.print.css" media='print'>
@endsection
@section('additionalJS')
<script src="{{url('vendor/moment/moment.min.js')}}"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.1.0/fullcalendar.min.js"></script>
@endsection