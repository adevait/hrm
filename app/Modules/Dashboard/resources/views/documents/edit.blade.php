@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.dashboard.documents.edit_details')}}</div>
            {!! Form::model($document, ['method' => 'PUT', 'route' => ['dashboard.documents.update', $document->id], 'class' => 'form-horizontal', 'files' => true]) !!}
                @include('dashboard::documents._form', ['submitName' => trans('app.submit')])
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection