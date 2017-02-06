@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.time.projects.edit_details')}}</div>
            {!! Form::model($project, ['method' => 'PUT', 'route' => ['time.projects.update', $project->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                @include('time::projects._form', ['submitName' => trans('app.submit')])
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection