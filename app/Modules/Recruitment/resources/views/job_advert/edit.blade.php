@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.recruitment.job_advert.edit_details')}}</div>
            {!! Form::model($jadvert, ['method' => 'PUT', 'route' => ['recruitment.job_advert.update', $jadvert->id], 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                @include('recruitment::job_advert._form', ['submitName' => trans('app.submit')])
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection