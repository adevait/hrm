<?php

namespace App\Modules\Pim\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Pim\Repositories\Interfaces\EmployeeRepositoryInterface as EmployeeRepository;
use App\Modules\Pim\Repositories\Interfaces\EmployeeSocialMediaRepositoryInterface as EmployeeSocialMediaRepository;
use App\Modules\Pim\Http\Requests\EmployeeSocialMediaRequest;
use Illuminate\Http\Request;

class EmployeeSocialMediaController extends Controller
{
    private $employeeRepository;
    private $employeeSocialMediaRepository;

    public function __construct(
            EmployeeRepository $employeeRepository,
            EmployeeSocialMediaRepository $employeeSocialMediaRepository
        )
    {
        $this->employeeRepository = $employeeRepository;
        $this->employeeSocialMediaRepository = $employeeSocialMediaRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  integer  unique identifier for the related employee resource
     * @return \Illuminate\Http\Response
     */
    public function index($employeeId)
    {
        $employee = $this->employeeRepository->getById($employeeId);
        $breadcrumb = [
            'parent_id' => $employeeId, 
            'parent_title' => $employee->first_name.' '.$employee->last_name,
            'parent_type' => get_user_role($employee->role)
        ];
        $accounts = $this->employeeSocialMediaRepository->getByMany(['user_id' => $employeeId])->get();
        return view('pim::employee_social_media.index', compact('breadcrumb', 'accounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  integer  unique identifier for the related employee resource
     * @return \Illuminate\Http\Response
     */
    public function create($employeeId)
    {
        $employee = $this->employeeRepository->getById($employeeId);
        $breadcrumb = [
            'parent_id' => $employeeId, 
            'parent_title' => $employee->first_name.' '.$employee->last_name,
            'parent_type' => get_user_role($employee->role)
        ];
        return view('pim::employee_social_media.create', compact('breadcrumb'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  integer  unique identifier for the related employee resource
     * @param  \App\Modules\Settings\Http\Requests\EmployeeSocialMediaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store($employeeId, EmployeeSocialMediaRequest $request)
    {
        $accountData = $request->all() + ['user_id' => $employeeId];
        $accountData = $this->employeeSocialMediaRepository->create($accountData);
        $request->session()->flash('success', trans('app.pim.employees.external_accounts.store_success'));
        return redirect()->route('pim.employees.social_media.edit', [$employeeId, $accountData->id]);
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
     * @return \Illuminate\Http\Response
     */
    public function edit($employeeId, $id)
    {
        $employee = $this->employeeRepository->getById($employeeId);
        $account = $this->employeeSocialMediaRepository->getById($id);
        $breadcrumb = [
            'parent_id' => $employee->id,
            'parent_title' => $employee->first_name.' '.$employee->last_name,
            'parent_type' => get_user_role($employee->role), 
            'id' => $account->id,
            'title' => get_account_name($account->type)
        ];
        return view('pim::employee_social_media.edit', compact('account', 'breadcrumb'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  integer  unique identifier for the related employee resource
     * @param  integer  unique identifier for the resource
     * @param  \App\Modules\Settings\Http\Requests\EmployeeSocialMediaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update($employeeId, $id, EmployeeSocialMediaRequest $request)
    {
        $accountData = $this->employeeSocialMediaRepository->update($id, $request->all());
        $request->session()->flash('success', trans('app.pim.employees.external_accounts.update_success'));
        return redirect()->route('pim.employees.social_media.edit', [$employeeId, $accountData->id]);
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
        $this->employeeSocialMediaRepository->delete($id);
        $request->session()->flash('success', trans('app.pim.employees.external_accounts.delete_success'));
        return redirect()->route('pim.employees.social_media.index', $employeeId);
    }
}