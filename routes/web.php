<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return redirect()->to('/login');
});
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function() {
    Route::get('/', '\App\Http\Controllers\HomeController@index')->name('home');
    Route::get('/storage/{path}', function($path) {
        return response()->file(storage_path().'/app/'.$path);
    })->name('storage')->where('path','(.*)')->middleware(['auth', 'admin']);
    Route::resource('profile', '\App\Http\Controllers\ProfileController', 
        [
            'middleware' => ['auth', 'admin'], 
            'only' => ['index', 'store'],
            'names' => [
                'index' => 'profile.index',
                'store' => 'profile.store',
            ]
        ]
    );
    Route::group(['prefix' => 'settings', 'as' => 'settings.', 'middleware' => ['auth', 'admin']], function () {
        Route::get('/', function() {
            return view('settings::index');
        })->name('index');
        Route::get('companies/datatable', '\App\Modules\Settings\Http\Controllers\CompaniesController@getDatatable')
            ->name('companies.datatable');
        
        Route::resource('companies', '\App\Modules\Settings\Http\Controllers\CompaniesController', ['names' => [
            'index' => 'companies.index',
            'create' => 'companies.create',
            'show' => 'companies.show',
            'edit' => 'companies.edit',
            'store' => 'companies.store',
            'update' => 'companies.update',
            'destroy' => 'companies.destroy'
        ]]);
        Route::get('contract-types/datatable', '\App\Modules\Settings\Http\Controllers\ContractTypesController@getDatatable')
            ->name('contract_types.datatable');
        
        Route::resource('contract-types', '\App\Modules\Settings\Http\Controllers\ContractTypesController', ['names' => [
            'index' => 'contract_types.index',
            'create' => 'contract_types.create',
            'show' => 'contract_types.show',
            'edit' => 'contract_types.edit',
            'store' => 'contract_types.store',
            'update' => 'contract_types.update',
            'destroy' => 'contract_types.destroy'
        ]]);
        Route::get('document-templates/datatable', '\App\Modules\Settings\Http\Controllers\DocumentTemplatesController@getDatatable')
            ->name('document_templates.datatable');
        
        Route::resource('document-templates', '\App\Modules\Settings\Http\Controllers\DocumentTemplatesController', ['names' => [
            'index' => 'document_templates.index',
            'create' => 'document_templates.create',
            'show' => 'document_templates.show',
            'edit' => 'document_templates.edit',
            'store' => 'document_templates.store',
            'update' => 'document_templates.update',
            'destroy' => 'document_templates.destroy'
        ]]);
        Route::get('education-institutions/datatable', '\App\Modules\Settings\Http\Controllers\EducationInstitutionsController@getDatatable')
            ->name('education_institutions.datatable');
        
        Route::resource('education-institutions', '\App\Modules\Settings\Http\Controllers\EducationInstitutionsController', ['names' => [
            'index' => 'education_institutions.index',
            'create' => 'education_institutions.create',
            'show' => 'education_institutions.show',
            'edit' => 'education_institutions.edit',
            'store' => 'education_institutions.store',
            'update' => 'education_institutions.update',
            'destroy' => 'education_institutions.destroy'
        ]]);
        Route::get('job-positions/datatable', '\App\Modules\Settings\Http\Controllers\JobPositionsController@getDatatable')
            ->name('job_positions.datatable');
        
        Route::resource('job-positions', '\App\Modules\Settings\Http\Controllers\JobPositionsController', ['names' => [
            'index' => 'job_positions.index',
            'create' => 'job_positions.create',
            'show' => 'job_positions.show',
            'edit' => 'job_positions.edit',
            'store' => 'job_positions.store',
            'update' => 'job_positions.update',
            'destroy' => 'job_positions.destroy'
        ]]);
        Route::get('languages/datatable', '\App\Modules\Settings\Http\Controllers\LanguagesController@getDatatable')
            ->name('languages.datatable');
        Route::resource('languages', '\App\Modules\Settings\Http\Controllers\LanguagesController', ['names' => [
            'index' => 'languages.index',
            'create' => 'languages.create',
            'show' => 'languages.show',
            'edit' => 'languages.edit',
            'store' => 'languages.store',
            'update' => 'languages.update',
            'destroy' => 'languages.destroy'
        ]]);
        Route::get('salary-components/datatable', '\App\Modules\Settings\Http\Controllers\SalaryComponentsController@getDatatable')
            ->name('salary_components.datatable');
        
        Route::resource('salary-components', '\App\Modules\Settings\Http\Controllers\SalaryComponentsController', ['names' => [
            'index' => 'salary_components.index',
            'create' => 'salary_components.create',
            'show' => 'salary_components.show',
            'edit' => 'salary_components.edit',
            'store' => 'salary_components.store',
            'update' => 'salary_components.update',
            'destroy' => 'salary_components.destroy'
        ]]);
    });
    Route::group(['prefix' => 'pim', 'as' => 'pim.', 'middleware' => ['auth', 'admin']], function() {
        Route::get('/', function() {
            return view('pim::index');
        })->name('index');
        
        Route::get('employees/birthdays', '\App\Modules\Pim\Http\Controllers\EmployeesController@birthdays')->name('employees.birthdays');
        Route::get('employees/datatable', '\App\Modules\Pim\Http\Controllers\EmployeesController@getDatatable')
            ->name('employees.datatable');
        Route::get('employees/select-json', '\App\Modules\Pim\Http\Controllers\EmployeesController@getSelectJson')
            ->name('employees.select_json');
        Route::get('employees/select-2-selection', '\App\Modules\Pim\Http\Controllers\EmployeesController@getSelect2Selection')
            ->name('employees.select2_selection');
        Route::resource('employees', '\App\Modules\Pim\Http\Controllers\EmployeesController', ['names' => [
            'index' => 'employees.index',
            'create' => 'employees.create',
            'show' => 'employees.show',
            'edit' => 'employees.edit',
            'store' => 'employees.store',
            'update' => 'employees.update',
            'destroy' => 'employees.destroy'
        ]]);
        Route::get('candidates/datatable', '\App\Modules\Pim\Http\Controllers\CandidatesController@getDatatable')
            ->name('candidates.datatable');
        Route::resource('candidates', '\App\Modules\Pim\Http\Controllers\CandidatesController', ['names' => [
            'index' => 'candidates.index',
            'create' => 'candidates.create',
            'show' => 'candidates.show',
            'edit' => 'candidates.edit',
            'store' => 'candidates.store',
            'update' => 'candidates.update',
            'destroy' => 'candidates.destroy'
        ]]);
        Route::group(['prefix' => 'profile/{employeeId}', 'as' => 'employees.'], function($employeeId) {
            Route::resource('social-media', '\App\Modules\Pim\Http\Controllers\EmployeeSocialMediaController', ['names' => [
                'index' => 'social_media.index',
                'create' => 'social_media.create',
                'show' => 'social_media.show',
                'edit' => 'social_media.edit',
                'store' => 'social_media.store',
                'update' => 'social_media.update',
                'destroy' => 'social_media.destroy'
            ]]);  
            Route::get('documents/datatable', '\App\Modules\Pim\Http\Controllers\EmployeeDocumentsController@getDatatable')
            ->name('documents.datatable');
            Route::get('documents/generate', '\App\Modules\Pim\Http\Controllers\EmployeeDocumentsController@generate')
            ->name('documents.generate');
            Route::post('documents/template-content', '\App\Modules\Pim\Http\Controllers\EmployeeDocumentsController@generateTemplateContent')
            ->name('documents.template_content');
            
            Route::resource('documents', '\App\Modules\Pim\Http\Controllers\EmployeeDocumentsController', ['names' => [
                'index' => 'documents.index',
                'create' => 'documents.create',
                'show' => 'documents.show',
                'edit' => 'documents.edit',
                'store' => 'documents.store',
                'update' => 'documents.update',
                'destroy' => 'documents.destroy'
            ]]);  
            Route::resource('contact-details', '\App\Modules\Pim\Http\Controllers\EmployeeContactDetailsController', [
                'only' => [
                    'index',
                    'store',
                    'update'
                ],
                'names' => [
                    'index' => 'contact_details.index',
                    'store' => 'contact_details.store',
                    'update' => 'contact_details.update'
                ]
            ]);  
            Route::get('salaries/datatable', '\App\Modules\Pim\Http\Controllers\EmployeeSalaryController@getDatatable')
            ->name('salaries.datatable');
            Route::resource('salaries', '\App\Modules\Pim\Http\Controllers\EmployeeSalaryController', ['names' => [
                'index' => 'salaries.index',
                'create' => 'salaries.create',
                'show' => 'salaries.show',
                'edit' => 'salaries.edit',
                'store' => 'salaries.store',
                'update' => 'salaries.update',
                'destroy' => 'salaries.destroy'
            ]]);  
            Route::group(['prefix' => 'qualifications', 'as' => 'qualifications.'], function($employeeId) {
                
                Route::get('/', '\App\Modules\Pim\Http\Controllers\EmployeeQualificationsController@index')->name('index');
                Route::get('work-experience/datatable', '\App\Modules\Pim\Http\Controllers\EmployeeWorkExperienceController@getDatatable')
                    ->name('work_experience.datatable');
                Route::resource('work-experience', '\App\Modules\Pim\Http\Controllers\EmployeeWorkExperienceController', [
                    'except' => [
                        'index'
                    ],
                    'names' => [
                        'create' => 'work_experience.create',
                        'show' => 'work_experience.show',
                        'edit' => 'work_experience.edit',
                        'store' => 'work_experience.store',
                        'update' => 'work_experience.update',
                        'destroy' => 'work_experience.destroy'
                    ]
                ]); 
                Route::resource('skills', '\App\Modules\Pim\Http\Controllers\EmployeeSkillsController', [
                    'only' => ['store'],
                    'names' => [
                        'store' => 'skills.store'
                    ]
                ]); 
                Route::get('education/datatable', '\App\Modules\Pim\Http\Controllers\EmployeeEducationController@getDatatable')
                    ->name('education.datatable');
                Route::resource('education', '\App\Modules\Pim\Http\Controllers\EmployeeEducationController', [
                    'except' => [
                        'index'
                    ],
                    'names' => [
                        'create' => 'education.create',
                        'show' => 'education.show',
                        'edit' => 'education.edit',
                        'store' => 'education.store',
                        'update' => 'education.update',
                        'destroy' => 'education.destroy'
                    ]
                ]); 
                Route::get('languages/datatable', '\App\Modules\Pim\Http\Controllers\EmployeeLanguagesController@getDatatable')
                    ->name('languages.datatable');
                Route::resource('languages', '\App\Modules\Pim\Http\Controllers\EmployeeLanguagesController', [
                    'except' => [
                        'index'
                    ],
                    'names' => [
                        'create' => 'languages.create',
                        'show' => 'languages.show',
                        'edit' => 'languages.edit',
                        'store' => 'languages.store',
                        'update' => 'languages.update',
                        'destroy' => 'languages.destroy'
                    ]
                ]); 
            });
            Route::resource('preferences', '\App\Modules\Pim\Http\Controllers\EmployeePreferencesController', ['names' => [
                'index' => 'preferences.index',
                'create' => 'preferences.create',
                'show' => 'preferences.show',
                'edit' => 'preferences.edit',
                'store' => 'preferences.store',
                'update' => 'preferences.update',
                'destroy' => 'preferences.destroy'
            ]]);  
        });  
    });
    Route::group(['prefix' => 'leave', 'as' => 'leave.', 'middleware' => ['auth', 'admin']], function() {
        Route::get('/', function() {
            return view('leave::index');
        })->name('index');
        Route::get('leave-types/datatable', '\App\Modules\Leave\Http\Controllers\LeaveTypeController@getDatatable')
            ->name('leave_types.datatable');
        Route::resource('leave-types', '\App\Modules\Leave\Http\Controllers\LeaveTypeController', ['names' => [
            'index' => 'leave_types.index',
            'create' => 'leave_types.create',
            'show' => 'leave_types.show',
            'edit' => 'leave_types.edit',
            'store' => 'leave_types.store',
            'update' => 'leave_types.update',
            'destroy' => 'leave_types.destroy'
        ]]);
        Route::get('holidays/datatable', '\App\Modules\Leave\Http\Controllers\HolidayController@getDatatable')
            ->name('holidays.datatable');
        Route::resource('holidays', '\App\Modules\Leave\Http\Controllers\HolidayController', ['names' => [
            'index' => 'holidays.index',
            'create' => 'holidays.create',
            'show' => 'holidays.show',
            'edit' => 'holidays.edit',
            'store' => 'holidays.store',
            'update' => 'holidays.update',
            'destroy' => 'holidays.destroy'
        ]]);
        Route::get('employee-leaves/datatable', '\App\Modules\Leave\Http\Controllers\EmployeeLeaveController@getDatatable')
            ->name('employee_leaves.datatable');
        Route::resource('employee-leaves', '\App\Modules\Leave\Http\Controllers\EmployeeLeaveController', ['names' => [
            'index' => 'employee_leaves.index',
            'create' => 'employee_leaves.create',
            'show' => 'employee_leaves.show',
            'edit' => 'employee_leaves.edit',
            'store' => 'employee_leaves.store',
            'update' => 'employee_leaves.update',
            'destroy' => 'employee_leaves.destroy'
        ]]);
        Route::get('calendar', '\App\Modules\Leave\Http\Controllers\CalendarController@index')->name('calendar.index');
        Route::get('render-calendar', '\App\Modules\Leave\Http\Controllers\CalendarController@renderCalendar')->name('calendar.render');
    });
    Route::group(['prefix' => 'recruitment', 'as' => 'recruitment.', 'middleware' => ['auth', 'admin']], function() {
        Route::get('/', function() {
            return view('recruitment::index');
        })->name('index');
        Route::get('reports/datatable', '\App\Modules\Recruitment\Http\Controllers\ReportsController@getDatatable')
            ->name('reports.datatable');
        Route::resource('reports', '\App\Modules\Recruitment\Http\Controllers\ReportsController', ['names' => [
            'index' => 'reports.index',
            'create' => 'reports.create',
            'show' => 'reports.show',
            'edit' => 'reports.edit',
            'store' => 'reports.store',
            'update' => 'reports.update',
            'destroy' => 'reports.destroy'
        ]]);
    });
    Route::group(['prefix' => 'discipline', 'as' => 'discipline.', 'middleware' => ['auth', 'admin']], function() {
        Route::get('/', function() {
            return view('discipline::index');
        })->name('index');
        Route::get('disciplinary-cases/datatable', '\App\Modules\Discipline\Http\Controllers\DisciplinaryCasesController@getDatatable')
            ->name('disciplinary_cases.datatable');
        Route::resource('disciplinary-cases', '\App\Modules\Discipline\Http\Controllers\DisciplinaryCasesController', ['names' => [
            'index' => 'disciplinary_cases.index',
            'create' => 'disciplinary_cases.create',
            'show' => 'disciplinary_cases.show',
            'edit' => 'disciplinary_cases.edit',
            'store' => 'disciplinary_cases.store',
            'update' => 'disciplinary_cases.update',
            'destroy' => 'disciplinary_cases.destroy'
        ]]);
    });
    Route::group(['prefix' => 'time', 'as' => 'time.', 'middleware' => ['auth', 'admin']], function() {
        Route::get('/', function() {
            return view('time::index');
        })->name('index');
        Route::get('clients/datatable', '\App\Modules\Time\Http\Controllers\ClientsController@getDatatable')
            ->name('clients.datatable');
        Route::resource('clients', '\App\Modules\Time\Http\Controllers\ClientsController', ['names' => [
            'index' => 'clients.index',
            'create' => 'clients.create',
            'show' => 'clients.show',
            'edit' => 'clients.edit',
            'store' => 'clients.store',
            'update' => 'clients.update',
            'destroy' => 'clients.destroy'
        ]]);
        Route::get('projects/datatable', '\App\Modules\Time\Http\Controllers\ProjectsController@getDatatable')
            ->name('projects.datatable');
        Route::resource('projects', '\App\Modules\Time\Http\Controllers\ProjectsController', ['names' => [
            'index' => 'projects.index',
            'create' => 'projects.create',
            'show' => 'projects.show',
            'edit' => 'projects.edit',
            'store' => 'projects.store',
            'update' => 'projects.update',
            'destroy' => 'projects.destroy'
        ]]);
        Route::get('time-logs/datatable', '\App\Modules\Time\Http\Controllers\TimeLogsController@getDatatable')
            ->name('time_logs.datatable');
        Route::resource('time-logs', '\App\Modules\Time\Http\Controllers\TimeLogsController', ['names' => [
            'index' => 'time_logs.index',
            'create' => 'time_logs.create',
            'show' => 'time_logs.show',
            'edit' => 'time_logs.edit',
            'store' => 'time_logs.store',
            'update' => 'time_logs.update',
            'destroy' => 'time_logs.destroy'
        ]]);
    });
});
Route::group(['prefix' => 'employee', 'as' => 'employee.', 'middleware' => ['auth', 'employee']], function() {
    Route::get('/', '\App\Http\Controllers\HomeController@indexEmployee')
    ->name('home');
});
Auth::routes();