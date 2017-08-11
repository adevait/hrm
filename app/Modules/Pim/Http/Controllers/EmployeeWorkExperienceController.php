<?php

namespace App\Modules\Pim\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Pim\Repositories\Interfaces\EmployeeRepositoryInterface as EmployeeRepository;
use App\Modules\Pim\Repositories\Interfaces\EmployeeWorkExperienceRepositoryInterface as EmployeeWorkExperienceRepository;
use App\Modules\Settings\Repositories\Interfaces\CompanyRepositoryInterface as CompanyRepository;
use App\Modules\Pim\Http\Requests\EmployeeExperienceRequest;
use Illuminate\Http\Request;
use Datatables;

class EmployeeWorkExperienceController extends Controller
{
    private $employeeRepository;
    private $employeeWorkExperienceRepository;

    public function __construct(
            EmployeeRepository $employeeRepository,
            EmployeeWorkExperienceRepository $employeeWorkExperienceRepository
        )
    {
        $this->employeeRepository = $employeeRepository;
        $this->employeeWorkExperienceRepository = $employeeWorkExperienceRepository;
    }

    /**
     * Returns data for the resource list
     * 
     * @param  integer  unique identifier for the related employee resource
     * @return \Illuminate\Http\Response
     */
    public function getDatatable($employeeId)
    {
        return Datatables::of($this->employeeWorkExperienceRepository->getCollection([
            [
                'key' => 'user_id', 
                'operator' => '=', 
                'value' =>  $employeeId
            ]], [
                'id', 
                'job_title', 
                'start_date', 
                'end_date',
                'company_id',
                'user_id'
            ]))
            ->editColumn('company_id', function($experience) {
                return $experience->company->name;
            })
            ->addColumn('actions', function($experience){
                return view('includes._datatable_actions', [
                    'deleteUrl' => route('pim.employees.qualifications.work_experience.destroy', [$experience->user_id, $experience->id]), 
                    'editUrl' => route('pim.employees.qualifications.work_experience.edit', [$experience->user_id, $experience->id])
                ]);
            })
            ->removeColumn('user_id')
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  integer  unique identifier for the related employee resource
     * @param  \App\Modules\Settings\Repositories\Interfaces\CompanyRepositoryInterface $companyRepository
     * @return \Illuminate\Http\Response
     */
    public function create($employeeId, CompanyRepository $companyRepository)
    {
        $employee = $this->employeeRepository->getById($employeeId);
        $breadcrumb = [
            'parent_id' => $employeeId, 
            'parent_title' => $employee->first_name.' '.$employee->last_name,
            'parent_type' => get_user_role($employee->role)
        ];
        $companies = $companyRepository->pluck('name','id');
        return view('pim::employee_qualifications.work_experience.create', compact('breadcrumb', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  integer  unique identifier for the related employee resource
     * @param  \App\Modules\Pim\Http\Requests\EmployeeExperienceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store($employeeId, EmployeeExperienceRequest $request)
    {
        $experienceData = $request->all() + ['user_id' => $employeeId];
        $experienceData = $this->employeeWorkExperienceRepository->create($experienceData);
        $request->session()->flash('success', trans('app.pim.employees.qualifications.work_experience.store_success'));
        return redirect()->route('pim.employees.qualifications.work_experience.edit', [$employeeId, $experienceData->id]);
    }

    /**
     * Display the specified resource.
     *
     * @param  integer  unique identifier for the related employee resource
     * @param  integer  unique identifier for the resource
     * @return \Illuminate\Http\Response
     */
    public function show($employeeId, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  integer  unique identifier for the related employee resource
     * @param  integer  unique identifier for the resource
     * @param  \App\Modules\Settings\Repositories\Interfaces\CompanyRepositoryInterface $companyRepository
     * @return \Illuminate\Http\Response
     */
    public function edit($employeeId, $id, CompanyRepository $companyRepository)
    {
        $experience = $this->employeeWorkExperienceRepository->getById($id);
        $employee = $this->employeeRepository->getById($employeeId);
        $companies = $companyRepository->pluck('name','id');
        $breadcrumb = [
            'parent_id' => $employeeId, 
            'parent_title' => $employee->first_name.' '.$employee->last_name,
            'parent_type' => get_user_role($employee->role),
            'id' => $id,
            'title' => $experience->job_title.' at '.$companies[$experience->company_id]
        ];
        return view('pim::employee_qualifications.work_experience.edit', compact('breadcrumb', 'companies', 'experience'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  integer  unique identifier for the related employee resource
     * @param  integer  unique identifier for the resource
     * @param  \App\Modules\Pim\Http\Requests\EmployeeExperienceRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update($employeeId, $id, EmployeeExperienceRequest $request)
    {
        $experienceData = $this->employeeWorkExperienceRepository->update($id, $request->all());
        $request->session()->flash('success', trans('app.pim.employees.qualifications.work_experience.update_success'));
        return redirect()->route('pim.employees.qualifications.work_experience.edit', [$employeeId, $experienceData->id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer  unique identifier for the related employee resource
     * @param  integer  unique identifier for the resource
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($employeeId, $id, Request $request)
    {
        $this->employeeWorkExperienceRepository->delete($id);
        $request->session()->flash('success', trans('app.pim.employees.qualifications.work_experience.delete_success'));
        return redirect()->route('pim.employees.qualifications.index', $employeeId);
    }
}