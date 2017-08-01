@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-lg-3 col-md-4 col-sm-6">
        <a class="nav-box" href="{{route('dashboard.documents.index')}}">
            <h2>{{trans('app.dashboard.documents.main')}}</h2>
        </a>
    </div>
</div>
@endsection
@section('additionalCSS')
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection