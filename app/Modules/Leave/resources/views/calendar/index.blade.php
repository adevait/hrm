@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.leave.calendar.main')}}</div>
                <div id="calendar"></div>
            </div>
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
<script>
    $(document).ready(function() {
        var sources = [];
        $('#calendar').fullCalendar({
            header: {
                left: 'prev,next',
                center: 'title',
                right: 'month,basicWeek,basicDay'
            },
            defaultDate: '2017-01-01',
            navLinks: true, // can click day/week names to navigate views
            editable: false,
            eventLimit: true, // allow "more" link when too many events
            viewRender: function(view, element) {
                var date = $('#calendar').fullCalendar('getDate');
                date = moment(date).format('YYYY-MM-DD');
                if(sources.indexOf(date) == -1) {
                    sources.push(date);
                    $.ajax({
                        url: "{{route('leave.calendar.render')}}",
                        data: {date: date},
                        success: function(events) {
                            $('#calendar').fullCalendar('addEventSource', events);
                        }
                    });
                }
            }
        });
    });
</script>
@endsection