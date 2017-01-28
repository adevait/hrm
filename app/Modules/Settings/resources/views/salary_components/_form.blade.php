<div class="form-group">
    {!! Form::label('name', trans('app.settings.salary_components.name').':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('contract_type_id', trans('app.settings.salary_components.contract_type').':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::select('contract_type_id', $contractTypes, null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('type', trans('app.settings.salary_components.type').':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        @foreach(salary_component_types() as $key => $component)
        {!! Form::label('type', $component) !!}
        {!! Form::radio('type', $key) !!}
        @endforeach
    </div>
</div>
<div class="form-group">
    {!! Form::label('cost', trans('app.settings.salary_components.is_cost').':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::label('is_cost', trans('app.yes')) !!}
        {!! Form::radio('is_cost', '1') !!}
        {!! Form::label('is_cost', trans('app.no')) !!}
        {!! Form::radio('is_cost', '0') !!}
    </div>
</div>
@include('errors._form-errors')
<hr>
<div class="form-group">
    <div class="col-sm-6 col-sm-offset-3">
        <a href="{{route('settings.salary_components.index')}}" class="btn btn-default">{{trans('app.cancel')}}</a>
        {!! Form::submit($submitName, ['class' => 'btn btn-primary']) !!}
    </div>
</div>