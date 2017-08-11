<h3>{{trans('app.pim.employees.contact_details.address')}}</h3>
<hr>
<div class="form-group">
    {!! Form::label('street_1', trans('app.pim.employees.contact_details.address1').':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::text('street_1', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('street_2', trans('app.pim.employees.contact_details.address2').':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::text('street_2', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('city', trans('app.pim.employees.contact_details.city').':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::text('city', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('state', trans('app.pim.employees.contact_details.state').':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::text('state', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('zip', trans('app.pim.employees.contact_details.zip').':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::text('zip', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('country', trans('app.pim.employees.contact_details.country').':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::text('country', null, ['class' => 'form-control']) !!}
    </div>
</div>
<h3>{{trans('app.pim.employees.contact_details.phone_numbers')}}</h3>
<hr>
<div class="form-group">
    {!! Form::label('phone1', trans('app.pim.employees.contact_details.phone1').':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::input('phone1', 'phone1', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('phone2', trans('app.pim.employees.contact_details.phone2').':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::input('phone2', 'phone2', null, ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-group">
    {!! Form::label('phone3', trans('app.pim.employees.contact_details.phone3').':', ['class' => 'col-sm-3']) !!}
    <div class="col-sm-6">
        {!! Form::input('phone3', 'phone3', null, ['class' => 'form-control']) !!}
    </div>
</div>
@include('errors._form-errors')
<hr>
<div class="form-group">
    <div class="col-sm-6 col-sm-offset-3">
        <a href="{{route('pim.employees.edit', Route::input('employeeId'))}}" class="btn btn-default">{{trans('app.cancel')}}</a>
        {!! Form::submit($submitName, ['class' => 'btn btn-primary']) !!}
    </div>
</div>