<?php

// Home
Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.home'), route('home'));
});

/**
 * Profile breadcrumbs start here
 */

// Home > Profile
Breadcrumbs::register('profile.index', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.profile.main'), route('profile.index'));
});

/**
 * Profile breadcrumbs end here
 */

/**
 * Settings breadcrumbs start here
 */

// Home > Settings
Breadcrumbs::register('settings.index', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.settings.main'), route('settings.index'));
});

/**
 * Job positions breadcrumbs start here
 */

// Home > Settings > Job Positions
Breadcrumbs::register('settings.job_positions.index', function($breadcrumbs)
{
    $breadcrumbs->parent('settings.index');
    $breadcrumbs->push(trans('app.settings.job_positions.main'), route('settings.job_positions.index'));
});

// Home > Settings > Job Positions > Create
Breadcrumbs::register('settings.job_positions.create', function($breadcrumbs)
{
    $breadcrumbs->parent('settings.job_positions.index');
    $breadcrumbs->push(trans('app.add_record'), route('settings.job_positions.create'));
});

// Home > Settings > Job Positions > Edit
Breadcrumbs::register('settings.job_positions.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('settings.job_positions.index');
    $breadcrumbs->push(trans('app.edit').': '.$breadcrumb['title'], route('settings.job_positions.edit', $breadcrumb['id']));
});

// Home > Settings > Job Positions > Details
Breadcrumbs::register('settings.job_positions.show', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('settings.job_positions.index');
    $breadcrumbs->push($breadcrumb['title'], route('settings.job_positions.show', $breadcrumb['id']));
});

/**
 * Job positions breadcrumbs end here
 */

/**
 * Companies breadcrumbs start here
 */

// Home > Settings > Companies
Breadcrumbs::register('settings.companies.index', function($breadcrumbs)
{
    $breadcrumbs->parent('settings.index');
    $breadcrumbs->push(trans('app.settings.companies.main'), route('settings.companies.index'));
});

// Home > Settings > Companies > Create
Breadcrumbs::register('settings.companies.create', function($breadcrumbs)
{
    $breadcrumbs->parent('settings.companies.index');
    $breadcrumbs->push(trans('app.add_record'), route('settings.companies.create'));
});

// Home > Settings > Companies > Edit
Breadcrumbs::register('settings.companies.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('settings.companies.index');
    $breadcrumbs->push(trans('app.edit').': '.$breadcrumb['title'], route('settings.companies.edit', $breadcrumb['id']));
});

// Home > Settings > Companies > Details
Breadcrumbs::register('settings.companies.show', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('settings.companies.index');
    $breadcrumbs->push($breadcrumb['title'], route('settings.companies.show', $breadcrumb['id']));
});

/**
 * Companies breadcrumbs end here
 */

/**
 * Contract types breadcrumbs start here
 */

// Home > Settings > Contract types
Breadcrumbs::register('settings.contract_types.index', function($breadcrumbs)
{
    $breadcrumbs->parent('settings.index');
    $breadcrumbs->push(trans('app.settings.contract_types.main'), route('settings.contract_types.index'));
});

// Home > Settings > Contract types > Create
Breadcrumbs::register('settings.contract_types.create', function($breadcrumbs)
{
    $breadcrumbs->parent('settings.contract_types.index');
    $breadcrumbs->push(trans('app.add_record'), route('settings.contract_types.create'));
});

// Home > Settings > Contract types > Edit
Breadcrumbs::register('settings.contract_types.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('settings.contract_types.index');
    $breadcrumbs->push(trans('app.edit').': '.$breadcrumb['title'], route('settings.contract_types.edit', $breadcrumb['id']));
});

// Home > Settings > Contract types > Details
Breadcrumbs::register('settings.contract_types.show', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('settings.contract_types.index');
    $breadcrumbs->push($breadcrumb['title'], route('settings.contract_types.show', $breadcrumb['id']));
});

/**
 * Contract types breadcrumbs end here
 */

/**
 * Document templates breadcrumbs start here
 */

// Home > Settings > Document templates
Breadcrumbs::register('settings.document_templates.index', function($breadcrumbs)
{
    $breadcrumbs->parent('settings.index');
    $breadcrumbs->push(trans('app.settings.document_templates.main'), route('settings.document_templates.index'));
});

// Home > Settings > Document templates > Create
Breadcrumbs::register('settings.document_templates.create', function($breadcrumbs)
{
    $breadcrumbs->parent('settings.document_templates.index');
    $breadcrumbs->push(trans('app.add_record'), route('settings.document_templates.create'));
});

