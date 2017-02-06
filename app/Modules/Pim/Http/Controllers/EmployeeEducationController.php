<?php

namespace App\Modules\Pim\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Pim\Repositories\Interfaces\EmployeeRepositoryInterface as EmployeeRepository;
use App\Modules\Pim\Repositories\Interfaces\EmployeeEducationRepositoryInterface as EmployeeEducationRepository;
use App\Modules\Settings\Repositories\Interfaces\EducationInstitutionRepositoryInterface as EducationInstitutionRepository;
use App\Modules\Pim\Http\Requests\EmployeeEducationRequest;
use Illuminate\Http\Request;
use Datatables;

class EmployeeEducationController extends Controller
{
    private $employeeRepository;
    private $employeeEducationRepository;

    public function __construct(
            EmployeeRepository $employeeRepository,
            EmployeeEducationRepository $employeeEducationRepository
        )
    {
        $this->employeeRepository = $employeeRepository;
        $this->employeeEducationRepository = $employeeEducationRepository;
    }

    /**
     * Returns data for the resource list
     * 
     * @param  integer  unique identifier for the related employee resource
     * @return \Illuminate\Http\Response
     */
    public function getDatatable($employeeId)
    {
        return Datatables::of($this->employeeEducationRepository->getCollection([
            [
                'key' => 'user_id', 
                'operator' => '=', 
                'value' =>  $employeeId
            ]], [
                'id', 
                'type', 
                'education_institution_id', 
                'major',
                'year',
                'user_id'
            ]))
            ->editColumn('type', function($education) {
                return get_education_type_name($education->type);
            })
            ->editColumn('education_institution_id', function($education) {
                return $education->education_institution->name;
            })
            ->addColumn('actions', function($education){
                return view('includes._datatable_actions', [
                    'deleteUrl' => route('pim.employees.qualifications.education.destroy', [$education->user_id, $education->id]), 
                    'editUrl' => route('pim.employees.qualifications.education.edit', [$education->user_id, $education->id])
                ]);
            })
            ->removeColumn('user_id')
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  integer  unique identifier for the related employee resource
     * @param  \App\Modules\Settings\Repositories\Interfaces\EducationInstitutionRepositoryInterface $educationInstitutionRepository
     * @return \Illuminate\Http\Response
     */
    public function create($employeeId, EducationInstitutionRepository $educationInstitutionRepository)
    {
        $employee = $this->employeeRepository->getById($employeeId);
        $breadcrumb = [
            'parent_id' => $employeeId, 
            'parent_title' => $employee->first_name.' '.$employee->last_name,
            'parent_type' => get_user_role($employee->role)
        ];
        $institutions = $educationInstitutionRepository->pluck('name','id');
        return view('pim::employee_qualifications.education.create', compact('breadcrumb', 'institutions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  integer  unique identifier for the related employee resource
     * @param  \App\Modules\Pim\Http\Requests\EmployeeEducationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store($employeeId, EmployeeEducationRequest $request)
    {
        // TODO: end date not working
        $educationData = $request->all() + ['user_id' => $employeeId];
        $educationData = $this->employeeEducationRepository->create($educationData);
        $request->session()->flash('success', trans('app.pim.employees.qualifications.education.store_success'));
        return redirect()->route('pim.employees.qualifications.education.edit', [$employeeId, $educationData->id]);
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
     * @param  \App\Modules\Settings\Repositories\Interfaces\EducationInstitutionRepositoryInterface $educationInstitutionRepository
     * @return \Illuminate\Http\Response
     */
    public function edit($employeeId, $id, EducationInstitutionRepository $educationInstitutionRepository)
    {
        $education = $this->employeeEducationRepository->getById($id);
        $employee = $this->employeeRepository->getById($employeeId);
        $institutions = $educationInstitutionRepository->pluck('name','id');
        $breadcrumb = [
            'parent_id' => $employeeId, 
            'parent_title' => $employee->first_name.' '.$employee->last_name,
            'parent_type' => get_user_role($employee->role),
            'id' => $id,
            'title' => $education->major.' at '.$institutions[$education->education_institution_id]
        ];
        return view('pim::employee_qualifications.education.edit', compact('breadcrumb', 'institutions', 'education'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  integer  unique identifier for the related employee resource
     * @param  integer  unique identifier for the resource
     * @param  \App\Modules\Settings\Pim\Requests\EmployeeEducationRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update($employeeId, $id, EmployeeEducationRequest $request)
    {
        $educationData = $this->employeeEducationRepository->update($id, $request->all());
        $request->session()->flash('success', trans('app.pim.employees.qualifications.education.update_success'));
        return redirect()->route('pim.employees.qualifications.education.edit', [$employeeId, $educationData->id]);
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
        $this->employeeEducationRepository->delete($id);
        $request->session()->flash('success', trans('app.pim.employees.qualifications.education.delete_success'));
        return redirect()->route('pim.employees.qualifications.index', $employeeId);
    }
}