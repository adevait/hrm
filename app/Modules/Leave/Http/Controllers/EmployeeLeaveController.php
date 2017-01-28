<?php

namespace App\Modules\Leave\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Leave\Repositories\Interfaces\EmployeeLeaveRepositoryInterface as EmployeeLeaveRepository;
use App\Modules\Pim\Repositories\Interfaces\EmployeeRepositoryInterface as EmployeeRepository;
use App\Modules\Leave\Repositories\Interfaces\LeaveTypeRepositoryInterface as LeaveTypeRepository;
use App\Modules\Leave\Http\Requests\EmployeeLeaveRequest;
use Illuminate\Http\Request;
use Datatables;

class EmployeeLeaveController extends Controller
{
    private $employeeLeaveRepository;

    public function __construct(EmployeeLeaveRepository $employeeLeaveRepository)
    {
        $this->employeeLeaveRepository = $employeeLeaveRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('leave::employee_leaves.index');
    }

    /**
     * Returns data for the resource list
     * 
     * @param  \App\Modules\Pim\Repositories\EmployeeRepository  $employeeRepository
     * @param  \App\Modules\Pim\Repositories\LeaveTypeRepository  $leaveTypeRepository
     * @return \Illuminate\Http\Response
     */
    public function getDatatable(EmployeeRepository $employeeRepository, LeaveTypeRepository $leaveTypeRepository)
    {
        return Datatables::of($this->employeeLeaveRepository->getQry([], ['id', 'user_id', 'leave_type_id', 'start_date', 'end_date']))
            ->editColumn('user_id', function($leave) use ($employeeRepository) {
                $employee = $employeeRepository->getById($leave->user_id);
                return $employee->first_name.' '.$employee->last_name;
            })
            ->editColumn('leave_type_id', function($leave) use ($leaveTypeRepository) {
                $leaveType = $leaveTypeRepository->getById($leave->leave_type_id);
                return $leaveType->name;
            })
            ->addColumn('actions', function($leave){
                return view('includes._datatable_actions', [
                    'deleteUrl' => route('leave.employee_leaves.destroy', $leave->id), 
                    'editUrl' => route('leave.employee_leaves.edit', $leave->id)
                ]);
            })
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Modules\Leave\Repositories\LeaveTypeRepository  $leaveTypeRepository
     * @return \Illuminate\Http\Response
     */
    public function create(LeaveTypeRepository $leaveTypeRepository)
    {
        $leaveTypes = $leaveTypeRepository->getAll()->pluck('name', 'id');
        return view('leave::employee_leaves.create', compact('leaveTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Modules\Leave\Http\Requests\EmployeeLeaveRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeLeaveRequest $request)
    {
        // to do: if the leave type has day limit, the end date should be required, otherwise not.
        // to do: check if dates enter the leave type dates
        // Adjust the request accordingly
        $employeeLeaveData = $this->employeeLeaveRepository->create($request->all());
        $this->employeeLeaveRepository->updateStatus($employeeLeaveData->user_id, $employeeLeaveData->leave_type_id, $employeeLeaveData->start_date, $employeeLeaveData->end_date);
        return redirect()->route('leave.employee_leaves.edit', $employeeLeaveData->id)->with('success', trans('app.leave.employee_leaves.store_success'));
    }

    /**
     * Display the specified resource.
     *
     * @param  integer  unique identifier for the resource
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  integer  unique identifier for the resource
     * @param  \App\Modules\Leave\Repositories\LeaveTypeRepository  $leaveTypeRepository
     * @return \Illuminate\Http\Response
     */
    public function edit($id, LeaveTypeRepository $leaveTypeRepository)
    {
        $employeeLeave = $this->employeeLeaveRepository->getById($id);
        $leaveTypes = $leaveTypeRepository->getAll()->pluck('name', 'id');
        $breadcrumb = ['title' => '#'.$employeeLeave->id, 'id' => $employeeLeave->id];
        return view('leave::employee_leaves.edit', compact('employeeLeave', 'leaveTypes', 'breadcrumb'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  integer  unique identifier for the resource
     * @param  \App\Modules\Leave\Http\Requests\EmployeeLeaveRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function update($id, EmployeeLeaveRequest $request)
    {
        $employeeLeaveData = $this->employeeLeaveRepository->getById($id);
        $this->employeeLeaveRepository->deleteUsedDays($employeeLeaveData->user_id, $employeeLeaveData->leave_type_id, $employeeLeaveData->start_date, $employeeLeaveData->end_date);
        $employeeLeaveData = $this->employeeLeaveRepository->update($id, $request->all());
        $this->employeeLeaveRepository->updateStatus($employeeLeaveData->user_id, $employeeLeaveData->leave_type_id, $employeeLeaveData->start_date, $employeeLeaveData->end_date);
        $request->session()->flash('success', trans('app.leave.employee_leaves.update_success'));
        return redirect()->route('leave.employee_leaves.edit', $employeeLeaveData->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  integer  unique identifier for the resource
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $employeeLeaveData = $this->employeeLeaveRepository->getById($id);
        $this->employeeLeaveRepository->deleteUsedDays($employeeLeaveData->user_id, $employeeLeaveData->leave_type_id, $employeeLeaveData->start_date, $employeeLeaveData->end_date);
        $this->employeeLeaveRepository->delete($id);
        $request->session()->flash('success', trans('app.leave.employee_leaves.delete_success'));
        return redirect()->route('leave.employee_leaves.index');
    }
}