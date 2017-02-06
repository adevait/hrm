<?php

namespace App\Modules\Pim\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Settings\Repositories\Interfaces\SkillRepositoryInterface as SkillRepository;
use App\Modules\Pim\Repositories\Interfaces\EmployeeSkillRepositoryInterface as EmployeeSkillRepository;
use App\Modules\Pim\Repositories\Interfaces\EmployeeRepositoryInterface as EmployeeRepository;
use App\Modules\Settings\Repositories\Interfaces\CompanyRepositoryInterface as CompanyRepository;
use App\Modules\Settings\Repositories\Interfaces\EducationInstitutionRepositoryInterface as EducationInstitutionRepository;
use App\Modules\Settings\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;
use Datatables;

class EmployeeQualificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  integer  unique identifier for the related employee resource
     * @param  \App\Modules\Pim\Repositories\Interfaces\EmployeeSkillRepositoryInterface $employeeSkillRepository
     * @param  \App\Modules\Settings\Repositories\Interfaces\SkillRepositoryInterface $skillRepository
     * @param  \App\Modules\Settings\Repositories\Interfaces\CompanyRepositoryInterface $companyRepository
     * @param  \App\Modules\Settings\Repositories\Interfaces\EducationInstitutionRepositoryInterface $educationInstitutionRepository
     * @param  \App\Modules\Settings\Repositories\Interfaces\LanguageRepositoryInterface $languageRepository
     * @return \Illuminate\Http\Response
     */
    public function index($employeeId, 
        EmployeeSkillRepository $employeeSkillRepository,
        SkillRepository $skillRepository,
        EmployeeRepository $employeeRepository, 
        CompanyRepository $companyRepository,
        EducationInstitutionRepository $educationInstitutionRepository, 
        LanguageRepository $languageRepository)
    {
        $allSkills = $skillRepository->getAll()->pluck('name', 'name');
        $skills = $employeeSkillRepository->getEmployeSkills($employeeId);
        $companies = $companyRepository->pluck('name','id');
        $employee = $employeeRepository->getById($employeeId);
        $education_institutions = $educationInstitutionRepository->pluck('name', 'id');
        $languages = $languageRepository->pluck('name', 'id');
        $breadcrumb = [
            'parent_id' => $employeeId, 
            'parent_title' => $employee->first_name.' '.$employee->last_name,
            'parent_type' => get_user_role($employee->role)
        ];
        return view('pim::employee_qualifications.index', compact('employeeId', 'skills', 'allSkills', 'companies', 'education_institutions', 'languages', 'breadcrumb'));
    }
}