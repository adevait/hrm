<html>
<head></head>
<body>
    <h3>{!!trans('app.leave.employee_leaves.approve_email.body.request_approved', compact('employeeName'))!!}</h3>
    <p><b>{!!trans('app.leave.employee_leaves.approve_email.body.date_from')!!}:</b> {{$dateFrom}}</p>
    <p><b>{!!trans('app.leave.employee_leaves.approve_email.body.date_to')!!}:</b> {{$dateTo}}</p>
    <p>{!!trans('app.leave.employee_leaves.approve_email.body.review_request')!!} <a href="{{route('employee.leaves.show', $requestId)}}">{{route('employee.leaves.show', $requestId)}}</a></p>
</body>
</html>