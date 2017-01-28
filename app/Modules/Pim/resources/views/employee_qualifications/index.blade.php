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
                    <th>{{trans('app.pim.employees.qualifications.education.grade')}}</th>
                    <th>{{trans('app.pim.employees.qualifications.education.start_date')}}</th>
                    <th>{{trans('app.pim.employees.qualifications.education.end_date')}}</th>
                    <th></th>
                </thead>
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
                "bServerSide": true,
                "bProcessing": true,
                "sAjaxSource": '{{ route("pim.employees.qualifications.work_experience.datatable", Route::input("employeeId"))}}',
                "aoColumns": [
                    { "aaData": "id" },
                    { "aaData": "job_title" },
                    { "aaData": "start_date" },
                    { "aaData": "end_date" },
                    { "aaData": "company" },
                    { "aaData": "actions"}
                ]
        });

        var educationTable = $('#educationTable').DataTable({
                "bServerSide": true,
                "bProcessing": true,
                "sAjaxSource": '{{ route("pim.employees.qualifications.education.datatable", Route::input("employeeId"))}}',
                "aoColumns": [
                    { "aaData": "id" },
                    { "aaData": "type" },
                    { "aaData": "education_institution_id" },
                    { "aaData": "major" },
                    { "aaData": "year" },
                    { "aaData": "grade" },
                    { "aaData": "start_date" },
                    { "aaData": "end_date" },
                    { "aaData": "actions"}
                ]
        });

        var languageTable = $('#languageTable').DataTable({
                "bServerSide": true,
                "bProcessing": true,
                "sAjaxSource": '{{ route("pim.employees.qualifications.languages.datatable", Route::input("employeeId"))}}',
                "aoColumns": [
                    { "aaData": "id" },
                    { "aaData": "language_id" },
                    { "aaData": "level" },
                    { "aaData": "skill" },
                    { "aaData": "actions"}
                ]
        });
    });
</script>
@endsection