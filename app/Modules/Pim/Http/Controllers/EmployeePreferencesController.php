<?php

namespace App\Modules\Pim\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Pim\Repositories\Interfaces\EmployeeRepositoryInterface as EmployeeRepository;
use App\Modules\Pim\Repositories\Interfaces\EmployeePreferencesRepositoryInterface as EmployeePreferencesRepository;
use App\Modules\Settings\Repositories\Interfaces\ContractTypeRepositoryInterface as ContractTypeRepository;
use App\Modules\Pim\Http\Requests\EmployeePreferencesRequest;

class EmployeePreferencesController extends Controller
{
    private $employeeRepository;
    private $employeePreferencesRepository;

    public function __construct(
            EmployeeRepository $employeeRepository,
            EmployeePreferencesRepository $employeePreferencesRepository
        )
    {
        $this->employeeRepository = $employeeRepository;
        $this->employeePreferencesRepository = $employeePreferencesRepository;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  integer  unique identifier for the related employee resource
     * @param  App\Modules\Settings\Repositories\Interfaces\ContractTypeRepositoryInterface  $contractTypeRepository
     * @return \Illuminate\Http\Response
     */
    public function index($employeeId, ContractTypeRepository $contractTypeRepository)
    {
        $employee = $this->employeeRepository->getById($employeeId);
        $preference = $this->employeePreferencesRepository->getByMany(['user_id' => $employeeId])->first();
        $contractTypes = $contractTypeRepository->getAll()->pluck('name', 'id');
        $breadcrumb = [
            'parent_id' => $employeeId, 
            'parent_title' => $employee->first_name.' '.$employee->last_name,
            'parent_type' => get_user_role($employee->role)
        ];
        if($preference) {
            return view('pim::employee_preferences.edit', compact('breadcrumb', 'preference', 'contractTypes'));
        }
        return view('pim::employee_preferences.create', compact('breadcrumb', 'contractTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  integer  unique identifier for the related employee resource
     * @param  \App\Modules\Pim\Http\Requests\EmployeePreferencesRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store($employeeId, EmployeePreferencesRequest $request)
    {
        $preferenceData = $request->all() + ['user_id' => $employeeId];
        $preferenceData = $this->employeePreferencesRepository->create($preferenceData);
        $request->session()->flash('success', trans('app.pim.candidates.preferences.store_success'));
        return redirect()->route('pim.employees.preferences.index', $employeeId);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  integer  unique identifier for the related employee resource
     * @param  integer  unique identifier for the resource
     * @param  \App\Modules\Settings\Http\Requests\EmployeePreferencesRequest $request
     * @return \Illuminate\Http\Response
     */
    public function update($employeeId, $id, EmployeePreferencesRequest $request)
    {
        $preferenceData = $this->employeePreferencesRepository->update($id, $request->all());
        $request->session()->flash('success', trans('app.pim.candidates.preferences.update_success'));
        return redirect()->route('pim.employees.preferences.index', [$employeeId]);
    }
}