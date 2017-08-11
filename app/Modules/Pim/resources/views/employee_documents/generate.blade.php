@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.pim.employees.documents.generate')}}</div>
            {!! Form::open(['id' => 'form-generate', 'class' => 'form-horizontal', 'route' => ['pim.employees.documents.template_content', Route::input('employeeId')]]) !!}
                <div class="form-group">
                    {!! Form::label('document', trans('app.pim.employees.documents.templates.document'), ['class' => 'col-sm-3']) !!}
                    <div class="col-sm-6">
                        {!! Form::select('document', $documents, null, ['class' => 'form-control', 'id' => 'document']) !!}
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-6 col-sm-offset-3">
                        {!! Form::submit(trans('app.pim.employees.documents.btn_generate'), ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
                <div id="preview"></div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection