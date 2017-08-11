@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.pim.candidates.add_new')}}</div>
            {!! Form::open(['route' => 'pim.candidates.store', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                @include('pim::candidates._form', ['submitName' => trans('app.submit')])
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection