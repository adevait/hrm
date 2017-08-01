@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.dashboard.documents.add_new')}}</div>
            {!! Form::open(['route' => 'dashboard.documents.store', 'files' => true, 'class' => 'form-horizontal']) !!}
                @include('dashboard::documents._form', ['submitName' => trans('app.submit')])
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection