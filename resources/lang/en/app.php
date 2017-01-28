<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Application Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines are used throughout the application for various
    | texts that we need to display to the user. You are free to modify
    | these language lines according to your application's requirements.
    |
    */

    'add_record' => 'Add record',
    'id' => 'ID',
    'submit' => 'Submit',
    'cancel' => 'Cancel',
    'edit' => 'Edit',
    'delete' => 'Delete',
    'show' => 'Details',
    'confirm' => 'Confirm',
    'filter' => 'Filter',
    'close' => 'Close',
    'no_data' => 'No data',
    'confirm_action' => 'Confirm action',
    'proceed_question' => 'Are you sure you want to proceed with this action?',
    'yes' => 'Yes',
    'no' => 'No',

    'settings' => [
        'companies' => [
            'main' => 'Companies',
            'add_new' => 'Add company',
            'edit_details' => 'Edit company details',
            'name' => 'Name',
            'store_success' => 'The company was successfully added.',
            'update_success' => 'The company was successfully updated.',
            'delete_success' => 'The company was successfully removed.',
        ],
        'contract_types' => [
            'main' => 'Contract types',
            'add_new' => 'Add contract type',
            'edit_details' => 'Edit contract type details',
            'name' => 'Name',
            'store_success' => 'The contract type was successfully added.',
            'update_success' => 'The contract type was successfully updated.',
            'delete_success' => 'The contract type was successfully removed.',
        ],
        'education_institutions' => [
            'main' => 'Education Institutions',
            'add_new' => 'Add education institution',
            'edit_details' => 'Edit education institution details',
            'name' => 'Name',
            'store_success' => 'The educational institution was successfully added.',
            'update_success' => 'The educational institution was successfully updated.',
            'delete_success' => 'The educational institution was successfully removed.',
        ],
        'job_positions' => [
            'main' => 'Job Positions',
            'add_new' => 'Add job position',
            'edit_details' => 'Edit job position details',
            'name' => 'Name',
            'description' => 'Description',
            'attachment' => 'Attachment',
            'store_success' => 'The job position was successfully added.',
            'update_success' => 'The job position was successfully updated.',
            'delete_success' => 'The job position was successfully removed.',
        ],
        'languages' => [
            'main' => 'Languages',
            'add_new' => 'Add language',
            'edit_details' => 'Edit language details',
            'name' => 'Name',
            'store_success' => 'The language was successfully added.',
            'update_success' => 'The language was successfully updated.',
            'delete_success' => 'The language was successfully removed.',
        ],
        'salary_components' => [
            'main' => 'Salary Components',
            'add_new' => 'Add salary components',
            'edit_details' => 'Edit salary component details',
            'name' => 'Name',
            'contract_type' => 'Contract type',
            'type' => 'Type',
            'is_cost' => 'Cost to company?',
            'store_success' => 'The salary component was successfully added.',
            'update_success' => 'The salary component was successfully updated.',
            'delete_success' => 'The salary component was successfully removed.',
            'types' => [
                'earning' => 'Earning',
                'deduction' => 'Deduction'
            ]
        ]
    ],
    'pim' => [
        'employees' => [
            'main' => 'Employees',
            'add_new' => 'Add employee',
            'edit_details' => 'Edit employee details',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'email' => 'Email',
            'job_title' => 'Job title',
            'contract_type' => 'Employment status',
            'gender' => 'Gender',
            'gender_male' => 'Male',
            'gender_female' => 'Female',
            'birth_date' => 'Birth date',
            'store_success' => 'The employee was successfully added.',
            'update_success' => 'The employee details were successfully updated.',
            'delete_success' => 'The employee was successfully removed.',
            'additional' => 'Additional details',
            'external_accounts' => [
                'main' => 'External accounts',
                'add_new' => 'Add external account',
                'edit_details' => 'Edit external account',
                'account' => 'Account',
                'account_type' => 'Account type',
                'url' => 'URL',
                'store_success' => 'The external account was successfully added.',
                'update_success' => 'The external account details were successfully updated.',
                'delete_success' => 'The external account was successfully removed.',
            ],
            'contact_details' => [
                'main' => 'Contact details',
                'add_new' => 'Add contact details',
                'edit_details' => 'Edit contact details',
                'address' => 'Address',
                'phone_numbers' => 'Phone numbers',
                'address1' => 'Street 1',
                'address2' => 'Street 2',
                'city' => 'City',
                'state' => 'State',
                'zip' => 'Zip / Postal Code',
                'country' => 'Country',
                'phone1' => 'Phone 1',
                'phone2' => 'Phone 2',
                'phone3' => 'Phone 3',
                'store_success' => 'The contact details were successfully added.',
                'update_success' => 'The contact details were successfully updated.',
            ],
            'qualifications' => [
                'main' => 'Qualifications',
                'skills' => 'Skills',
                'work_experience' => [
                    'main' => 'Work experience',
                    'add_new' => 'Add work experience',
                    'edit_details' => 'Edit work experience',
                    'job_title' => 'Job Title',
                    'start_date' => 'Start date',
                    'end_date' => 'End date',
                    'company_name' => 'Company name',
                    'comments' => 'Comments',
                    'store_success' => 'The work experience was successfully added.',
                    'update_success' => 'The work experience details were successfully updated.',
                    'delete_success' => 'The work experience was successfully removed.',
                ],
                'education' => [
                    'main' => 'Education',
                    'add_new' => 'Add education',
                    'edit_details' => 'Edit education details',
                    'type' => 'Type',
                    'institution' => 'Institution',
                    'major' => 'Major',
                    'year' => 'Year',
                    'grade' => 'Grade',
                    'start_date' => 'Start date',
                    'end_date' => 'End date',    
                    'store_success' => 'The education details were successfully added.',
                    'update_success' => 'The education details were successfully updated.',
                    'delete_success' => 'The education details were successfully removed.',
                    'education_types' => [
                        'bachelor' => "Bachelor's degree",
                        'master' => "Master's degree",
                        'academy' => "Academy certificate",
                        'undergrad' => "Undergraduate"
                    ]
                ],
                'languages' => [
                    'main' => 'Languages',
                    'add_new' => 'Add language',
                    'edit_details' => 'Edit language',
                    'language' => 'Language',
                    'level' => 'Level',
                    'skill' => 'Skill',
                    'store_success' => 'The language was successfully added to the profile.',
                    'update_success' => 'The language details were successfully updated.',
                    'delete_success' => 'The language was successfully removed.',
                    'skills' => [
                        'write' => 'Written',
                        'speak' => 'Spoken',
                        'both' => 'Written and Spoken',
                    ],
                    'levels' => [
                        'beginner' => 'Beginner',
                        'intermediate' => 'Intermediate',
                        'fluent' => 'Fluent',
                        'native' => 'Native',
                    ]
                ]
            ],
            'salaries' => [
                'main' => 'Salaries',
                'add_new' => 'Add salary record',
                'edit_details' => 'Edit salary record',
                'salary_history' => 'Salary history',
                'gross_total' => 'Gross total',
                'nett_total' => 'Nett total',
                'payment_date' => 'Payment date',
                'store_success' => 'The salary record was successfully added.',
                'update_success' => 'The salary details were successfully updated.',
                'delete_success' => 'The salary record was successfully removed.',
            ]
        ],
        'candidates' => [
            'main' => 'Candidates',
            'add_new' => 'Add candidate',
            'edit_details' => 'Edit candidate details',
            'store_success' => 'The candidate was successfully added.',
            'update_success' => 'The candidate details were successfully updated.',
            'delete_success' => 'The candidate was successfully removed.',
            'additional' => 'Additional details',
            'preferences' => [
                'main' => 'Preferences and expectations',
                'add_new' => 'Add preferences',
                'edit_details' => 'Edit preferences',
                'salary' => 'Minimal salary',
                'contract_type' => 'Contract type',
                'comments' => 'Comments',
                'location' => [
                    'main' => 'Location',
                    'remote' => 'Remote',
                    'inhouse' => 'Inhouse'
                ],
                'store_success' => 'The candidate preferences were successfully added.',
                'update_success' => 'The candidate preferences were successfully updated.',
                'delete_success' => 'The candidate preferences were successfully removed.',
            ]
        ]
    ],
    'leave' => [
        'leave_types' => [
            'main' => 'Leave types',
            'add_new' => 'Add leave type',
            'edit_details' => 'Edit leave details',
            'name' => 'Leave',
            'available_days' => 'Available days',
            'start_date' => 'Start date',
            'end_date' => 'End date',
            'store_success' => 'Leave type was successfully added.',
            'update_success' => 'Leave type was successfully updated.',
            'delete_success' => 'Leave type was successfully deleted.',
        ],
        'employee_leaves' => [
            'main' => 'Employee leaves',
            'add_new' => 'Assign new leave',
            'edit_details' => 'Edit leave',
            'employee' => 'Employee',
            'leave' => 'Leave',
            'start_date' => 'Start date',
            'end_date' => 'End date',
            'store_success' => 'Leave was successfully assigned.',
            'update_success' => 'Leave was successfully updated.',
            'delete_success' => 'Leave was successfully deleted.',
            'error_no_available_days' => 'The leave request exceeds the total available days. There are :days days left.',
        ],
        'holidays' => [
            'main' => 'Holidays',
            'add_new' => 'Add holiday',
            'edit_details' => 'Edit holiday details',
            'name' => 'Holiday',
            'date' => 'Date',
            'store_success' => 'Holiday successfully added.',
            'update_success' => 'Holiday successfully updated.',
            'delete_success' => 'Holiday successfully deleted.',
        ],
        'calendar' => [
            'main' => 'Calendar',
        ]
    ],
    'recruitment' => [
        'main' => 'Recruitment',
        'reports' => [
            'main' => 'Reports',
            'first_name' => 'First name',
            'last_name' => 'Last name',
            'email' => 'Email',
            'phone' => 'Phone',
            'skills' => 'Skills',
            'languages' => 'Languages',
            'experience' => 'Experience',
            'education' => 'Education',
            'salary' => 'Expected salary',
            'contract_type' => 'Prefered contract type',
            'location' => 'Prefered location',
            'comments' => 'Comments',
            'min_salary' => 'Min Salary',
            'max_salary' => 'Max Salary',
            'salary_range' => 'Salary Range',
            'show' => [
                'personal_details' => 'Personal details',
            ]
        ]
    ]
];
