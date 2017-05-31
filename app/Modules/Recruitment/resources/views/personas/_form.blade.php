<div class="form-group">
    {!! Form::label('name', trans('app.recruitment.personas.name').':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
</div>
@foreach($fields as $key => $field)
@if($key == 0 || $field->category != $fields[$key-1]->category)
<h3>{{$field->category}}</h3>
<hr>
@endif
<div class="form-group">
    {!! Form::label($field->key, $field->value.':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::{$field->tagname}('fields['.$field->id.']', null, ['class' => 'form-control']) !!}
    </div>
</div>
@endforeach
@include('errors._form-errors')
<hr>
<div class="form-group">
    <div class="col-sm-6 col-sm-offset-3">
        <a href="{{route('recruitment.personas.index')}}" class="btn btn-default">{{trans('app.cancel')}}</a>
        {!! Form::submit($submitName, ['class' => 'btn btn-primary']) !!}
    </div>
</div>