// Home > Settings > Document templates > Edit
Breadcrumbs::register('settings.document_templates.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('settings.document_templates.index');
    $breadcrumbs->push(trans('app.edit').': '.$breadcrumb['title'], route('settings.document_templates.edit', $breadcrumb['id']));
});

// Home > Settings > Document templates > Details
Breadcrumbs::register('settings.document_templates.show', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('settings.document_templates.index');
    $breadcrumbs->push($breadcrumb['title'], route('settings.document_templates.show', $breadcrumb['id']));
});

/**
 * Document templates breadcrumbs end here
 */

/**
 * Education institutions breadcrumbs start here
 */

// Home > Settings > Education institutions
Breadcrumbs::register('settings.education_institutions.index', function($breadcrumbs)
{
    $breadcrumbs->parent('settings.index');
    $breadcrumbs->push(trans('app.settings.education_institutions.main'), route('settings.education_institutions.index'));
});

// Home > Settings > Education institutions > Create
Breadcrumbs::register('settings.education_institutions.create', function($breadcrumbs)
{
    $breadcrumbs->parent('settings.education_institutions.index');
    $breadcrumbs->push(trans('app.add_record'), route('settings.education_institutions.create'));
});

// Home > Settings > Education institutions > Edit
Breadcrumbs::register('settings.education_institutions.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('settings.education_institutions.index');
    $breadcrumbs->push(trans('app.edit').': '.$breadcrumb['title'], route('settings.education_institutions.edit', $breadcrumb['id']));
});

// Home > Settings > Education institutions > Details
Breadcrumbs::register('settings.education_institutions.show', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('settings.education_institutions.index');
    $breadcrumbs->push($breadcrumb['title'], route('settings.education_institutions.show', $breadcrumb['id']));
});

/**
 * Education institutions breadcrumbs end here
 */

/**
 * Languages breadcrumbs start here
 */

// Home > Settings > Languages
Breadcrumbs::register('settings.languages.index', function($breadcrumbs)
{
    $breadcrumbs->parent('settings.index');
    $breadcrumbs->push(trans('app.settings.languages.main'), route('settings.languages.index'));
});

// Home > Settings > Languages > Create
Breadcrumbs::register('settings.languages.create', function($breadcrumbs)
{
    $breadcrumbs->parent('settings.languages.index');
    $breadcrumbs->push(trans('app.add_record'), route('settings.languages.create'));
});

// Home > Settings > Languages > Edit
Breadcrumbs::register('settings.languages.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('settings.languages.index');
    $breadcrumbs->push(trans('app.edit').': '.$breadcrumb['title'], route('settings.languages.edit', $breadcrumb['id']));
});

// Home > Settings > Languages > Details
Breadcrumbs::register('settings.languages.show', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('settings.languages.index');
    $breadcrumbs->push($breadcrumb['title'], route('settings.languages.show', $breadcrumb['id']));
});

/**
 * Languages breadcrumbs end here
 */

/**
 * Salary components breadcrumbs start here
 */

// Home > Settings > Salary components
Breadcrumbs::register('settings.salary_components.index', function($breadcrumbs)
{
    $breadcrumbs->parent('settings.index');
    $breadcrumbs->push(trans('app.settings.salary_components.main'), route('settings.salary_components.index'));
});

// Home > Settings > Salary components > Create
Breadcrumbs::register('settings.salary_components.create', function($breadcrumbs)
{
    $breadcrumbs->parent('settings.salary_components.index');
    $breadcrumbs->push(trans('app.add_record'), route('settings.salary_components.create'));
});

// Home > Settings > Salary components > Edit
Breadcrumbs::register('settings.salary_components.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('settings.salary_components.index');
    $breadcrumbs->push(trans('app.edit').': '.$breadcrumb['title'], route('settings.salary_components.edit', $breadcrumb['id']));
});

// Home > Settings > Salary components > Details
Breadcrumbs::register('settings.salary_components.show', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('settings.salary_components.index');
    $breadcrumbs->push($breadcrumb['title'], route('settings.salary_components.show', $breadcrumb['id']));
});

/**
 * Job positions breadcrumbs end here
 */

/**
 * Settings breadcrumbs end here
 */

/**
 * PIM breadcrumbs start here
 */

// Home > PIM
Breadcrumbs::register('pim.index', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.pim.main'), route('pim.index'));
});

/**
 * Candidates breadcrumbs start here
 */

// Home > PIM > Candidates
Breadcrumbs::register('pim.candidates.index', function($breadcrumbs)
{
    $breadcrumbs->parent('pim.index');
    $breadcrumbs->push(trans('app.pim.candidates.main'), route('pim.candidates.index'));
});

// Home > PIM > Candidates > Create
Breadcrumbs::register('pim.candidates.create', function($breadcrumbs)
{
    $breadcrumbs->parent('pim.candidates.index');
    $breadcrumbs->push(trans('app.add_record'), route('pim.candidates.create'));
});

// Home > PIM > Candidates > Edit
Breadcrumbs::register('pim.candidates.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('pim.candidates.index');
    $breadcrumbs->push(trans('app.edit').': '.$breadcrumb['title'], route('pim.candidates.edit', $breadcrumb['id']));
});

// Home > PIM > Candidates > Details
Breadcrumbs::register('pim.candidates.show', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('pim.candidates.index');
    $breadcrumbs->push($breadcrumb['title'], route('pim.candidates.show', $breadcrumb['id']));
});

/**
 * Candidates breadcrumbs start here
 */

/**
 * Employees breadcrumbs start here
 */

// Home > PIM > Employees
Breadcrumbs::register('pim.employees.index', function($breadcrumbs)
{
    $breadcrumbs->parent('pim.index');
    $breadcrumbs->push(trans('app.pim.employees.main'), route('pim.employees.index'));
});

// Home > PIM > Employees > Create
Breadcrumbs::register('pim.employees.create', function($breadcrumbs)
{
    $breadcrumbs->parent('pim.employees.index');
    $breadcrumbs->push(trans('app.add_record'), route('pim.employees.create'));
});

// Home > PIM > Employees > Edit
Breadcrumbs::register('pim.employees.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('pim.employees.index');
    $breadcrumbs->push(trans('app.edit').': '.$breadcrumb['title'], route('pim.employees.edit', $breadcrumb['id']));
});

// Home > PIM > Employees > Details
Breadcrumbs::register('pim.employees.show', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('pim.employees.index');
    $breadcrumbs->push($breadcrumb['title'], route('pim.employees.show', $breadcrumb['id']));
});

/**
 * Employee social media account breadcrumbs start here
 */

// Home > PIM > Employees > Employee > External Accounts
Breadcrumbs::register('pim.employees.social_media.index', function($breadcrumbs, $breadcrumb)
{
    if(@$breadcrumb['parent_type'] == 'candidate') {
        $breadcrumbs->parent('pim.candidates.edit', ['id' => $breadcrumb['parent_id'], 'title' => $breadcrumb['parent_title']]);
    } else {
        $breadcrumbs->parent('pim.employees.edit', ['id' => $breadcrumb['parent_id'], 'title' => $breadcrumb['parent_title']]);
    }
    $breadcrumbs->push(trans('app.pim.employees.external_accounts.main'), route('pim.employees.social_media.index', $breadcrumb['parent_id']));
});

// Home > PIM > Employees > Employee > External Accounts > Create
Breadcrumbs::register('pim.employees.social_media.create', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('pim.employees.social_media.index', $breadcrumb);
    $breadcrumbs->push(trans('app.add_record'), route('pim.employees.social_media.create', $breadcrumb['parent_id']));
});

// Home > PIM > Employees > Employee > External Accounts > Edit
Breadcrumbs::register('pim.employees.social_media.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('pim.employees.social_media.index', $breadcrumb);
    $breadcrumbs->push(trans('app.edit').': '.$breadcrumb['title'], route('pim.employees.social_media.edit', [$breadcrumb['parent_id'], $breadcrumb['id']]));
});

// Home > PIM > Employees > Employee > External Accounts > Details
Breadcrumbs::register('pim.employees.social_media.show', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('pim.employees.index');
    $breadcrumbs->push($breadcrumb['title'], route('pim.employees.show', $breadcrumb['id']));
});

/**
 * Employee social media account breadcrumbs end here
 */

/**
 * Employee documents account breadcrumbs start here
 */

// Home > PIM > Employees > Employee > Documents
Breadcrumbs::register('pim.employees.documents.index', function($breadcrumbs, $breadcrumb)
{
    if(@$breadcrumb['parent_type'] == 'candidate') {
        $breadcrumbs->parent('pim.candidates.edit', ['id' => $breadcrumb['parent_id'], 'title' => $breadcrumb['parent_title']]);
    } else {
        $breadcrumbs->parent('pim.employees.edit', ['id' => $breadcrumb['parent_id'], 'title' => $breadcrumb['parent_title']]);
    }
    $breadcrumbs->push(trans('app.pim.employees.documents.main'), route('pim.employees.documents.index', $breadcrumb['parent_id']));
});

// Home > PIM > Employees > Employee > Documents > Create
Breadcrumbs::register('pim.employees.documents.create', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('pim.employees.documents.index', $breadcrumb);
    $breadcrumbs->push(trans('app.add_record'), route('pim.employees.documents.create', $breadcrumb['parent_id']));
});

// Home > PIM > Employees > Employee > Documents > Edit
Breadcrumbs::register('pim.employees.documents.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('pim.employees.documents.index', $breadcrumb);
    $breadcrumbs->push(trans('app.edit').': '.$breadcrumb['title'], route('pim.employees.documents.edit', [$breadcrumb['parent_id'], $breadcrumb['id']]));
});

// Home > PIM > Employees > Employee > Documents > Details
Breadcrumbs::register('pim.employees.documents.show', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('pim.employees.index');
    $breadcrumbs->push($breadcrumb['title'], route('pim.employees.show', $breadcrumb['id']));
});

// Home > PIM > Employees > Employee > Documents > Generate
Breadcrumbs::register('pim.employees.documents.generate', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('pim.employees.documents.index', $breadcrumb);
    $breadcrumbs->push(trans('app.pim.employees.documents.generate'), route('pim.employees.documents.generate', $breadcrumb['parent_id']));
});

/**
 * Employee documents account breadcrumbs end here
 */


/**
 * Employee salary breadcrumbs start here
 */

// Home > PIM > Employees > Employee > External Accounts
Breadcrumbs::register('pim.employees.salaries.index', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('pim.employees.edit', ['id' => $breadcrumb['parent_id'], 'title' => $breadcrumb['parent_title']]);
    $breadcrumbs->push(trans('app.pim.employees.salaries.main'), route('pim.employees.salaries.index', $breadcrumb['parent_id']));
});

// Home > PIM > Employees > Employee > External Accounts > Create
Breadcrumbs::register('pim.employees.salaries.create', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('pim.employees.salaries.index', $breadcrumb);
    $breadcrumbs->push(trans('app.add_record'), route('pim.employees.salaries.create', $breadcrumb['parent_id']));
});

// Home > PIM > Employees > Employee > External Accounts > Edit
Breadcrumbs::register('pim.employees.salaries.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('pim.employees.salaries.index', $breadcrumb);
    $breadcrumbs->push(trans('app.edit').': '.$breadcrumb['title'], route('pim.employees.salaries.edit', [$breadcrumb['parent_id'], $breadcrumb['id']]));
});

// Home > PIM > Employees > Employee > External Accounts > Details
Breadcrumbs::register('pim.employees.salaries.show', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('pim.employees.salaries.index');
    $breadcrumbs->push($breadcrumb['title'], route('pim.employees.salaries.show', $breadcrumb['id']));
});

/**
 * Employee salary breadcrumbs end here
 */

/**
 * Employee contact details breadcrumbs start here
 */

// Home > PIM > Employees > Employee > Contact details
Breadcrumbs::register('pim.employees.contact_details.index', function($breadcrumbs, $breadcrumb)
{
    if(@$breadcrumb['parent_type'] == 'candidate') {
        $breadcrumbs->parent('pim.candidates.edit', ['id' => $breadcrumb['parent_id'], 'title' => $breadcrumb['parent_title']]);
    } else {
        $breadcrumbs->parent('pim.employees.edit', ['id' => $breadcrumb['parent_id'], 'title' => $breadcrumb['parent_title']]);
    }
    $breadcrumbs->push(trans('app.pim.employees.contact_details.main'), route('pim.employees.contact_details.index', $breadcrumb['parent_id']));
});

/**
 * Employee contact details breadcrumbs end here
 */

/**
 * Employee preferences breadcrumbs start here
 */

// Home > PIM > Employees > Employee > Preferences
Breadcrumbs::register('pim.employees.preferences.index', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('pim.candidates.edit', ['id' => $breadcrumb['parent_id'], 'title' => $breadcrumb['parent_title']]);
    $breadcrumbs->push(trans('app.pim.candidates.preferences.main'), route('pim.employees.preferences.index', $breadcrumb['parent_id']));
});

/**
 * Employee preferences breadcrumbs end here
 */

/**
 * Employee qualifications breadcrumbs start here
 */

// Home > PIM > Employees > Employee > Qualifications
Breadcrumbs::register('pim.employees.qualifications.index', function($breadcrumbs, $breadcrumb)
{
    if(@$breadcrumb['parent_type'] == 'candidate') {
        $breadcrumbs->parent('pim.candidates.edit', ['id' => $breadcrumb['parent_id'], 'title' => $breadcrumb['parent_title']]);
    } else {
        $breadcrumbs->parent('pim.employees.edit', ['id' => $breadcrumb['parent_id'], 'title' => $breadcrumb['parent_title']]);
    }
    $breadcrumbs->push(trans('app.pim.employees.qualifications.main'), route('pim.employees.qualifications.index', $breadcrumb['parent_id']));
});

