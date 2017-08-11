@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.pim.employees.add_new')}}</div>
            {!! Form::open(['route' => 'pim.employees.store', 'class' => 'form-horizontal', 'enctype' => 'multipart/form-data']) !!}
                @include('pim::employees._form', ['submitName' => trans('app.submit')])
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection