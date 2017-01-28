<?php

namespace App\Modules\Pim\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Settings\Repositories\Interfaces\SkillRepositoryInterface as SkillRepository;
use App\Modules\Pim\Repositories\Interfaces\EmployeeSkillRepositoryInterface as EmployeeSkillRepository;
use App\Modules\Pim\Repositories\Interfaces\EmployeeRepositoryInterface as EmployeeRepository;
use Datatables;

class EmployeeQualificationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  integer  unique identifier for the related employee resource
     * @param  \App\Modules\Settings\Repositories\Interfaces\SkillRepositoryInterface $educationInstitutionRepository
     * @param  \App\Modules\Pim\Repositories\Interfaces\EmployeeSkillRepositoryInterface $educationInstitutionRepository
     * @return \Illuminate\Http\Response
     */
    public function index($employeeId, 
        EmployeeSkillRepository $employeeSkillRepository,
        SkillRepository $skillRepository,
        EmployeeRepository $employeeRepository)
    {
        $allSkills = $skillRepository->getAll()->pluck('name', 'name');
        $skills = $employeeSkillRepository->getEmployeSkills($employeeId);
        $employee = $employeeRepository->getById($employeeId);
        $breadcrumb = [
            'parent_id' => $employeeId, 
            'parent_title' => $employee->first_name.' '.$employee->last_name
        ];
        return view('pim::employee_qualifications.index', compact('employeeId', 'skills', 'allSkills', 'breadcrumb'));
    }
}