/**
 * Employee work experience breadcrumbs start here
 */

// Home > PIM > Employees > Employee > Qualifications > Add work Experience
Breadcrumbs::register('pim.employees.qualifications.work_experience.create', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('pim.employees.qualifications.index', $breadcrumb);
    $breadcrumbs->push(trans('app.pim.employees.qualifications.work_experience.add_new'), route('pim.employees.qualifications.work_experience.create', $breadcrumb['parent_id']));
});

// Home > PIM > Employees > Employee > Qualifications > Edit work experience
Breadcrumbs::register('pim.employees.qualifications.work_experience.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('pim.employees.qualifications.index', $breadcrumb);
    $breadcrumbs->push(trans('app.pim.employees.qualifications.work_experience.edit_details').': '.$breadcrumb['title'], route('pim.employees.qualifications.work_experience.edit', [$breadcrumb['parent_id'], $breadcrumb['id']]));
});

// Home > PIM > Employees > Employee > Qualifications > Edit work experience
Breadcrumbs::register('pim.employees.qualifications.work_experience.show', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('pim.employees.qualifications.index', $breadcrumb);
    $breadcrumbs->push($breadcrumb['title'], route('pim.employees.qualifications.work_experience.show', [$breadcrumb['parent_id'], $breadcrumb['id']]));
});

/**
 * Employee work experience breadcrumbs end here
 */

/**
 * Employee education breadcrumbs start here
 */

// Home > PIM > Employees > Employee > Qualifications > Add work Experience
Breadcrumbs::register('pim.employees.qualifications.education.create', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('pim.employees.qualifications.index', $breadcrumb);
    $breadcrumbs->push(trans('app.pim.employees.qualifications.education.add_new'), route('pim.employees.qualifications.education.create', $breadcrumb['parent_id']));
});

// Home > PIM > Employees > Employee > Qualifications > Edit work experience
Breadcrumbs::register('pim.employees.qualifications.education.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('pim.employees.qualifications.index', $breadcrumb);
    $breadcrumbs->push(trans('app.pim.employees.qualifications.education.edit_details').': '.$breadcrumb['title'], route('pim.employees.qualifications.education.edit', [$breadcrumb['parent_id'], $breadcrumb['id']]));
});

// Home > PIM > Employees > Employee > Qualifications > Edit work experience
Breadcrumbs::register('pim.employees.qualifications.education.show', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('pim.employees.qualifications.index', $breadcrumb);
    $breadcrumbs->push($breadcrumb['title'], route('pim.employees.qualifications.education.show', [$breadcrumb['parent_id'], $breadcrumb['id']]));
});

/**
 * Employee education breadcrumbs end here
 */

/**
 * Employee language breadcrumbs start here
 */

// Home > PIM > Employees > Employee > Qualifications > Add language
Breadcrumbs::register('pim.employees.qualifications.languages.create', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('pim.employees.qualifications.index', $breadcrumb);
    $breadcrumbs->push(trans('app.pim.employees.qualifications.languages.add_new'), route('pim.employees.qualifications.languages.create', $breadcrumb['parent_id']));
});

// Home > PIM > Employees > Employee > Qualifications > Edit work experience
Breadcrumbs::register('pim.employees.qualifications.languages.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('pim.employees.qualifications.index', $breadcrumb);
    $breadcrumbs->push(trans('app.pim.employees.qualifications.languages.edit_details').': '.$breadcrumb['title'], route('pim.employees.qualifications.languages.edit', [$breadcrumb['parent_id'], $breadcrumb['id']]));
});

// Home > PIM > Employees > Employee > Qualifications > Edit work experience
Breadcrumbs::register('pim.employees.qualifications.languages.show', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('pim.employees.qualifications.index', $breadcrumb);
    $breadcrumbs->push($breadcrumb['title'], route('pim.employees.qualifications.languages.show', [$breadcrumb['parent_id'], $breadcrumb['id']]));
});

/**
 * Employee language breadcrumbs end here
 */

/**
 * Employee qualifications breadcrumbs end here
 */

/**
 * Employee breadcrumbs end here
 */

/**
 * PIM breadcrumbs end here
 */


/**
 * Leave breadcrumbs start here
 */

// Home > Leave
Breadcrumbs::register('leave.index', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.leave.main'), route('leave.index'));
});

/**
 * Leave type breadcrumbs start here
 */

// Home > Leave > Leave types
Breadcrumbs::register('leave.leave_types.index', function($breadcrumbs)
{
    $breadcrumbs->parent('leave.index');
    $breadcrumbs->push(trans('app.leave.leave_types.main'), route('leave.leave_types.index'));
});

// Home > Leave > Leave types > Create
Breadcrumbs::register('leave.leave_types.create', function($breadcrumbs)
{
    $breadcrumbs->parent('leave.leave_types.index');
    $breadcrumbs->push(trans('app.add_record'), route('leave.leave_types.create'));
});

// Home > Leave > Leave types > Edit
Breadcrumbs::register('leave.leave_types.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('leave.leave_types.index');
    $breadcrumbs->push(trans('app.edit').': '.$breadcrumb['title'], route('leave.leave_types.edit', $breadcrumb['id']));
});

// Home > Leave > Leave types > Details
Breadcrumbs::register('leave.leave_types.show', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('leave.leave_types.index');
    $breadcrumbs->push($breadcrumb['title'], route('leave.leave_types.show', $breadcrumb['id']));
});

/**
 * Leave type breadcrumbs end here
 */

/**
 * Holiday breadcrumbs start here
 */

// Home > Leave > Holidays
Breadcrumbs::register('leave.holidays.index', function($breadcrumbs)
{
    $breadcrumbs->parent('leave.index');
    $breadcrumbs->push(trans('app.leave.holidays.main'), route('leave.holidays.index'));
});

// Home > Leave > Holidays > Create
Breadcrumbs::register('leave.holidays.create', function($breadcrumbs)
{
    $breadcrumbs->parent('leave.holidays.index');
    $breadcrumbs->push(trans('app.add_record'), route('leave.holidays.create'));
});

// Home > Leave > Holidays > Edit
Breadcrumbs::register('leave.holidays.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('leave.holidays.index');
    $breadcrumbs->push(trans('app.edit').': '.$breadcrumb['title'], route('leave.holidays.edit', $breadcrumb['id']));
});

// Home > Leave > Holidays > Details
Breadcrumbs::register('leave.holidays.show', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('leave.holidays.index');
    $breadcrumbs->push($breadcrumb['title'], route('leave.holidays.show', $breadcrumb['id']));
});

/**
 * Holiday breadcrumbs end here
 */

/**
 * Employee leave breadcrumbs start here
 */

// Home > Leave > Employee Leaves
Breadcrumbs::register('leave.employee_leaves.index', function($breadcrumbs)
{
    $breadcrumbs->parent('leave.index');
    $breadcrumbs->push(trans('app.leave.employee_leaves.main'), route('leave.employee_leaves.index'));
});

// Home > Leave > Employee Leaves > Create
Breadcrumbs::register('leave.employee_leaves.create', function($breadcrumbs)
{
    $breadcrumbs->parent('leave.employee_leaves.index');
    $breadcrumbs->push(trans('app.add_record'), route('leave.employee_leaves.create'));
});

// Home > Leave > Employee Leaves > Edit
Breadcrumbs::register('leave.employee_leaves.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('leave.employee_leaves.index');
    $breadcrumbs->push(trans('app.edit').': '.$breadcrumb['title'], route('leave.employee_leaves.edit', $breadcrumb['id']));
});

// Home > Leave > Employee Leaves > Details
Breadcrumbs::register('leave.employee_leaves.show', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('leave.employee_leaves.index');
    $breadcrumbs->push($breadcrumb['title'], route('leave.employee_leaves.show', $breadcrumb['id']));
});

/**
 * Employee leave breadcrumbs end here
 */

/**
 * Calendar breadcrumbs start here
 */

// Home > Leave > Calendar
Breadcrumbs::register('leave.calendar.index', function($breadcrumbs)
{
    $breadcrumbs->parent('leave.index');
    $breadcrumbs->push(trans('app.leave.calendar.main'), route('leave.calendar.index'));
});

/**
 * Calendar breadcrumbs end here
 */


/**
 * Leave breadcrumbs end here
 */

/**
 * Recruitment breadcrumbs start here
 */

// Home > Recruitment
Breadcrumbs::register('recruitment.index', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.recruitment.main'), route('recruitment.index'));
});

/**
 * Report breadcrumbs start here
 */

// Home > Recruitment > Reports
Breadcrumbs::register('recruitment.reports.index', function($breadcrumbs)
{
    $breadcrumbs->parent('recruitment.index');
    $breadcrumbs->push(trans('app.recruitment.reports.main'), route('recruitment.reports.index'));
});

// Home > Recruitment > Reports > Details
Breadcrumbs::register('recruitment.reports.show', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('recruitment.reports.index');
    $breadcrumbs->push($breadcrumb['title'], route('recruitment.reports.show', $breadcrumb['id']));
});

/**
 * Report breadcrumbs end here
 */

/**
 * Recruitment breadcrumbs end here
 */

/**
 * Discipline breadcrumbs start here
 */

