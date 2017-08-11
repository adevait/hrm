<?php

namespace App\Modules\Pim\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Pim\Repositories\Interfaces\EmployeeRepositoryInterface as EmployeeRepository;
use App\Modules\Pim\Repositories\Interfaces\EmployeeContactDetailsRepositoryInterface as EmployeeContactDetailsRepository;
use App\Modules\Pim\Http\Requests\EmployeeContactDetailsRequest;

class EmployeeContactDetailsController extends Controller
{
    private $employeeRepository;
    private $employeecontactDetailsRepository;

    public function __construct(
            EmployeeRepository $employeeRepository,
            EmployeeContactDetailsRepository $employeecontactDetailsRepository
        )
    {
        $this->employeeRepository = $employeeRepository;
        $this->employeecontactDetailsRepository = $employeecontactDetailsRepository;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  integer  unique identifier for the related employee resource
     * @return \Illuminate\Http\Response
     */
    public function index($employeeId)
    {
        $employee = $this->employeeRepository->getById($employeeId);
        $contactDetails = $this->employeecontactDetailsRepository->getByMany(['user_id' => $employeeId])->first();
        $breadcrumb = [
            'parent_id' => $employeeId, 
            'parent_title' => $employee->first_name.' '.$employee->last_name,
            'parent_type' => get_user_role($employee->role)
        ];
        if($contactDetails) {
            return view('pim::employee_contact_details.edit', compact('breadcrumb', 'contactDetails'));
        }
        return view('pim::employee_contact_details.create', compact('breadcrumb'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  integer  unique identifier for the related employee resource
     * @param  \App\Modules\Pim\Http\Requests\EmployeeContactDetailsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store($employeeId, EmployeeContactDetailsRequest $request)
    {
        $contactData = $request->all() + ['user_id' => $employeeId];
        $contactData = $this->employeecontactDetailsRepository->create($contactData);
        $request->session()->flash('success', trans('app.pim.employees.contact_details.store_success'));
        return redirect()->route('pim.employees.contact_details.index', $employeeId);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  integer  unique identifier for the related employee resource
     * @param  integer  unique identifier for the resource
     * @param  \App\Modules\Settings\Http\Requests\EmployeeContactDetailsRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update($employeeId, $id, EmployeeContactDetailsRequest $request)
    {
        $contactData = $this->employeecontactDetailsRepository->update($id, $request->all());
        $request->session()->flash('success', trans('app.pim.employees.contact_details.update_success'));
        return redirect()->route('pim.employees.contact_details.index', [$employeeId]);
    }
}