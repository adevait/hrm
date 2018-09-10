<html>
<head></head>
<body>
    <h3>{!!trans('app.employee.leaves.request_leave_email.body.new_request', compact('employeeName'))!!}</h3>
    <p><b>{!!trans('app.employee.leaves.request_leave_email.body.date_from')!!}:</b> {{$dateFrom}}</p>
    <p><b>{!!trans('app.employee.leaves.request_leave_email.body.date_to')!!}:</b> {{$dateTo}}</p>
    <p>{!!trans('app.employee.leaves.request_leave_email.body.review_request')!!} <a href="{{route('leave.employee_leaves.edit', $requestId)}}">{{route('leave.employee_leaves.edit', $requestId)}}</a></p>
</body>
</html>