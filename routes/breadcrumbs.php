<?php

// Home
Breadcrumbs::register('home', function($breadcrumbs)
{
    $breadcrumbs->push('Home', route('home'));
});

/**
 * Settings breadcrumbs start here
 */

// Home > Settings
Breadcrumbs::register('settings.index', function($breadcrumbs)
{
    $breadcrumbs->parent('home');
    $breadcrumbs->push('Settings', route('settings.index'));
});

/**
 * Job positions breadcrumbs start here
 */

// Home > Settings > Job Positions
Breadcrumbs::register('settings.job_positions.index', function($breadcrumbs)
{
    $breadcrumbs->parent('settings.index');
    $breadcrumbs->push('Job Positions', route('settings.job_positions.index'));
});

// Home > Settings > Job Positions > Create
Breadcrumbs::register('settings.job_positions.create', function($breadcrumbs)
{
    $breadcrumbs->parent('settings.job_positions.index');
    $breadcrumbs->push('Create', route('settings.job_positions.create'));
});

// Home > Settings > Job Positions > Edit
Breadcrumbs::register('settings.job_positions.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('settings.job_positions.index');
    $breadcrumbs->push('Edit: '.$breadcrumb['title'], route('settings.job_positions.edit', $breadcrumb['id']));
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
    $breadcrumbs->push('Companies', route('settings.companies.index'));
});

// Home > Settings > Companies > Create
Breadcrumbs::register('settings.companies.create', function($breadcrumbs)
{
    $breadcrumbs->parent('settings.companies.index');
    $breadcrumbs->push('Create', route('settings.companies.create'));
});

// Home > Settings > Companies > Edit
Breadcrumbs::register('settings.companies.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('settings.companies.index');
    $breadcrumbs->push('Edit: '.$breadcrumb['title'], route('settings.companies.edit', $breadcrumb['id']));
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
    $breadcrumbs->push('Contract types', route('settings.contract_types.index'));
});

// Home > Settings > Contract types > Create
Breadcrumbs::register('settings.contract_types.create', function($breadcrumbs)
{
    $breadcrumbs->parent('settings.contract_types.index');
    $breadcrumbs->push('Create', route('settings.contract_types.create'));
});

// Home > Settings > Contract types > Edit
Breadcrumbs::register('settings.contract_types.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('settings.contract_types.index');
    $breadcrumbs->push('Edit: '.$breadcrumb['title'], route('settings.contract_types.edit', $breadcrumb['id']));
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
 * Education institutions breadcrumbs start here
 */

// Home > Settings > Education institutions
Breadcrumbs::register('settings.education_institutions.index', function($breadcrumbs)
{
    $breadcrumbs->parent('settings.index');
    $breadcrumbs->push('Education institutions', route('settings.education_institutions.index'));
});

// Home > Settings > Education institutions > Create
Breadcrumbs::register('settings.education_institutions.create', function($breadcrumbs)
{
    $breadcrumbs->parent('settings.education_institutions.index');
    $breadcrumbs->push('Create', route('settings.education_institutions.create'));
});

// Home > Settings > Education institutions > Edit
Breadcrumbs::register('settings.education_institutions.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('settings.education_institutions.index');
    $breadcrumbs->push('Edit: '.$breadcrumb['title'], route('settings.education_institutions.edit', $breadcrumb['id']));
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
    $breadcrumbs->push('Languages', route('settings.languages.index'));
});

// Home > Settings > Languages > Create
Breadcrumbs::register('settings.languages.create', function($breadcrumbs)
{
    $breadcrumbs->parent('settings.languages.index');
    $breadcrumbs->push('Create', route('settings.languages.create'));
});

// Home > Settings > Languages > Edit
Breadcrumbs::register('settings.languages.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('settings.languages.index');
    $breadcrumbs->push('Edit: '.$breadcrumb['title'], route('settings.languages.edit', $breadcrumb['id']));
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
    $breadcrumbs->push('Salary components', route('settings.salary_components.index'));
});

// Home > Settings > Salary components > Create
Breadcrumbs::register('settings.salary_components.create', function($breadcrumbs)
{
    $breadcrumbs->parent('settings.salary_components.index');
    $breadcrumbs->push('Create', route('settings.salary_components.create'));
});

// Home > Settings > Salary components > Edit
Breadcrumbs::register('settings.salary_components.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('settings.salary_components.index');
    $breadcrumbs->push('Edit: '.$breadcrumb['title'], route('settings.salary_components.edit', $breadcrumb['id']));
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
    $breadcrumbs->push('PIM', route('pim.index'));
});

/**
 * Candidates breadcrumbs start here
 */

// Home > PIM > Candidates
Breadcrumbs::register('pim.candidates.index', function($breadcrumbs)
{
    $breadcrumbs->parent('pim.index');
    $breadcrumbs->push('Candidates', route('pim.candidates.index'));
});

// Home > PIM > Candidates > Create
Breadcrumbs::register('pim.candidates.create', function($breadcrumbs)
{
    $breadcrumbs->parent('pim.candidates.index');
    $breadcrumbs->push('Create', route('pim.candidates.create'));
});

// Home > PIM > Candidates > Edit
Breadcrumbs::register('pim.candidates.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('pim.candidates.index');
    $breadcrumbs->push('Edit: '.$breadcrumb['title'], route('pim.candidates.edit', $breadcrumb['id']));
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
    $breadcrumbs->push('Employees', route('pim.employees.index'));
});

// Home > PIM > Employees > Create
Breadcrumbs::register('pim.employees.create', function($breadcrumbs)
{
    $breadcrumbs->parent('pim.employees.index');
    $breadcrumbs->push('Create', route('pim.employees.create'));
});

// Home > PIM > Employees > Edit
Breadcrumbs::register('pim.employees.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('pim.employees.index');
    $breadcrumbs->push('Edit: '.$breadcrumb['title'], route('pim.employees.edit', $breadcrumb['id']));
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
    $breadcrumbs->parent('pim.employees.edit', ['id' => $breadcrumb['parent_id'], 'title' => $breadcrumb['parent_title']]);
    $breadcrumbs->push('External Accounts', route('pim.employees.social_media.index', $breadcrumb['parent_id']));
});

// Home > PIM > Employees > Employee > External Accounts > Create
Breadcrumbs::register('pim.employees.social_media.create', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('pim.employees.social_media.index', $breadcrumb);
    $breadcrumbs->push('Create', route('pim.employees.social_media.create', $breadcrumb['parent_id']));
});

// Home > PIM > Employees > Employee > External Accounts > Edit
Breadcrumbs::register('pim.employees.social_media.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('pim.employees.social_media.index', $breadcrumb);
    $breadcrumbs->push('Edit: '.$breadcrumb['title'], route('pim.employees.social_media.edit', [$breadcrumb['parent_id'], $breadcrumb['id']]));
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
 * Employee salary breadcrumbs start here
 */

// Home > PIM > Employees > Employee > External Accounts
Breadcrumbs::register('pim.employees.salaries.index', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('pim.employees.edit', ['id' => $breadcrumb['parent_id'], 'title' => $breadcrumb['parent_title']]);
    $breadcrumbs->push('Salaries', route('pim.employees.salaries.index', $breadcrumb['parent_id']));
});

// Home > PIM > Employees > Employee > External Accounts > Create
Breadcrumbs::register('pim.employees.salaries.create', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('pim.employees.salaries.index', $breadcrumb);
    $breadcrumbs->push('Create', route('pim.employees.salaries.create', $breadcrumb['parent_id']));
});

// Home > PIM > Employees > Employee > External Accounts > Edit
Breadcrumbs::register('pim.employees.salaries.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('pim.employees.salaries.index', $breadcrumb);
    $breadcrumbs->push('Edit: '.$breadcrumb['title'], route('pim.employees.salaries.edit', [$breadcrumb['parent_id'], $breadcrumb['id']]));
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
    $breadcrumbs->parent('pim.employees.edit', ['id' => $breadcrumb['parent_id'], 'title' => $breadcrumb['parent_title']]);
    $breadcrumbs->push('Contact details', route('pim.employees.contact_details.index', $breadcrumb['parent_id']));
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
    $breadcrumbs->parent('pim.employees.edit', ['id' => $breadcrumb['parent_id'], 'title' => $breadcrumb['parent_title']]);
    $breadcrumbs->push('Preferences', route('pim.employees.preferences.index', $breadcrumb['parent_id']));
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
    $breadcrumbs->parent('pim.employees.edit', ['id' => $breadcrumb['parent_id'], 'title' => $breadcrumb['parent_title']]);
    $breadcrumbs->push('Qualifications', route('pim.employees.qualifications.index', $breadcrumb['parent_id']));
});

/**
 * Employee work experience breadcrumbs start here
 */

// Home > PIM > Employees > Employee > Qualifications > Add work Experience
Breadcrumbs::register('pim.employees.qualifications.work_experience.create', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('pim.employees.qualifications.index', $breadcrumb);
    $breadcrumbs->push('Add work experience', route('pim.employees.qualifications.work_experience.create', $breadcrumb['parent_id']));
});

// Home > PIM > Employees > Employee > Qualifications > Edit work experience
Breadcrumbs::register('pim.employees.qualifications.work_experience.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('pim.employees.qualifications.index', $breadcrumb);
    $breadcrumbs->push('Edit work experience: '.$breadcrumb['title'], route('pim.employees.qualifications.work_experience.edit', [$breadcrumb['parent_id'], $breadcrumb['id']]));
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
    $breadcrumbs->push('Add education', route('pim.employees.qualifications.education.create', $breadcrumb['parent_id']));
});

// Home > PIM > Employees > Employee > Qualifications > Edit work experience
Breadcrumbs::register('pim.employees.qualifications.education.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('pim.employees.qualifications.index', $breadcrumb);
    $breadcrumbs->push('Edit education: '.$breadcrumb['title'], route('pim.employees.qualifications.education.edit', [$breadcrumb['parent_id'], $breadcrumb['id']]));
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
    $breadcrumbs->push('Add language', route('pim.employees.qualifications.languages.create', $breadcrumb['parent_id']));
});

// Home > PIM > Employees > Employee > Qualifications > Edit work experience
Breadcrumbs::register('pim.employees.qualifications.languages.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('pim.employees.qualifications.index', $breadcrumb);
    $breadcrumbs->push('Edit language: '.$breadcrumb['title'], route('pim.employees.qualifications.languages.edit', [$breadcrumb['parent_id'], $breadcrumb['id']]));
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
    $breadcrumbs->push('Leave', route('leave.index'));
});

/**
 * Leave type breadcrumbs start here
 */

// Home > Leave > Leave types
Breadcrumbs::register('leave.leave_types.index', function($breadcrumbs)
{
    $breadcrumbs->parent('leave.index');
    $breadcrumbs->push('Leave types', route('leave.leave_types.index'));
});

// Home > Leave > Leave types > Create
Breadcrumbs::register('leave.leave_types.create', function($breadcrumbs)
{
    $breadcrumbs->parent('leave.leave_types.index');
    $breadcrumbs->push('Create', route('leave.leave_types.create'));
});

// Home > Leave > Leave types > Edit
Breadcrumbs::register('leave.leave_types.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('leave.leave_types.index');
    $breadcrumbs->push('Edit: '.$breadcrumb['title'], route('leave.leave_types.edit', $breadcrumb['id']));
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
    $breadcrumbs->push('Holidays', route('leave.holidays.index'));
});

// Home > Leave > Holidays > Create
Breadcrumbs::register('leave.holidays.create', function($breadcrumbs)
{
    $breadcrumbs->parent('leave.holidays.index');
    $breadcrumbs->push('Create', route('leave.holidays.create'));
});

// Home > Leave > Holidays > Edit
Breadcrumbs::register('leave.holidays.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('leave.holidays.index');
    $breadcrumbs->push('Edit: '.$breadcrumb['title'], route('leave.holidays.edit', $breadcrumb['id']));
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
    $breadcrumbs->push('Employee leaves', route('leave.employee_leaves.index'));
});

// Home > Leave > Employee Leaves > Create
Breadcrumbs::register('leave.employee_leaves.create', function($breadcrumbs)
{
    $breadcrumbs->parent('leave.employee_leaves.index');
    $breadcrumbs->push('Create', route('leave.employee_leaves.create'));
});

// Home > Leave > Employee Leaves > Edit
Breadcrumbs::register('leave.employee_leaves.edit', function($breadcrumbs, $breadcrumb)
{
    $breadcrumbs->parent('leave.employee_leaves.index');
    $breadcrumbs->push('Edit: '.$breadcrumb['title'], route('leave.employee_leaves.edit', $breadcrumb['id']));
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
    $breadcrumbs->push('Calendar', route('leave.calendar.index'));
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
    $breadcrumbs->push('Recruitment', route('recruitment.index'));
});

/**
 * Report breadcrumbs start here
 */

// Home > Recruitment > Reports
Breadcrumbs::register('recruitment.reports.index', function($breadcrumbs)
{
    $breadcrumbs->parent('leave.index');
    $breadcrumbs->push('Reports', route('recruitment.reports.index'));
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