// Home > Discipline
Breadcrumbs::register('discipline.index', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.discipline.main'), route('discipline.index'));
});

/**
 * Disciplinary cases breadcrumbs start here
 */

// Home > Discipline > Disciplinary cases
Breadcrumbs::register('discipline.disciplinary_cases.index', function($breadcrumbs)
{
    $breadcrumbs->parent('discipline.index');
    $breadcrumbs->push(trans('app.discipline.disciplinary_cases.main'), route('discipline.disciplinary_cases.index'));
});

// Home > Discipline > Disciplinary cases > Create
Breadcrumbs::register('discipline.disciplinary_cases.create', function($breadcrumbs)
{
    $breadcrumbs->parent('discipline.disciplinary_cases.index');
    $breadcrumbs->push(trans('app.add_record'), route('discipline.disciplinary_cases.create'));
});

// Home > Discipline > Disciplinary cases > Edit
Breadcrumbs::register('discipline.disciplinary_cases.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('discipline.disciplinary_cases.index');
    $breadcrumbs->push(trans('app.edit').': '.$breadcrumb['title'], route('discipline.disciplinary_cases.edit', $breadcrumb['id']));
});

// Home > Discipline > Disciplinary cases > Details
Breadcrumbs::register('discipline.disciplinary_cases.show', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('discipline.disciplinary_cases.index');
    $breadcrumbs->push($breadcrumb['title'], route('discipline.disciplinary_cases.show', $breadcrumb['id']));
});

/**
 * Disciplinary cases breadcrumbs end here
 */

/**
 * Time breadcrumbs end here
 */

// Home > Time
Breadcrumbs::register('time.index', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.time.main'), route('time.index'));
});

/**
 * Clients breadcrumbs start here
 */

// Home > Time > Clients
Breadcrumbs::register('time.clients.index', function($breadcrumbs)
{
    $breadcrumbs->parent('time.index');
    $breadcrumbs->push(trans('app.time.clients.main'), route('time.clients.index'));
});

// Home > Time > Clients > Create
Breadcrumbs::register('time.clients.create', function($breadcrumbs)
{
    $breadcrumbs->parent('time.clients.index');
    $breadcrumbs->push(trans('app.add_record'), route('time.clients.create'));
});

// Home > Time > Clients > Edit
Breadcrumbs::register('time.clients.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('time.clients.index');
    $breadcrumbs->push(trans('app.edit').': '.$breadcrumb['title'], route('time.clients.edit', $breadcrumb['id']));
});

// Home > Time > Clients > Details
Breadcrumbs::register('time.clients.show', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('time.clients.index');
    $breadcrumbs->push($breadcrumb['title'], route('time.clients.show', $breadcrumb['id']));
});

/**
 * Clients breadcrumbs end here
 */

/**
 * Projects breadcrumbs start here
 */

// Home > Time > Projects
Breadcrumbs::register('time.projects.index', function($breadcrumbs)
{
    $breadcrumbs->parent('time.index');
    $breadcrumbs->push(trans('app.time.projects.main'), route('time.projects.index'));
});

// Home > Time > Projects > Create
Breadcrumbs::register('time.projects.create', function($breadcrumbs)
{
    $breadcrumbs->parent('time.projects.index');
    $breadcrumbs->push(trans('app.add_record'), route('time.projects.create'));
});

// Home > Time > Projects > Edit
Breadcrumbs::register('time.projects.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('time.projects.index');
    $breadcrumbs->push(trans('app.edit').': '.$breadcrumb['title'], route('time.projects.edit', $breadcrumb['id']));
});

// Home > Time > Projects > Details
Breadcrumbs::register('time.projects.show', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('time.projects.index');
    $breadcrumbs->push($breadcrumb['title'], route('time.projects.show', $breadcrumb['id']));
});

/**
 * Projects breadcrumbs end here
 */

/**
 * Time logs breadcrumbs start here
 */

// Home > Time > Time logs
Breadcrumbs::register('time.time_logs.index', function($breadcrumbs)
{
    $breadcrumbs->parent('time.index');
    $breadcrumbs->push(trans('app.time.time_logs.main'), route('time.time_logs.index'));
});

// Home > Time > Time logs > Create
Breadcrumbs::register('time.time_logs.create', function($breadcrumbs)
{
    $breadcrumbs->parent('time.time_logs.index');
    $breadcrumbs->push(trans('app.add_record'), route('time.time_logs.create'));
});

// Home > Time > Time logs > Edit
Breadcrumbs::register('time.time_logs.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('time.time_logs.index');
    $breadcrumbs->push(trans('app.edit').': '.$breadcrumb['title'], route('time.time_logs.edit', $breadcrumb['id']));
});

// Home > Time > Time logs > Details
Breadcrumbs::register('time.time_logs.show', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('time.time_logs.index');
    $breadcrumbs->push($breadcrumb['title'], route('time.time_logs.show', $breadcrumb['id']));
});

Breadcrumbs::register('time.time_logs.employee_report', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('time.time_logs.index');
    $breadcrumbs->push($breadcrumb['title'], route('time.time_logs.employee_report', $breadcrumb['id']));
});

Breadcrumbs::register('time.time_logs.salary_report', function($breadcrumbs)
{
    $breadcrumbs->parent('time.time_logs.index');
    $breadcrumbs->push(trans('app.pim.employees.salaries.salary_report'), route('time.time_logs.salary_report'));
});

/**
 * Time logs breadcrumbs end here
 */

/**
 * Time breadcrumbs end here
 */

/**
 * Dashboard breadcrumbs start here
 */
Breadcrumbs::register('dashboard.index', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push(trans('app.dashboard.main'), route('dashboard.index'));
});

/**
 * Document breadcrumbs start here
 */
// Home > Dashboard > Documents
Breadcrumbs::register('dashboard.documents.index', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard.index');
    $breadcrumbs->push(trans('app.dashboard.documents.main'), route('dashboard.documents.index'));
});

Breadcrumbs::register('dashboard.documents.create', function($breadcrumbs)
{
    $breadcrumbs->parent('dashboard.documents.index');
    $breadcrumbs->push(trans('app.dashboard.documents.add_new'), route('dashboard.documents.create'));
});

Breadcrumbs::register('dashboard.documents.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('dashboard.documents.index');
    $breadcrumbs->push(trans('app.edit').': '.$breadcrumb['title'], route('dashboard.documents.edit', $breadcrumb['id']));
});

/**
 * Document breadcrumbs end here
 */

/**
 * Dashboard breadcrumbs end here
 */

Breadcrumbs::register('employee.home', function($breadcrumbs)
{
    $breadcrumbs->push(trans('app.home'), route('employee.home'));
});

Breadcrumbs::register('employee.documents.index', function($breadcrumbs)
{
    $breadcrumbs->parent('employee.home');
    $breadcrumbs->push(trans('app.pim.employees.documents.main'), route('employee.documents.index'));
});

Breadcrumbs::register('employee.salary.index', function($breadcrumbs)
{
    $breadcrumbs->parent('employee.home');
    $breadcrumbs->push(trans('app.employee.salary.main'), route('employee.salary.index'));
});

Breadcrumbs::register('employee.salary.show', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('employee.salary.index');
    $breadcrumbs->push($breadcrumb['title'], route('employee.salary.show', $breadcrumb['id']));

});

Breadcrumbs::register('employee.time.index', function($breadcrumbs)
{
    $breadcrumbs->parent('employee.home');
    $breadcrumbs->push(trans('app.time.main'), route('employee.time.index'));
});

Breadcrumbs::register('employee.time.create', function($breadcrumbs)
{
    $breadcrumbs->parent('employee.time.index');
    $breadcrumbs->push(trans('app.add_record'), route('employee.time.create'));
});

Breadcrumbs::register('employee.time.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('employee.time.index');
    $breadcrumbs->push(trans('app.edit').': '.$breadcrumb['title'], route('employee.time.edit', $breadcrumb['id']));
});

Breadcrumbs::register('employee.time.report', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('employee.time.index');
    $breadcrumbs->push(trans('app.time.time_logs.report'));
});

Breadcrumbs::register('employee.leaves.index', function($breadcrumbs)
{
    $breadcrumbs->parent('employee.home');
    $breadcrumbs->push(trans('app.employee.leaves.main'), route('employee.leaves.index'));
});

Breadcrumbs::register('employee.leaves.create', function($breadcrumbs)
{
    $breadcrumbs->parent('employee.leaves.index');
    $breadcrumbs->push(trans('app.add_record'), route('employee.leaves.create'));
});

Breadcrumbs::register('employee.leaves.show', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('employee.leaves.index');
    $breadcrumbs->push($breadcrumb['title'], route('employee.leaves.show', $breadcrumb['id']));
});

Breadcrumbs::register('employee.leaves.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('employee.leaves.index');
    $breadcrumbs->push(trans('app.edit') . ': '.$breadcrumb['title'], route('employee.leaves.edit', $breadcrumb['id']));
});

Breadcrumbs::register('employee.dashboard_documents.index', function($breadcrumbs)
{
    $breadcrumbs->parent('employee.home');
    $breadcrumbs->push(trans('app.dashboard.documents.main'), route('employee.dashboard_documents.index'));
});
