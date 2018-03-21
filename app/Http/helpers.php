<?php

function account_types()
{
    return [
        App\Modules\Pim\Models\UserSocialMedia::FACEBOOK => 'Facebook',
        App\Modules\Pim\Models\UserSocialMedia::TWITTER => 'Twitter',
        App\Modules\Pim\Models\UserSocialMedia::LINKEDIN => 'Linked In',
        App\Modules\Pim\Models\UserSocialMedia::GITHUB => 'Github',
        App\Modules\Pim\Models\UserSocialMedia::BEHANCE => 'Behance',
        App\Modules\Pim\Models\UserSocialMedia::MEDIUM => 'Medium',
        App\Modules\Pim\Models\UserSocialMedia::DRIBBLE => 'Dribble'
    ];
}

function get_account_name($type)
{
    $accounts = account_types();
    return @$accounts[$type];
}

function account_icons()
{
    return [
        App\Modules\Pim\Models\UserSocialMedia::FACEBOOK => 'facebook',
        App\Modules\Pim\Models\UserSocialMedia::TWITTER => 'twitter',
        App\Modules\Pim\Models\UserSocialMedia::LINKEDIN => 'linkedin',
        App\Modules\Pim\Models\UserSocialMedia::GITHUB => 'github',
        App\Modules\Pim\Models\UserSocialMedia::BEHANCE => 'behance',
        App\Modules\Pim\Models\UserSocialMedia::MEDIUM => 'medium',
        App\Modules\Pim\Models\UserSocialMedia::DRIBBLE => 'dribbble'
    ];
}

function get_account_icon($type)
{
    $accounts = account_icons();
    return @$accounts[$type];
}

function education_types()
{
    return [
        App\Modules\Pim\Models\UserEducation::BACHELOR => trans('app.pim.employees.qualifications.education.education_types.bachelor'),
        App\Modules\Pim\Models\UserEducation::MASTER => trans('app.pim.employees.qualifications.education.education_types.master'),
        App\Modules\Pim\Models\UserEducation::ACADEMY => trans('app.pim.employees.qualifications.education.education_types.academy'),
        App\Modules\Pim\Models\UserEducation::UNDERGRADUATE => trans('app.pim.employees.qualifications.education.education_types.undergrad')
    ];
}

function get_education_type_name($type)
{
    $types = education_types();
    return @$types[$type];
}

function language_skills()
{
    return [
        App\Modules\Pim\Models\UserLanguage::SKILL_SPEAK => trans('app.pim.employees.qualifications.languages.skills.speak'),
        App\Modules\Pim\Models\UserLanguage::SKILL_WRITE => trans('app.pim.employees.qualifications.languages.skills.write'),
        App\Modules\Pim\Models\UserLanguage::SKILL_BOTH => trans('app.pim.employees.qualifications.languages.skills.both'),
    ];
}

function get_language_skill_name($skill)
{
    $skills = language_skills();
    return @$skills[$skill];
}

function language_levels()
{
    return [
        App\Modules\Pim\Models\UserLanguage::LEVEL_BEGINNER => trans('app.pim.employees.qualifications.languages.levels.beginner'),
        App\Modules\Pim\Models\UserLanguage::LEVEL_INTERMEDIATE => trans('app.pim.employees.qualifications.languages.levels.intermediate'),
        App\Modules\Pim\Models\UserLanguage::LEVEL_FLUENT => trans('app.pim.employees.qualifications.languages.levels.fluent'),
        App\Modules\Pim\Models\UserLanguage::LEVEL_NATIVE => trans('app.pim.employees.qualifications.languages.levels.native'),
    ];
}

function get_language_level_name($level)
{
    $levels = language_levels();
    return @$levels[$level];
}

function salary_component_types()
{
    return [
        App\Modules\Settings\Models\SalaryComponent::TYPE_EARNING => trans('app.settings.salary_components.types.earning'),
        App\Modules\Settings\Models\SalaryComponent::TYPE_DEDUCTION => trans('app.settings.salary_components.types.deduction')
    ];
}

function get_salary_component_type_name($type)
{
    $types = salary_component_types();
    return @$types[$type];
}

function locations()
{
    return [
        App\Modules\Pim\Models\UserPreference::LOCATION_REMOTE => trans('app.pim.candidates.preferences.location.remote'),
        App\Modules\Pim\Models\UserPreference::LOCATION_INHOUSE => trans('app.pim.candidates.preferences.location.inhouse')
    ];
}

function get_location_name($location)
{
    $locations = locations();
    return @$locations[$location];
}

function document_template_types()
{
    return [
        App\Modules\Settings\Models\DocumentTemplate::TYPE_PIM => trans('app.settings.document_templates.types.pim')
    ];
}

function get_document_template_type($type)
{
    $document_template_types = document_template_types();
    return @$document_template_types[$type];
}

function gender($gender) 
{
    $genders = [
        'm' => 'Male',
        'f' => 'Female'
    ];
    return $genders[$gender];
}

function format_price($price)
{
    return 'EUR '.$price;
}

function template_toolbar()
{
    $toolbar = [
        'employee.first_name' => 'first_name',
        'employee.last_name' => 'last_name',
        'employee.email' => 'email',
        'employee.birth_date' => 'birth_date'
    ];
    return $toolbar;
}

function display_storage_path($path)
{
    return '/storage/'.trim($path, '/');
}

function get_user_role($role) 
{
    $roles = [
        App\User::USER_ROLE_CANDIDATE => 'candidate',
        App\User::USER_ROLE_EMPLOYEE => 'employee',
        App\User::USER_ROLE_ADMIN => 'admin'
    ];
    return @$roles[$role];
}

function get_current_date()
{
    return Carbon\Carbon::now()->format('Y-m-d');
}

function checkValidity($id)
{
    if($id != Auth::user()->id) {
        abort(403, 'Unauthorized action.'); 
    }
}

function format_hours($hours)
{
    return $hours.' hrs';
}