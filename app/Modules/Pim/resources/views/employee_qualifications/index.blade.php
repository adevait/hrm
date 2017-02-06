@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.pim.employees.qualifications.skills')}}</div>
            {!! Form::open(['route' => ['pim.employees.qualifications.skills.store', Route::input('employeeId')]]) !!}
            <div class="row">
                <div class="col-sm-10">
                    <div class="form-group">
                        {!! Form::select('skills[]', $allSkills, $skills, ['class' => 'form-control', 'id' => 'skills', 'multiple' => 'multiple']) !!}
                    </div>
                </div>
                <div class="col-sm-2">
                    {!! Form::submit(trans('app.submit'), ['class' => 'btn btn-primary']) !!}
                </div>
            </div>
            @include('errors._form-errors')        
            {!! Form::close() !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <a href="{{route('pim.employees.qualifications.work_experience.create', Route::input('employeeId'))}}" class="btn btn-primary pull-right">{{trans('app.pim.employees.qualifications.work_experience.add_new')}}</a>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.pim.employees.qualifications.work_experience.main')}}</div>
            <table class="table table-bordered table-hover" id="workExperienceTable">
                <thead>
                    <th>{{trans('app.id')}}</th>
                    <th>{{trans('app.pim.employees.qualifications.work_experience.job_title')}}</th>
                    <th>{{trans('app.pim.employees.qualifications.work_experience.start_date')}}</th>
                    <th>{{trans('app.pim.employees.qualifications.work_experience.end_date')}}</th>
                    <th>{{trans('app.pim.employees.qualifications.work_experience.company_name')}}</th>
                    <th></th>
                </thead>
                <tfoot>
                    <th>
                        <input type="text" placeholder="{{trans('app.id')}}"/>
                    </th>
                    <th>
                        <input type="text" placeholder="{{trans('app.pim.employees.qualifications.work_experience.job_title')}}"/>
                    </th>
                    <th>
                        <input type="date" placeholder="{{trans('app.pim.employees.qualifications.work_experience.start_date')}}"/>
                    </th>
                    <th>
                        <input type="date" placeholder="{{trans('app.pim.employees.qualifications.work_experience.end_date')}}"/>
                    </th>
                    <th>
                        {!! Form::select('company_id', $companies, null, ['placeholder' => trans('app.pim.employees.qualifications.work_experience.company_name')]) !!}
                    </th>
                    <th></th>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <a href="{{route('pim.employees.qualifications.education.create', Route::input('employeeId'))}}" class="btn btn-primary pull-right">{{trans('app.pim.employees.qualifications.education.add_new')}}</a>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.pim.employees.qualifications.education.main')}}</div>
            <table class="table table-bordered table-hover" id="educationTable">
                <thead>
                    <th>{{trans('app.id')}}</th>
                    <th>{{trans('app.pim.employees.qualifications.education.type')}}</th>
                    <th>{{trans('app.pim.employees.qualifications.education.institution')}}</th>
                    <th>{{trans('app.pim.employees.qualifications.education.major')}}</th>
                    <th>{{trans('app.pim.employees.qualifications.education.year')}}</th>
                    <th></th>
                </thead>
                <tfoot>
                    <th>
                        <input type="text" placeholder="{{trans('app.id')}}"/>
                    </th>
                    <th>
                        {!! Form::select('type', education_types(), null, ['placeholder' => trans('app.pim.employees.qualifications.education.type')]) !!}
                    </th>
                    <th>
                        {!! Form::select('education_institution_id', $education_institutions, null, ['placeholder' => trans('app.pim.employees.qualifications.education.institution')]) !!}
                    </th>
                    <th>
                        <input type="text" placeholder="{{trans('app.pim.employees.qualifications.education.major')}}"/>
                    </th>
                    <th>
                        <input type="text" placeholder="{{trans('app.pim.employees.qualifications.education.year')}}"/>
                    </th>
                    <th></th>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <a href="{{route('pim.employees.qualifications.languages.create', Route::input('employeeId'))}}" class="btn btn-primary pull-right">{{trans('app.pim.employees.qualifications.languages.add_new')}}</a>
    </div>
</div>
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.pim.employees.qualifications.languages.main')}}</div>
            <table class="table table-bordered table-hover" id="languageTable">
                <thead>
                    <th>{{trans('app.id')}}</th>
                    <th>{{trans('app.pim.employees.qualifications.languages.language')}}</th>
                    <th>{{trans('app.pim.employees.qualifications.languages.level')}}</th>
                    <th>{{trans('app.pim.employees.qualifications.languages.skill')}}</th>
                    <th></th>
                </thead>
                <tfoot>
                    <th>
                        <input type="text" placeholder="{{trans('app.id')}}"/>
                    </th>
                    <th>
                        {!! Form::select('language_id', $languages, null, ['placeholder' => trans('app.pim.employees.qualifications.languages.language')]) !!}
                    </th>
                    <th>
                        {!! Form::select('level', language_levels(), null, ['placeholder' => trans('app.pim.employees.qualifications.languages.level')]) !!}
                    </th>
                    <th>
                        {!! Form::select('skill', language_skills(), null, ['placeholder' => trans('app.pim.employees.qualifications.languages.skill')]) !!}
                    </th>
                    <th></th>
                </tfoot>
            </table>
        </div>
    </div>
</div>
@endsection
@section('additionalCSS')
<link rel="stylesheet" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
<link href="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
@endsection
@section('additionalJS')
<script src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script>
    $(document).ready(function(){
        
        $('#skills').select2({
            tags: true
        })

        var qualificationsTable = $('#workExperienceTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("pim.employees.qualifications.work_experience.datatable", Route::input("employeeId"))}}',
            columns: [
                {data: 0, name: 'id'},
                {data: 1, name: 'job_title'},
                {data: 2, name: 'start_date'},
                {data: 3, name: 'end_date'},
                {data: 4, name: 'company_id'},
                {data: 5, name: 'actions', sortable: false, searchable: false}
            ]
        });

        qualificationsTable.columns().every(function () {
            var that = this;
            $('input', this.footer()).on( 'keyup change', function () {
                if (that.search() !== this.value) {
                    that.search(this.value).draw();
                }
            });
            $('select', this.footer()).on( 'change', function () {
                if (that.search() !== this.value) {
                    that.search(this.value).draw();
                }
            });
        });

        var educationTable = $('#educationTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("pim.employees.qualifications.education.datatable", Route::input("employeeId"))}}',
            columns: [
                {data: 0, name: 'id'},
                {data: 1, name: 'type'},
                {data: 2, name: 'education_institution_id'},
                {data: 3, name: 'major'},
                {data: 4, name: 'year'},
                {data: 5, name: 'actions', sortable: false, searchable: false}
            ]
        });

        educationTable.columns().every(function () {
            var that = this;
            $('input', this.footer()).on( 'keyup change', function () {
                if (that.search() !== this.value) {
                    that.search(this.value).draw();
                }
            });
            $('select', this.footer()).on( 'change', function () {
                if (that.search() !== this.value) {
                    that.search(this.value).draw();
                }
            });
        });

        var languageTable = $('#languageTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route("pim.employees.qualifications.languages.datatable", Route::input("employeeId"))}}',
            columns: [
                {data: 0, name: 'id'},
                {data: 1, name: 'language_id'},
                {data: 2, name: 'level'},
                {data: 3, name: 'skill'},
                {data: 4, name: 'actions', sortable: false, searchable: false}
            ]
        });

        languageTable.columns().every(function () {
            var that = this;
            $('input', this.footer()).on( 'keyup change', function () {
                if (that.search() !== this.value) {
                    that.search(this.value).draw();
                }
            });
            $('select', this.footer()).on( 'change', function () {
                if (that.search() !== this.value) {
                    that.search(this.value).draw();
                }
            });
        });
    });
</script>
@endsection