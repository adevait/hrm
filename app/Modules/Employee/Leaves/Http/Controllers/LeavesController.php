<?php

namespace App\Modules\Employee\Leaves\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Leave\Http\Requests\EmployeeLeaveRequest;
use App\Modules\Leave\Repositories\Interfaces\EmployeeLeaveRepositoryInterface as EmployeeLeaveRepository;
use App\Modules\Pim\Repositories\Interfaces\EmployeeRepositoryInterface as EmployeeRepository;
use App\Modules\Leave\Repositories\Interfaces\LeaveTypeRepositoryInterface as LeaveTypeRepository;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Datatables;

class LeavesController extends Controller
{
    private $employeeLeaveRepository;

    public function __construct(EmployeeLeaveRepository $employeeLeaveRepository)
    {
        $this->employeeLeaveRepository = $employeeLeaveRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \App\Modules\Leave\Repositories\LeaveTypeRepository  $leaveTypeRepository
     * @param  \App\Modules\Pim\Repositories\EmployeeRepository  $employeeRepository
     * @return \Illuminate\Http\Response
     */
    public function index(LeaveTypeRepository $leaveTypeRepository, EmployeeRepository $employeeRepository)
    {
        $leaveTypes = $leaveTypeRepository->getAll()->pluck('name', 'id');
        $employees = $employeeRepository->findBy('email', Auth::user()->email)->pluck('first_name', 'id');
        
        return view('employee.leaves::index', compact('leaveTypes','employees'));
    }

    /**
     * Returns data for the resource list
     * 
     * @return \Illuminate\Http\Response
     */
    public function getDatatable(EmployeeRepository $employeeRepository)
    {
        $id = $employeeRepository->findBy('email', Auth::user()->email)->first()->id;
        return Datatables::of($this->employeeLeaveRepository->findBy('user_id', $id, ['id', 'user_id', 'leave_type_id', 'start_date', 'end_date']))
            ->editColumn('user_id', function($leave) {
                return $leave->employee->first_name.' '.$leave->employee->last_name;
            })
            ->editColumn('leave_type_id', function($leave) {
                return $leave->leave_type->name;
            })
            ->addColumn('actions', function($leave){
                return view('includes._datatable_actions', [
                    'deleteUrl' => route('employee.leaves.destroy', $leave->id), 
                    'editUrl' => route('employee.leaves.edit', $leave->id)
                ]);
            })
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Modules\Leave\Repositories\LeaveTypeRepository  $leaveTypeRepository
     * @param  \App\Modules\Pim\Repositories\EmployeeRepository  $employeeRepository
     * @return \Illuminate\Http\Response
     */
    public function create(LeaveTypeRepository $leaveTypeRepository, EmployeeRepository $employeeRepository)
    {
        $leaveTypes = $leaveTypeRepository->getAll()->pluck('name', 'id');
        $employees = $employeeRepository->findBy('email', Auth::user()->email)->pluck('first_name', 'id');
        
        return view('employee.leaves::create', compact('leaveTypes', 'employees'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Modules\Leave\Http\Requests\EmployeeLeaveRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeLeaveRequest $request)
    {
        $employeeLeaveData = $request->all();
        if($request->hasFile('attachment')) {
            $path = $request->attachment->store('uploads/leaves');
            $employeeLeaveData['attachment'] = $path;
        }
        $employeeLeaveData['approved'] = "pending";
        $employeeLeaveData = $this->employeeLeaveRepository->create($employeeLeaveData);
        $this->employeeLeaveRepository->updateStatus($employeeLeaveData->user_id, $employeeLeaveData->leave_type_id, $employeeLeaveData->start_date, $employeeLeaveData->end_date);
        return redirect()->route('employee.leaves.edit', $employeeLeaveData->id)->with('success', trans('app.leave.employee_leaves.store_success'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  integer  unique identifier for the resource
     * @param  \App\Modules\Leave\Repositories\LeaveTypeRepository  $leaveTypeRepository
     * @param  \App\Modules\Pim\Repositories\EmployeeRepository  $employeeRepository
     * @return \Illuminate\Http\Response
     */
    public function edit($id, LeaveTypeRepository $leaveTypeRepository, EmployeeRepository $employeeRepository)
    {
        $employeeLeave = $this->employeeLeaveRepository->getById($id);
        $leaveTypes = $leaveTypeRepository->getAll()->pluck('name', 'id');
        $breadcrumb = ['title' => '#'.$employeeLeave->id, 'id' => $employeeLeave->id];
        $employees = $employeeRepository->findBy('email', Auth::user()->email)->pluck('first_name', 'id');
        return view('employee.leaves::edit', compact('employeeLeave', 'leaveTypes', 'breadcrumb','employees'));
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
        $employeeLeaveData = $request->all();
        if($request->hasFile('attachment')) {
            $path = $request->attachment->store('uploads/leaves');
            $employeeLeaveData['attachment'] = $path;
        }
        $employeeLeaveData = $this->employeeLeaveRepository->update($id, $employeeLeaveData);
        $this->employeeLeaveRepository->updateStatus($employeeLeaveData->user_id, $employeeLeaveData->leave_type_id, $employeeLeaveData->start_date, $employeeLeaveData->end_date);
        $request->session()->flash('success', trans('app.leave.employee_leaves.update_success'));
        return redirect()->route('employee.leaves.edit', $employeeLeaveData->id);
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
        return redirect()->route('employee.leaves.index');
    }
}