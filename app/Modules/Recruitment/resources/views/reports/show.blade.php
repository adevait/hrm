@extends('layouts.main')
@section('content')
<div class="row">
    <div class="col-sm-12">
        <div class="custom-panel">
            <div class="custom-panel-heading">
                {{$candidate->first_name.' '.$candidate->last_name}}
                <a href="{{route('pim.candidates.feature', $candidate->id)}}" title="{{trans('app.pim.candidates.mark_featured_title')}}" class="btn btn-default"><i style="{{$candidate->featured ? 'color: orange' : ''}}" class="glyphicon glyphicon-star" aria-hidden="true"></i></a>
                <div class="pull-right">
                    @foreach($candidate->social_accounts as $account)
                    <a href="{{$account->url}}"><i class="fa fa-{{get_account_icon($account->type)}}"></i></a>
                    @endforeach
                </div>
                <div class="clearfix"></div>
            </div>
            @if($candidate->skills)
            <div class="row">
                <div class="col-sm-12">
                    @foreach($candidate->skills as $skill)
                    <span class="label label-primary">{{$skill->name}}</span>
                    @endforeach
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.recruitment.reports.show.personal_details')}}</div>
            <div class="row">
                <div class="col-md-4">
                    <label>{{trans('app.pim.employees.first_name')}}:</label>
                </div>
                <div class="col-md-8">
                    <p>{{$candidate->first_name}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label>{{trans('app.pim.employees.last_name')}}:</label>
                </div>
                <div class="col-md-8">
                    <p>{{$candidate->last_name}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label>{{trans('app.pim.employees.email')}}:</label>
                </div>
                <div class="col-md-8">
                    <p>{{$candidate->email}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label>{{trans('app.pim.employees.gender')}}:</label>
                </div>
                <div class="col-md-8">
                    <p>{{gender($candidate->gender)}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label>{{trans('app.pim.employees.birth_date')}}:</label>
                </div>
                <div class="col-md-8">
                    <p>{{$candidate->birth_date}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label>{{trans('app.pim.employees.notes')}}:</label>
                </div>
                <div class="col-md-8">
                    <p>{{$candidate->notes}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label>{{trans('app.recruitment.reports.how_did_they_hear')}}:</label>
                </div>
                <div class="col-md-8">
                    <p>{{$candidate->how_did_they_hear}}</p>
                </div>
            </div>
        </div>
    </div>
    @if($candidate->contact_details)
    <div class="col-md-6">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.pim.employees.contact_details.main')}}</div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label>{{trans('app.pim.employees.contact_details.address1')}}:</label>
            </div>
            <div class="col-md-8">
                <p>{{$candidate->contact_details->address1}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label>{{trans('app.pim.employees.contact_details.address2')}}:</label>
            </div>
            <div class="col-md-8">
                <p>{{$candidate->contact_details->address2}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label>{{trans('app.pim.employees.contact_details.city')}}:</label>
            </div>
            <div class="col-md-8">
                <p>{{$candidate->contact_details->city}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label>{{trans('app.pim.employees.contact_details.state')}}:</label>
            </div>
            <div class="col-md-8">
                <p>{{$candidate->contact_details->state}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label>{{trans('app.pim.employees.contact_details.zip')}}:</label>
            </div>
            <div class="col-md-8">
                <p>{{$candidate->contact_details->zip}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label>{{trans('app.pim.employees.contact_details.country')}}:</label>
            </div>
            <div class="col-md-8">
                <p>{{$candidate->contact_details->country}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label>{{trans('app.pim.employees.contact_details.phone1')}}:</label>
            </div>
            <div class="col-md-8">
                <p>{{$candidate->contact_details->phone1}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label>{{trans('app.pim.employees.contact_details.phone2')}}:</label>
            </div>
            <div class="col-md-8">
                <p>{{$candidate->contact_details->phone2}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <label>{{trans('app.pim.employees.contact_details.phone3')}}:</label>
            </div>
            <div class="col-md-8">
                <p>{{$candidate->contact_details->phone3}}</p>
            </div>
        </div>
    </div>
    @endif
    @if(@$candidate->experience[0])
    <div class="col-md-6">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.pim.employees.qualifications.work_experience.main')}}</div>
            @foreach($candidate->experience as $experience)
            <div class="row">
                <div class="col-md-4">
                    <label>{{trans('app.pim.employees.qualifications.work_experience.company_name')}}:</label>
                </div>
                <div class="col-md-8">
                    <p>{{$experience->company->name}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label>{{trans('app.pim.employees.qualifications.work_experience.job_title')}}:</label>
                </div>
                <div class="col-md-8">
                    <p>{{$experience->job_title}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label>{{trans('app.pim.employees.qualifications.work_experience.start_date')}}:</label>
                </div>
                <div class="col-md-8">
                    <p>{{$experience->start_date}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label>{{trans('app.pim.employees.qualifications.work_experience.end_date')}}:</label>
                </div>
                <div class="col-md-8">
                    <p>{{$experience->end_date}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label>{{trans('app.pim.employees.qualifications.work_experience.comments')}}:</label>
                </div>
                <div class="col-md-8">
                    <p>{{$experience->comment}}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
    @if(@$candidate->education[0])
    <div class="col-md-6">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.pim.employees.qualifications.education.main')}}</div>
            @foreach($candidate->education as $education)
            <div class="row">
                <div class="col-md-4">
                    <label>{{trans('app.pim.employees.qualifications.education.type')}}:</label>
                </div>
                <div class="col-md-8">
                    <p>{{get_education_type_name($education->type)}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label>{{trans('app.pim.employees.qualifications.education.institution')}}:</label>
                </div>
                <div class="col-md-8">
                    <p>{{$education->education_institution->name}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label>{{trans('app.pim.employees.qualifications.education.major')}}:</label>
                </div>
                <div class="col-md-8">
                    <p>{{$education->major}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label>{{trans('app.pim.employees.qualifications.education.year')}}:</label>
                </div>
                <div class="col-md-8">
                    <p>{{$education->year}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label>{{trans('app.pim.employees.qualifications.education.grade')}}:</label>
                </div>
                <div class="col-md-8">
                    <p>{{$education->grade}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label>{{trans('app.pim.employees.qualifications.education.start_date')}}:</label>
                </div>
                <div class="col-md-8">
                    <p>{{$education->start_date}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label>{{trans('app.pim.employees.qualifications.education.end_date')}}:</label>
                </div>
                <div class="col-md-8">
                    <p>{{$education->end_date}}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
    @if(@$candidate->languages[0])
    <div class="col-md-6">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.pim.employees.qualifications.languages.main')}}</div>
            @foreach($candidate->languages as $language)
            <div class="row">
                <div class="col-md-4">
                    <label>{{trans('app.pim.employees.qualifications.languages.language')}}:</label>
                </div>
                <div class="col-md-8">
                    <p>{{$language->language->name}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label>{{trans('app.pim.employees.qualifications.languages.skill')}}:</label>
                </div>
                <div class="col-md-8">
                    <p>{{get_language_skill_name($language->skill)}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label>{{trans('app.pim.employees.qualifications.languages.level')}}:</label>
                </div>
                <div class="col-md-8">
                    <p>{{get_language_level_name($language->level)}}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
    @if($candidate->user_preferences)
    <div class="col-md-6">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.pim.candidates.preferences.main')}}</div>
            <div class="row">
                <div class="col-md-4">
                    <label>{{trans('app.pim.candidates.preferences.salary')}}:</label>
                </div>
                <div class="col-md-8">
                    <p>{{format_price($candidate->user_preferences->salary)}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label>{{trans('app.pim.candidates.preferences.contract_type')}}:</label>
                </div>
                <div class="col-md-8">
                    <p>{{$candidate->user_preferences->contractType->name}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label>{{trans('app.pim.candidates.preferences.location.main')}}:</label>
                </div>
                <div class="col-md-8">
                    <p>{{get_location_name($candidate->user_preferences->location)}}</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <label>{{trans('app.pim.candidates.preferences.comments')}}:</label>
                </div>
                <div class="col-md-8">
                    <p>{{$candidate->user_preferences->comments}}</p>
                </div>
            </div>
        </div>
    </div>
    @endif
    @if($candidate->documents)
    <div class="col-md-6">
        <div class="custom-panel">
            <div class="custom-panel-heading">{{trans('app.pim.employees.documents.main')}}</div>
            @foreach($candidate->documents as $document)
            <div class="row">
                <div class="col-md-4">
                    <label>{{$document->name}}:</label>
                </div>
                <div class="col-md-8">
                    <a href="{{route('storage',$document->attachment)}}">{{route('storage',$document->attachment)}}</a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
@endsection
@section('additionalCSS')
<link rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection